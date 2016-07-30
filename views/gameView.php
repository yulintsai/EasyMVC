
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" 
xmlns:og="http://ogp.me/ns#" 
xmlns:fb="http://www.facebook.com/2008/fbml">
<!-- oncontextmenu="window.event.returnValue=false;"
onselectstart="return false;"
oncontextmenu="window.event.returnValue=false;alert('雨霖版權所有')" -->
<head>
<meta charset="utf-8" />
<meta property="og:url" content="https://lab-rain123473.c9users.io/project/php/"/> <!-- 分享網頁的連結 -->
<meta property="og:image" content="https://lab-rain123473.c9users.io/project/img/FBtest.jpg"/> <!-- 圖片URL -->
<meta property="og:title" content="ColorBall"/>
<meta name="og:description" content="A EASY GAME" />
<meta property="og:type" content="website"/>
<?php
$this->css('main');
$this->css('ball');
$this->css('bootstrap');
$this->js('jquery-3.0.0');
$this->js('Timer');
$this->js('EventKey');
$this->js('AllFunction');
$this->js('facebook');
$this->js('UpdateStatus');
?>
<link rel="Shortcut Icon" type="image/x-icon" href="img/icon.ico" />
<title>ColorBall</title>
</head>

<body>


    <div id="sounds"></div>
    <div id="game_over" style="display:none">
               <div id='user_info'>
                  <?php echo strtoupper($_SESSION['user_id']);?>
                   <button id='x' value="X"></button>
               </div>
               <div id='user_scoreboard'>
                   YOUR SCORE<br>
                   <div id='user_score'><h1></h1></div>
               </div>
               <div id="game_over_btn">
                   <button id='replay' style="left: 0%;display:none;">REPLAY</button>
                   <button id='log' style="left: 20%;">LOG</button>
                   <button id='rank' style="left: 40%;">RANK</button>
                   <button id='close_gameover'style="left: 60%;">CLOSE</button>
               </div>
           </div>
    <div id='g_view'>
                <div id='gv_top'>
                    <div id='gvt_u'></div>
                    <div style="color: red;">
                        <img id='edit'src="img/gear.png">
                        <h1 id="g_c">CHOOSE GAME MODEL</h1>
                    	<div id="sounds"></div>
                        <h1 id="g_time"></h1>
                    </div>
                    <div id='gvt_s'></div>
                </div>
                
                <div id='gv_main'>
                        <button class='i_m' id='Easy'>Easy</button>
                        <button class='i_m' id='Normal'>Normal</button> 
                        <button class='i_m' id='Hard'>Hard</button> 
                        <button class='i_m' id='Learning' style="right: 0%;width: 20%;">Learning</button> 
                    <div id='g_list'>
                        <button class='g_m' id='Md' style="display:none;">Model</button>
                        <button id='nav_rank'>Score</button> 
                    </div>
                    <div id="ball_box"></div>
                    <div id="combo"></div>
                    <div id="heart"></div>
                </div>
                <div id="show_online">Online Players<br></div>
                <div id="fb-root"></div>
                <div class="fb-like" data-send="true" data-width="450" data-show-faces="true"></div> 
                <div id='gv_btm' style="display:none">
                    <input type="submit" value="START" name="start" id="start"/>
                </div>
                <div><button id="logout">Logout</button></div>
    </div>
    <div id="player"></div>
    </body>
</html>