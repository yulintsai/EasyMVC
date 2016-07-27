<?php
class load{
    
    public function __construct(){
            Server::setConnect();
            IP::GetIP();
        }
    
    function GetIP(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            $myip = $_SERVER['HTTP_CLIENT_IP'];
         }else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $myip = $_SERVER['HTTP_X_FORWARDED_FOR'];
         }else{
            $myip= $_SERVER['REMOTE_ADDR'];
         }
         return $myip;
    }
    
    function loadSign(){
    $myip=$this->GetIP();
    echo "
    <form method='POST' action='/EasyMVC/Game/GoSignup'>
           <div id='signup'>
           <input class='C_input' type='text' name='Account' placeholder='Account' autocomplete='on' onkeyup='value=value.replace(/[^\w\.\/]/ig,'')' size='15' maxlength='20'/>   <p></p>
           <input class='C_input' type='text' name='Username' placeholder='Username' autocomplete='on' size='15' maxlength='20'/> <p></p>
           <input class='C_input' type='password' name='Password'placeholder='Password' size='15' maxlength='20'  style='color: aliceblue' /><p></p>
           <input class='C_input' type='password' name='RePassword'placeholder='Please Input Your Password Again'  size='15' maxlength='20'  style='color: aliceblue' /><p></p>
           <input type='email' class='C_input' placeholder='E-mail' name='Email'  style='color: aliceblue'/><p></p><br>
           <a href='index.php'><input type='button' id='go_login' name='go_login' value='Login' style='
            color: white;
            position: fixed;
            height: 8%;
            width: 19%;
            left: 30%;
            border-radius: 20px;
            margin-top: 2px;
            margin-bottom: 2px;
            background-image: url('https://lab-rain123473.c9users.io/project/img/red.jpg ');'></a>
          <input type='hidden' name='u_ip' value='$myip'/>
          <input type='submit' id='go_signup' name='signup' value='Sign Up' />
        </div>
    </form>";
} //載入註冊畫面
    
    function loadEdit(){
        $myip=$this->GetIP();
        $u_id=$_SESSION['u_id'];
        $edit1_sql='select account,email from UserData where u_id='.$u_id;
        $row=Server::$mysqli->query($edit1_sql)->fetch_row();
        
        
        echo "<form id='go_edit_form' method='post' action='/EasyMVC/Game/GoEdit'> <div>
<input class='C_input' type='text' id='Username'name='Username' placeholder='Username' autocomplete='on' value='".$_SESSION['user_id']."'
             size='15' maxlength='20'/> 
 <input class='C_input' type='password' id='Password' name='Password' placeholder='Password'
              size='15' maxlength='20'  style='color: aliceblue' />
        <input class='C_input' type='password' id='RePassword' name='RePassword'placeholder='Password Again'
              size='15' maxlength='20'  style='color: aliceblue' />
        <input type='email' class='C_input' placeholder='E-mail' id='Email' name='Email' value='".$row[1]."' style='color: aliceblue'/><p></p><br>
      <p style='background:blue;border: red 2px solid;color: aliceblue;'><input type='checkbox' name='DeleteAllScoreData' value='delete'> Clear Your Score</p> 
     <a href='index.php'><input type='button' value='back'/></a>
     <input type='submit' id='go_edit_btn' name='go_edit' value='Submit' /></div>
      
      <input type='hidden' id='u_ip'name='u_ip' value='$myip'/><br/>
      </div>
    </form>";
    }
    
    function addVisitor(){
        
        $sql="UPDATE information SET visit_num=visit_num+1";//games total

        if(Server::$mysqli->query($sql)){
        //echo "success +1 visit";
        }else{
            echo "error";
        }
    }
}
?>