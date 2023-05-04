<?php
include_once 'basic_doc.php';

abstract class FormsDoc extends BasicDoc {

    protected function showFormStart($field) {
        echo '<form method="post" action="index.php" id="'.$field.'">';
    }
    protected function showFormField($field, $label, $type, $options = array(), $rows = NULL, $cols = NULL, $onChange=NULL) {
    
      echo '<label for="' . $field . '">' . $label . ' </label><br>' . PHP_EOL;
            if ($type == "select"){
                echo '<' . $type . ' id="' . $field . '" name="' . $field . '" ' . (empty($onChange) ? '' : 'onchange="' . $onChange . '"'). '>' . PHP_EOL;
                foreach($options as $key => $title) {
                    echo '<option value="' . $key .'"'; if (isset($this->model->$field) && $this->model->$field == "$key") echo "selected"; echo'>' . $title . '</option>' . PHP_EOL;
                }   echo '</select><br>' . PHP_EOL;            
                $this->showError($field, $this->model);
            }   
            
            else if ($type == "radio") {
                foreach ($options as $key => $contactoptions) {
                    echo  '<input type="radio" id="' . $field . $key . '" name="' . $field . '"'; if (isset($this->model->$field) && $this->model->$field == "$key") echo "checked"; echo' value="' . $key . '" > 
                    <label for="' . $field . $key . '">' . $contactoptions . '</label><br>';
                }
                $this->showError($field, $this->model);
            } 
            
            else if ($type == "textarea") {
                echo '<textarea name ="' . $field . '" rows="' . $rows . '" cols="' . $cols . '">' . $this->model->$field . '</textarea><br><br>';
                $this->showError($field, $this->model);
            }
            else if ($type == "number") {
                echo '<br><input type="number" id="'.$field.'" name ="' . $field . '" value="'.$this->model->$field.'" min="' . $rows . '" max="' . $cols . '" onchange="' .$onChange. '">';
                
            } else {
                echo '<input type="' . $type . '"id="' . $field . '" name="' . $field . '" value="' . $this->model->$field  . '"><br>' . PHP_EOL;
                $this->showError($field, $this->model);
            }
    }
    
    protected function showError($field, $model) {
            $field."Err";
            $this->model; 
            echo '<span class="error"> ' . $this->model->$field . 'Err</span><br>' . PHP_EOL;
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