 <?php 
    //一顆球的配色
   $x=0;// if(isset($_GET["start"])){
if(!isset($_GET['lv'])){
       echo 'Error';
   }else{
   $num_ball = $_GET["lv"];
   function CreateColorBall($num_ball){
    do{
        $ball= array("color","rd"); //宣告球的資訊陣列
        $bc=&$ball['color']; //$bc為ball陣列key值為color的變數
        $bc = array("BLACK","WHITE","GRAY","RED","PINK","YELLOW","GREEN","BLUE","ORANGE","PURPLE");  //將球的顏色放入ball陣列key值為color的中
        //$ballstring="";
        $ball["rd"]= array_rand($bc,3); //從陣列隨機取得三個顏色
        $all_color=array();
        for($i=0;$i<3;$i++){ 
        $all_color[]=$bc[$ball["rd"][$i]];
            }
       /* switch ($mode) {
            case '0':$font_c=$all_color[rand(0,2)]; //隨機模式
                // code...
                break;
            case '1':$font_c=$all_color[2]; //完全正確模式
                // code...
                break;
            case '2':$font_c=$all_color[rand(0,1)];//整人模式
                // code...
                break;
            default: $font_c=$all_color[rand(0,2)];
                // code...
                break;
        }*/
        
 if(!isset($w_b)){//必有一個正確球還有錯誤球的隨機排列
      $test=rand(0,1);
    if($test==0){
      $w_b=-1;
            //打開錯誤球產生
            $font_c=$all_color[2]; //正確球
        }else{
            $font_c=$all_color[rand(0,1)];//錯誤球
        $w_b=1;
        }
        }elseif($w_b<0){
            $font_c=$all_color[rand(0,1)];
            unset($w_b);
        }else if($w_b>0){
            $font_c=$all_color[2];
            unset($w_b);
        }
        $num=$x+1;
        
        $ans=($all_color[2]==$font_c)?('2'):('-2');
        ($ans>0)?($BallColorAns='True'):($BallColorAns='False');
        //產生球
        //並將配色分配到style內
        echo "<button class='ball' id='$num' name='$ans'
                            style='
                            border:$all_color[0] 15px solid;
                            color: $all_color[1];
                            background-color:$all_color[2];'
                            ;>
                            $font_c</button>";
                            
        include("mysql.inc.php");
        include("GetIP.php");
        session_start();
        $u_id=$_SESSION['u_id'];
        $sql="INSERT INTO `CreateBall_Log`(`u_id`,`Ball`, `Color1`, `Color2`, `Color3`, `BallColorAns`, `IP`)
        VALUES('$u_id','$num','$all_color[0]','$all_color[1]','$all_color[2]','$BallColorAns','$myip')";
        $mysqli->query($sql);
        $mysqli->close();
                            
                            
                            
                            
       //echo "<script>var b_ans_$num=$ans</script>";
       unset( $font_c);
        $x=$x+1;
    }while($x<$num_ball);
}
CreateColorBall($num_ball);
//產生$num_ball顆色球
  //   }
}
        //
 ?>