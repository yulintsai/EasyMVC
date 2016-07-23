<?php
/*
class App {
    
    public function __construct() {
        $this->parseUrl();
    }
    
    public function parseUrl() {          //印出url上的東西
        if (isset($_GET["url"])) {
            echo $_GET["url"];
        }
    }
    
}*/



class App {
    
    public function __construct() {
        //var_dump($this->parseUrl());
     $url = $this->parseUrl();
        
      /*  $controllerName = "{$url[0]}Controller";
        echo $controllerName;
    $controllerName = "{$url[0]}Controller";//控制器名稱
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = $url[1];
        echo $methodName;
        unset($url[0]); unset($url[1]);
        $params = $url ? array_values($url) : Array();
        echo "<hr>";
        var_dump($params);   */

        $url = $this->parseUrl();
        
        $controllerName = "{$url[0]}Controller";
        if (!file_exists("controllers/$controllerName.php"))
            return;
        require_once "controllers/$controllerName.php";
        $controller = new $controllerName;
        $methodName = isset($url[1]) ? $url[1] : "index";
        if (!method_exists($controller, $methodName))
            return;
        unset($url[0]); unset($url[1]);
        $params = $url ? array_values($url) : Array();
        call_user_func_array(Array($controller, $methodName), $params);

        
        
        
        
        
    }
    
    public function parseUrl() {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/"); //將Url內容傳成陣列
            $url = explode("/", $url);
            return $url;
        }
    }
    
}

?>