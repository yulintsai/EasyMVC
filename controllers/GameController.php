<?php
class GameController extends Controller {
    
    
    function index() {
        $this->view("index");
    }
    
    function loginPage(){
        $this->view("/EasyMVC/");
    }   
    
    function Gologin(){
        if(isset($_POST['login'])){
        $login= $this->model("Login");
        $login->CheckLogin();
        }else{
   echo "<script> alert('Error!');</script>";
        }
    }
    
    function GoSignup(){
        $gosn = $this->model("player");
        $gosn->GoSignup();
    }
    
    function Goedit(){
        $edit=$this->model("edit");
        $edit->goEdit();
        
    }
   /*==========================================================*/ 
    function GameView(){
        $this->view("Home/index");
    }
    
    function CountOnlinePlayer(){
        $playerC = $this->model("player");
        $playerC->CountOnlinePlayer();
    }
    
    function UserLvExp(){
        $LvExp = $this->model("player");
        $LvExp->UserLvExp();
    }
    
    function UserLogScore(){
        $score = $this->model("player");
        $score->UserLogScore();
          
        }//查分數紀錄
    
    function GlobalRank(){
        $rank = $this->model("player");
        $rank->GlobalRank();
    }
    
    
   /*==========================================================*/   
    function UpdateStatus(){
        $update = $this->model("player");
        $update->pUpdateStatus();
    }
    
    function endGame(){
        $end = $this->model("game");
        $end->endGame();
    }
}
?>