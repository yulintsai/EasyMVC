<?php
class GameController extends Controller {
    
    function index() {
        $this->view("index");
    }      //首頁的頁面
    
    function loginPage(){
        $this->view("/EasyMVC/");
    }   //登入的頁面
    
    function AddVisitor(){
        $add = $this->model("player");
        $add->addVisitor();
    }  //統計瀏覽人數
    
    function Gologin(){
        if(isset($_POST['login'])){
        $account =  $_POST["Account"];
        $password= $_POST["Password"];    
        $login= $this->model("Login");
        $Errmsg=$login->CheckLogin($account,$password);
        $this->view("showOnedata",$Errmsg);
        }else{
            $ans= "<script> alert('Error!');</script>";
            $this->view("showOnedata",$ans);
        }
    }     //驗證登入資料
    
    function loadSignup(){
        $load = $this->model("load");
        $load->loadSign();
    }  //載入註冊畫面
    
    function GoSignup(){
        $gotosn = $this->model("player");
        $ans=$gotosn->GoSignup();
        $this->view("showOnedata",$ans);
    }    //進行註冊
    
    function loadEdit(){
        $findAcc = $this->model("player");
        $usremail=$findAcc->searchUserdata();
        $load = $this->model("load");
        // $ErrorMsg= "<script>alert(".$row.")</script>";
        $ans=$load->loadEdit($usremail);
        $this->view("showOnedata",$ans);
    }    //載入編輯畫面
    
    function GoEdit(){
        if(isset($_POST['go_edit'])){
        
        if($_POST['Password']=="")
        $ErrorMsg= 'Password empty';
        if($_POST["Username"]=="")
        $ErrorMsg= 'UserName empty';
        if($_POST['Email']=="")
        $ErrorMsg= 'E-mail empty';
        if($_POST['Password']!==$_POST['RePassword']){
        $ErrorMsg= 'Password Not The Same';}
        else{
        $edit=$this->model("edit");
        $edit->edit();
        }
        $this->view("showOnedata",$ErrorMsg);
        }
    }      //進行編輯
    
    /*==========================================================*/
    
    // SELECT
    
    // INSERT
    
    // UPDATE
    
    // DELETE
    
    
   /*==========================================================*/ 
    
    function CountOnlinePlayer(){
            $playerC = $this->model("player");
            $min=3;                         //設定間隔時間
            $ans=$playerC->CountOnlinePlayer($min);
            $this->view("showOnedata",$ans);
        } //計算線上玩家
    
    function UserLvExp(){
        $LvExp = $this->model("player");
        $p_score=$LvExp->UserLvExp();
        $lv=(ceil($p_score/50)+1);//玩家等級
        $exp=(($p_score%50)*2);//玩家經驗值
        $data=array($lv,$exp,$p_score,$user_id);
        $this->view("showLvExp",$data);
    }         //玩家經驗值資料
    
    function UserLogScore(){
        $score = $this->model("player");
        $result=$score->showUserLogScore();
        
        $ans="<table border='1px'width='100%' height='100%'> <td>NO.</td><td>Score</td>";
            foreach($result as $key=>$value){
               $ans.= "<tr><td>".($key+1)."</td><td>".$result[$key][0]."</td></tr>";
            }
        $ans.= "</table>";
        $this->view("showOnedata",$ans);
          
        }      //查分數紀錄
    
    function GlobalRank(){
        $rank = $this->model("player");
        $rank_score=$rank->showGlobalRank();
        
        $ans= "<table border='1px'width='100%' height='100%'> <td>Rank</td><td>ID</td><td>Score</td>";
        foreach ($rank_score as $key=>$value) {
           $ans.= "<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
           }
        $ans.= "</table>";
        $this->view("showOnedata",$ans);
        
    }        //查詢全部玩家排行
    
   /*==========================================================*/  
   
    function UpdateStatus(){
        
        if($_GET['status']){
            
            $update = $this->model("player");
            $update->UpdateStatus();
            
        }else{
            
            $ans= " UpdateStatus Error";
            $this->view("showOnedata",$ans);
            
        }
    }     //更新使用者狀態
    
    function startGame(){
        
        //一顆球的配色
      // if(isset($_GET["start"]))
        if(!isset($_GET['lv'])){
           $this->view("showOnedata",'Error');
        }else{
            $start=$this->model("game");
            $ballNum=0;
            do{
                $ans=$start->CreateColorBall($ballNum,$ans[0]);
                
                if($ballNum==0){
                
                $ball=array($ans[1]);
                    
                }elseif($ballNum>0){
                    array_push($ball,$ans[1]);
                }else{
                    exit();
                    
                }
                $ballNum=$ballNum+1;
            }while($ballNum<$_GET["lv"]);
            
            $this->view("showForeach",$ball);//到view echo球
        }
    }        //啟動遊戲動作
    
    function endGame(){
        
        if(!isset($_GET["score"])){
                $this->view("showOnedata","Error");
        }else{
                $end = $this->model("game");
                $ans = $end->insertScore();
                $this->view("showOnedata", $ans);
        }
    }          //遊戲結束時動作

}
?>