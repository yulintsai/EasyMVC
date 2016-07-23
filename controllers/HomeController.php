<?php
class HomeController extends Controller {
    
    function index() {
        echo "home page of HomeController";
    }
    
    function hello($name) {
        $user = $this->model("User");
        $user->name = $name;
        $this->view("Home/hello", $user);
        // echo "Hello! $user->name";
    }
    
    function loginPage(){
        $this->view("Home/index");
    }   
    function Gologin(){
        $this->model("Login");
        $login=new Login();
        $login->CheckLogin();
    }
    
}
?>