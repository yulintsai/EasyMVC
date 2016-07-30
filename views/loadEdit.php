<?php
/*
$data[0]=username
$data[1]=email
$data[2]=ip
*/
 echo "<form id='go_edit_form' method='post' action='/EasyMVC/Login/GoEdit'> <div>
<input class='C_input' type='text' id='Username'name='Username' placeholder='Username' autocomplete='on' value='".$data[0]."'
             size='15' maxlength='20'/> 
 <input class='C_input' type='password' id='Password' name='Password' placeholder='Password'
              size='15' maxlength='20'  style='color: aliceblue' />
        <input class='C_input' type='password' id='RePassword' name='RePassword'placeholder='Password Again'
              size='15' maxlength='20'  style='color: aliceblue' />
        <input type='email' class='C_input' placeholder='E-mail' id='Email' name='Email' value='".$data[1]."' style='color: aliceblue'/><p></p><br>
      <p style='background:blue;border: red 2px solid;color: aliceblue;'><input type='checkbox' name='DeleteAllScoreData' value='delete'> Clear Your Score</p> 
     <a href='index.php'><input type='button' value='back'/></a>
     <input type='submit' id='go_edit_btn' name='go_edit' value='Submit' /></div>
      
      <input type='hidden' id='u_ip'name='u_ip' value='".$data[2]."'/><br/>
      </div>
    </form>";
?>