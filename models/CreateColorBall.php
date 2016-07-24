<?php 
    include("game.php");
    session_start();
    $u_id=$_SESSION['u_id'];
    //一顆球的配色
  // if(isset($_GET["start"])){
    if(!isset($_GET['lv'])){
       echo 'Error';
    }else{
        $yu = new Game();
        $yu->startGame($_GET["lv"],$link,$u_id,$myip);    
    }
    
 ?>