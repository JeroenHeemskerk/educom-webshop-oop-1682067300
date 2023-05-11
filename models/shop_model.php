<?php 
require_once 'models/page_model.php';
require_once 'db_repository.php';
require_once 'sessions.php';

class ShopModel extends PageModel {

    public $canOrder;
    public $amount = 1;
    public $size ='';
    public $material = '';
    public $materialErr = '';
    public $options = array();
    public $products = array();
    public $cart = array();
    public $name = '';
    public $priceId = '';
    public $sizeId = '';
    public $materialId = '';
    public $product = '';
    public $productId = 0;
    public $properties = array();
    public $cartline = '';
    public $price_id = '';
    public $price_idErr = '';
    public $action = '';
    public $actionErr = '';
    public $cartlines = array();
    public $currentFlavour = array();
    public $flavour = '';
    public $flavourErr = '';
    public $flavouredproduct = '';
    public $cartContent = array();
    public $subtotal = 0;
    public $total = 0;
    public $updatedQuantity = 0;

    public function __construct($pageModel) {
        PARENT::__construct($pageModel);
        $this->canOrder = $this->sessionManager->isUserLoggedIn();
    }

    public function getProducts(){
        $this->products = selectProducts();
    }
    public function getDetailVar() {
        if ($this->isPost) {
            $productflavour = getPostVar("flavour");
            $product = explode('_', $productflavour );
            $this->productId = $product[0];
            $this->sizeId = $product[1];
            $this->materialId = $product[2];
            $this->priceId = $product[3];
        } else {
            $this->productId = getUrlVar("id");
            $this->sizeId = getUrlVar("size");
            $this->materialId = getUrlVar("material");
            $this->priceId = getUrlVar('price');
        }
        $this->product = findProductById($this->productId);
        if (empty($this->product)) {
            return;
        }
        $this->currentFlavour = null;
        if (array_key_exists($this->priceId, $this->product['flavours'])) {
            $this->currentFlavour = $this->product['flavours'][$this->priceId];
            if ($this->currentFlavour['size_id'] != $this->sizeId || $this->currentFlavour['material_id']!=$this->materialId) {
                $this->currentFlavour=null;
            }
        } 
        if (empty($this->currentFlavour)) {
            foreach ($this->product['flavours'] as $flav)  {
                if ($flav['size_id'] == $this->sizeId && $flav['material_id']==$this->materialId) {
                    $this->currentFlavour = $flav;
                    break;
                }
            }
        }
        if (empty($this->currentFlavour)) {
            $this->priceId = key($this->product['flavours']);
            $this->currentFlavour = $this->product['flavours'][$this->priceId];
            $this->sizeId = $this->currentFlavour['size_id'];
            $this->materialId = $this->currentFlavour['material_id'];
        }
        $this->flavour=$this->material=Util::generateKey($this->productId, $this->currentFlavour);
        $this->properties = findPropertiesByPriceId($this->priceId);

    }
    
    function getCartContent() {
        $this->cart = $this->sessionManager->getCart();
        if ($this->cart != NULL) {
            $this->products = fetchProductByPrizeId(array_keys($this->cart));
            $this->total = 0;
            $this->cartlines = array();
            foreach($this->cart as $this->priceId=>$this->amount) {
                $this->product = $this->products[$this->priceId];
                $this->subtotal = $this->amount * $this->product['price'];
                $this->cartline = array('price_id' => $this->priceId, 'id' => $this->product['id'], 'amount' => $this->amount, 'name' => $this->product['name'], 'subtotal' => $this->subtotal,
                'price' => $this->product['price'], 'image' => $this->product['image'], 'size_id' => $this->product['size_id'], 'material_id' => $this->product['material_id'], 
                'material' => $this->product['material']);
                $this->cartlines[] = $this->cartline;
                $this->total += $this->subtotal;
                }
                return array('cartlines'=> $this->cartlines, 'total' => $this->total);
            // } else {
            // return null;
            }
    }

    function saveOrder($user_id, $cartContent) {
        try{
            storeOrder($user_id, $cartContent);
            $this->sessionManager->emptyCart();
        } catch (Exception $e) {
        }
    }

    function handleAction() {
        $action = Util::getPostVar("action");
        switch($action) {
            case "Toevoegen" :
                $this->flavouredproduct = Util::getPostVar("flavour");
                $priceId = explode("_", $this->flavouredproduct);
                $amount = Util::getPostVar("amount");
                if ($amount > 0) {
                    $this->sessionManager->addToCart($priceId[3], $amount);
                }
                break;
            case "updateQuantity" :
                $updatedQuantity = Util::getPostVar("amount");
                $priceId = Util::getPostVar("price_id");
                if ($updatedQuantity != 0) {
                    $this->sessionManager->updateCart($priceId, $updatedQuantity);
                } else {
                    $this->sessionManager->removeFromCart($priceId);
                }
                break;
            case "Bestellen" :
                $user_id = getLoggedInID("id");
                $cartContent = $this->sessionManager->getCart();
                if($cartContent)
                $this->saveOrder($user_id, $cartContent);
                break;               
        }
    }
}