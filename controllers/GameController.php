<?php
class GameController extends Controller {
    
    
    function index() {
        $this->view("index");
    } //首頁的頁面
    
    function loginPage(){
        $this->view("/EasyMVC/");
    }   //登入的頁面
    
    function Gologin(){
        if(isset($_POST['login'])){
        $login= $this->model("Login");
        $login->CheckLogin();
        }else{
   echo "<script> alert('Error!');</script>";
        }
    }     //驗證登入資料
    
    function loadSignup(){
        $load = $this->model("load");
        $load->loadSign();
    }  //載入註冊畫面
    
    function GoSignup(){
        $gotosn = $this->model("player");
        $gotosn->GoSignup();
    }    //進行註冊
    
    function Goedit(){
        $edit=$this->model("edit");
        $edit->goEdit();
        
    }  //進行編輯
   /*==========================================================*/ 
    
    function CountOnlinePlayer(){
        $playerC = $this->model("player");
        $playerC->CountOnlinePlayer();
    } //計算線上玩家
    
    function UserLvExp(){
        $LvExp = $this->model("player");
        $LvExp->UserLvExp();
    } //玩家經驗值資料
    
    function UserLogScore(){
        $score = $this->model("player");
        $score->UserLogScore();
          
        }//查分數紀錄
    
    function GlobalRank(){
        $rank = $this->model("player");
        $rank->GlobalRank();
    } //全部玩家排行
    
    
   /*==========================================================*/   
    function UpdateStatus(){
        $update = $this->model("player");
        $update->pUpdateStatus();
    } //更新使用者狀態
    
    function endGame(){
        $end = $this->model("game");
        $end->endGame();
    }     //遊戲結束時動作
}
?>