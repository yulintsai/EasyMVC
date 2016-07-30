<?php
 echo "
    <form method='POST' action='/EasyMVC/Login/GoSignup'>
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
          <input type='hidden' name='u_ip' value='".$data."'/>
          <input type='submit' id='go_signup' name='signup' value='Sign Up' />
        </div>
    </form>";
?>