<?php

class GameController extends Controller {
    
    
    /*==========================================================*/
    
    function CountOnlinePlayer(){
            $playerC = $this->model("player");
            $min=3;                         //設定間隔時間
            $ans=$playerC->CountOnlinePlayer($min);
            $this->view("showOnedata",$ans);
        } //計算線上玩家
    
    function UserLvExp(){
        $LvExp = $this->model("player");
        $result=$LvExp->UserLvExp();
        $lv=(ceil($result["score"]/50)+1);//玩家等級
        $exp=(($result["score"]%50)*2);//玩家經驗值
        $data=array($lv,$exp,$result["score"],$result["user_id"]);
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
            $find = $this->model("data");
            $myip = $find->getIP();
            $update = $this->model("player");
            $update->UpdateStatus($_GET['status'],$myip);
            
        }else{
            
            $ans= " UpdateStatus Error";
            $this->view("alertMsg",$ans);
            
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
                $find = $this->model("data");
                $myip = $find->getIP();
                $ans=$start->CreateColorBall($ballNum,$ans[0],$myip);
                
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
                $find= $this->model("data");
                $myip=$find->getIP();
                $end = $this->model("game");
                $ans = $end->insertScore($_GET["score"],$myip);
                $this->view("showOnedata", $ans);
        }
    }          //遊戲結束時動作
    
   
        

}
?>