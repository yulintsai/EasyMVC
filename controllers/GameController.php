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
        $login= $this->model("Login");
        $Errmsg=$login->CheckLogin();
        echo $Errmsg;
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
        echo $gotosn->GoSignup();
    }    //進行註冊
    
    function loadEdit(){
        $findAcc = $this->model("player");
        $usremail=$findAcc->searchUserdata();
        $load = $this->model("load");
        // echo "<script>alert(".$row.")</script>";
        echo $load->loadEdit($usremail);
    }    //載入編輯畫面
    
    function GoEdit(){
        if(isset($_POST['go_edit'])){
        
        if($_POST['Password']=="")
        echo 'Password empty';
        if($_POST["Username"]=="")
        echo 'UserName empty';
        if($_POST['Email']=="")
        echo 'E-mail empty';
        if($_POST['Password']!==$_POST['RePassword']){
        echo 'Password Not The Same';}
        else{
        $edit=$this->model("edit");
        $edit->edit();
        }
            
        }
    }      //進行編輯
    
    /*==========================================================*/
    
    // SELECT
    
    // INSERT
    
    // UPDATE
    
    
   /*==========================================================*/ 
    
    function CountOnlinePlayer(){
            $playerC = $this->model("player");
            $min=3;                         //設定間隔時間
            $ans=$playerC->CountOnlinePlayer($min);
            $this->view("showCountPlayers",$ans);
        } //計算線上玩家
    
    function UserLvExp(){
        $user_id=strtoupper($_SESSION['user_id']);
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
        
        echo "<table border='1px'width='100%' height='100%'> <td>NO.</td><td>Score</td>";
            foreach($result as $key=>$value){
               echo "<tr><td>".($key+1)."</td><td>".$result[$key][0]."</td></tr>";
            }
        echo "</table>";
        
          
        }      //查分數紀錄
    
    function GlobalRank(){
        $rank = $this->model("player");
        $rank_score=$rank->showGlobalRank();
        
        echo "<table border='1px'width='100%' height='100%'> <td>Rank</td><td>ID</td><td>Score</td>";
        foreach ($rank_score as $key=>$value) {
           echo "<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
           }
        echo "</table>";
        
    }        //查詢全部玩家排行
    
   /*==========================================================*/  
   
    function UpdateStatus(){
        
        if($_GET['status']){
            
            $update = $this->model("player");
            $update->UpdateStatus();
            
        }else{
            
            echo " UpdateStatus Error";
            
        }
    }     //更新使用者狀態
    
    function startGame(){
        session_start();
        $u_id=$_SESSION['u_id'];
        //一顆球的配色
      // if(isset($_GET["start"]))
        if(!isset($_GET['lv'])){
           echo 'Error';
        }else{
            $start=$this->model("game");
            $ballNum=0;
            do{
                $ans=$start->CreateColorBall($u_id,$ballNum,$ans[0]);
                
                if($ballNum==0){
                $colorball=$ans[1];
                $ans=array($colorball);
                    
                }elseif($ballNum>0){
                    array_push($ans,$colorball);
                }else{
                    exit();
                    
                }
                // $this->view("show",$colorball);
                $ballNum=$ballNum+1;
            }while($ballNum<$_GET["lv"]);
            
            $this->view("showColorBall",$ans);
        }
    }        //啟動遊戲動作
    
    function endGame(){
        
        if(!isset($_GET["score"])){
                echo "Error";
                  }else{
        $end = $this->model("game");
        echo $end->insertScore();
        
        }
    }          //遊戲結束時動作

}
?>