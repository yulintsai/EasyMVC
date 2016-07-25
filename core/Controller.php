<?php

class Controller {
    public function model($model) {
        require_once "../EasyMVC/models/$model.php";
        return new $model ();
    }
    
    public function view($view, $data = Array()) {
        require_once "../EasyMVC/views/$view.php";
    }
    
    public function css($css){
         echo "<link rel='stylesheet' href='/EasyMVC/css/".$css.".css'>";
     }
    
    public function js($js){
        echo "<script type='text/javascript' src='/EasyMVC/js/".$js.".js'></script> ";
    }
    
}

?>
