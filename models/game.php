<?php
   
    class Game{
        
        private $gameMode;
        private $score;
        var $font_c;//ball color word
        
        public function __construct(){
            Server::setConnect();
            Server::pdoConnect();
        }

    #=================================================    
        
        function insertScore($score,$myip){
               
                
                $u_id=$_SESSION['u_id'];
                $user_id=$_SESSION['user_id'];
                //連接資料庫
                $sql="INSERT INTO `GameLog`( `u_id`,`id`, `score`, `ip`) VALUES ('$u_id','$user_id','$score','$myip');";//存遊戲檔案
                $sql.="SELECT MAX(score) FROM  `GameLog` WHERE u_id ='$u_id';";//找到USER最高分是多少
                
                if (Server::$mysqli->multi_query($sql)){
                  do
                    {
                    // Store first result set
                    if ($result=Server::$mysqli->store_result()) {
                      // Fetch one and one row
                      while ($row=$result->fetch_row)
                        {
                          return "<h1>success update your score :".$score." <br>your best score is ".$row[0]."<br></h1>";
                        }
                      // Free result set
                      $result->free_result();
                      }
                    }
                  while (Server::$mysqli->next_result());
                }
                
                $log="INSERT INTO `UserLoginTime`(`u_id`,`Status`,`IP`) VALUES ('$u_id','PlayGame','$myip')";
                Server::$mysqli->query($log);//存分數
                
    



        }
        
    #=================================================    
        
        public function CreateColorBall($ballNum,$w_b,$myip){
            $u_id=$_SESSION['u_id'];
            $ball= array("color","rd"); //宣告球的資訊陣列
            $bc=&$ball['color']; //$bc為ball陣列key值為color的變數
            $bc = array("BLACK","WHITE","GRAY","RED","PINK","YELLOW","GREEN","BLUE","ORANGE","PURPLE");  //將球的顏色放入ball陣列key值為color的中
            $ball["rd"]= array_rand($bc,3); //從陣列隨機取得三個顏色
            $all_color=array();
            for($i=0;$i<3;$i++){ 
            $all_color[]=$bc[$ball["rd"][$i]];
                }
           /* switch ($mode) {
                case '0':$this->font_c=$all_color[rand(0,2)]; //隨機模式
                    // code...
                    break;
                case '1':$this->font_c=$all_color[2]; //完全正確模式
                    // code...
                    break;
                case '2':$this->font_c=$all_color[rand(0,1)];//整人模式
                    // code...
                    break;
            }*/
        
            $w_b = $this->checkW_b($w_b,$all_color);
            $num=$ballNum+1;
            
            $ans=($all_color[2]==$this->font_c)?('2'):('-2');
            ($ans>0)?($BallColorAns='True'):($BallColorAns='False');
            
            
    #=========================================================================================        
            
            $sql="INSERT INTO `CreateBall_Log`(`u_id`,`Ball`, `Color1`, `Color2`, `Color3`, `BallColorAns`, `IP`)
            VALUES('$u_id','$num','$all_color[0]','$all_color[1]','$all_color[2]','$BallColorAns','$myip');";
            Server::$db->query($sql);
    #==========================================================================================
            //產生球
            //並將配色分配到style內
            $ball= "<button class='ball' id='$num' name='$ans'
                                style='
                                border:$all_color[0] 15px solid;
                                color: $all_color[1];
                                background-color:$all_color[2];'
                                ;>
                                $this->font_c</button>";
            //unset($this->font_c);    
            $show= array($w_b,$ball);
            return $show;
                            
    }
        
        private function checkW_b($w_b,$all_color){
            if(!isset($w_b)){//必有一個正確球還有錯誤球的隨機排列$w_b為門票
                $test=rand(0,1);
                if($test==0){
                    //製造正確球
                    $this->font_c=$all_color[2]; //正確球
                        
                    return -1;
                }else{
                    $this->font_c=$all_color[rand(0,1)];//錯誤球
                    return 1;
                }
            }elseif($w_b<0){
                $this->font_c=$all_color[rand(0,1)];
                unset($w_b);
                return $w_b;
            }else if($w_b>0){
                $this->font_c = $all_color[2];
                unset($w_b);
                return $w_b;
            }
        }   
        
    #=================================================    
        
    }
    
    
    
    
?>