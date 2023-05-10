<?php
include_once 'basic_doc.php';

abstract class FormsDoc extends BasicDoc {

    protected function showFormStart($field) {
        echo '<form method="post" action="index.php" id="'.$field.'">';
    }
    protected function showFormField($field, $label, $type, $options = array(), $rows = NULL, $cols = NULL, $onChange=NULL, $index = null) {
    
      $modelField = empty($index) ? $this->model->$field : $this->model->$field[$index];
      echo '<label for="' . $field . '">' . $label . ' </label><br>' . PHP_EOL;
      $error = ($field . "Err");
            if ($type == "select"){
                echo '<' . $type . ' id="' . $field . '" name="' . $field . '" ' . (empty($onChange) ? '' : 'onchange="' . $onChange . '"'). '>' . PHP_EOL;
                foreach($options as $key => $title) {
                    echo '<option value="' . $key .'"'; if (isset($modelField) && $modelField == "$key") echo "selected"; echo'>' . $title . '</option>' . PHP_EOL;
                }   echo '</select><br>' . PHP_EOL;            
                echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;
            }   
            
            else if ($type == "radio") {
                foreach ($options as $key => $contactoptions) {
                    echo  '<input type="radio" id="' . $field . $key . '" name="' . $field . '"'; if (isset($modelField) && $modelField== "$key") echo "checked"; echo' value="' . $key . '" > 
                    <label for="' . $field . $key . '">' . $contactoptions . '</label><br>';
                }
                echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;
            } 
            
            else if ($type == "textarea") {
                echo '<textarea name ="' . $field . '" rows="' . $rows . '" cols="' . $cols . '">' . $modelField. '</textarea><br><br>';
                echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;
            }
            else if ($type == "number") {
                echo '<br><input type="number" id="'.$field.'" name ="' . $field . '" value="' . $modelField . '" min="' . $rows . '" max="' . $cols . '" onchange="' .$onChange. '">';
                
            } else {
                echo '<input type="' . $type . '"id="' . $field . '" name="' . $field . '" value="' . $modelField. '"><br>' . PHP_EOL;
                echo '<span class="error"> ' . $this->model->$error . ' </span><br><br>' . PHP_EOL;
            }
    }

    protected function showHiddenFormButton($field, $value) {
        echo '<input type="hidden" id="' . $field . '" name="' . $field . '" value="' . $value . '">';
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