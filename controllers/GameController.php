<?php
class GameController extends Controller {
    
    function index() {
        $this->view("index");
    }      //首頁的頁面
    
    function loginPage(){
        $this->view("/EasyMVC/");
    }   //登入的頁面
    
    function AddVisitor(){
        $add = $this->model("load");
        $add->addVisitor();
    }  //統計瀏覽人數
    
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
    
    function loadEdit(){
        $load = $this->model("load");
        $load->loadEdit();
    }    //載入編輯畫面
    
    function GoEdit(){
        $edit=$this->model("edit");
        //var_dump($edit);
        $edit->edit();
        
    }      //進行編輯
    
    
   /*==========================================================*/ 
    
    function CountOnlinePlayer(){
        $playerC = $this->model("player");
        $playerC->CountOnlinePlayer();
    } //計算線上玩家
    
    function UserLvExp(){
        $LvExp = $this->model("player");
        $LvExp->UserLvExp();
    }         //玩家經驗值資料
    
    function UserLogScore(){
        $score = $this->model("player");
        $score->UserLogScore();
          
        }      //查分數紀錄
    
    function GlobalRank(){
        $rank = $this->model("player");
        $rank->GlobalRank();
    }        //查詢全部玩家排行
    
    
   /*==========================================================*/   
    function UpdateStatus(){
        $update = $this->model("player");
        $update->UpdateStatus();
    }     //更新使用者狀態
    
    function startGame(){
        session_start();
        $u_id=$_SESSION['u_id'];
        //一顆球的配色
      // if(isset($_GET["start"]))
        if(!isset($_GET['lv'])){
           echo 'Error';
        }else{
            $yu=$this->model("game");
            $yu->startGame($_GET["lv"],$link,$u_id,$myip);    
        }
    }        //啟動遊戲動作
    
    function endGame(){
        $end = $this->model("game");
        $end->endGame();
    }          //遊戲結束時動作
    
    
}
?>