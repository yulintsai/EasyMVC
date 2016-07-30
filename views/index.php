
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
$this->css('bootstrap');
$this->js('jquery-3.0.0');
$this->js('AllFunction');?>

<link rel="Shortcut Icon" type="image/x-icon" href="img/icon.ico" />
<title>ColorBall</title>
</head>

<body>


    <div id='main_screen'>
        <p style="top: 15%;left: 15%;position:fixed;">Welcome </p>
    </div>
    <div id="login_div"style="bottom: 20%;position: fixed;bottom: 15%;left: 45%;">
        <form method="post" action="Login/Gologin" id="login_form">
            <table align="center">
             <tr>
               <td><div style="width: 30%;position: fixed;left: 37%;bottom: 15.5%;">
                   <input class="C_input" type="text" name="Account" placeholder="Account" autocomplete="on"  onkeyup="value=value.replace(/[^\w\.\/]/ig,'')"   size="15" maxlength="10"/> 
                    <input class="C_input" type="password" name="Password"placeholder="Password" size="15" maxlength="10"  style='color: aliceblue' /></div>
                    <input type="submit" id="login_btn" name="login" value="Login" style='width:45%'/>
                    <input type="button" id="signup_btn" value="Sign Up"/>
               </td></tr>
            </table>
        </form>
    </div>
</body>
</html>