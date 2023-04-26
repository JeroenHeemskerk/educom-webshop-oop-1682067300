<?php
include_once 'basic_doc.php';

abstract class FormsDoc extends BasicDoc {

    protected function showFormStart($field) {
        echo '<form method="post" action="index.php" id="'.$field.'">';
    }
    protected function showFormField($field, $label, $type, $data, $options = array(), $rows = NULL, $cols = NULL, $onChange=NULL) {
    
      echo '<label for="' . $field . '">' . $label . ' </label><br>' . PHP_EOL;
            if ($type == "select"){
                echo '<' . $type . ' id="' . $field . '" name="' . $field . '" ' . (empty($onChange) ? '' : 'onchange="' . $onChange . '"'). '>' . PHP_EOL;
                foreach($options as $key => $title) {
                    echo '<option value="' . $key .'"'; if (isset($data[$field]) && $data[$field] == "$key") echo "selected"; echo'>' . $title . '</option>' . PHP_EOL;
                }   echo '</select><br>' . PHP_EOL;            
                $this->showError($field, $data);
            }   
            
            else if ($type == "radio") {
                foreach ($options as $key => $contactoptions) {
                    echo  '<input type="radio" id="' . $field . $key . '" name="' . $field . '"'; if (isset($data[$field]) && $data[$field] == "$key") echo "checked"; echo' value="' . $key . '" > 
                    <label for="' . $field . $key . '">' . $contactoptions . '</label><br>';
                }
                $this->showError($field, $data);
            } 
            
            else if ($type == "textarea") {
                echo '<textarea name ="' . $field . '" rows="' . $rows . '" cols="' . $cols . '">' . $data[$field] . '</textarea><br><br>';
                $this->showError($field, $data);
            }
            else if ($type == "number") {
                echo '<br><input type="number" id="'.$field.'" name ="' . $field . '" value="'.$data[$field].'" min="' . $rows . '" max="' . $cols . '" onchange="' .$onChange. '">';
                
            } else {
                echo '<input type="' . $type . '"id="' . $field . '" name="' . $field . '" value="' . $data[$field] . '"><br>' . PHP_EOL;
                $this->showError($field, $data);
            }
    }
    
    protected function showError($field, $data) {
        if (array_key_exists($field."Err", $data)) {
            echo '<span class="error"> ' . $data['' . $field . 'Err'] . ' </span><br>' . PHP_EOL;
        }
    }
    
    protected function showFormButton($submitButton, $action) {
        
        echo '<input type="submit" name="' . $action . '" value="' . $submitButton . '">';
    }
    
    protected function showFormEnd($page) {
        echo '<br><input name="page" value="' . $page . '" type="hidden">';
        echo '</form>'; 
    }

}
?>