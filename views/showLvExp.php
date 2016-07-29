<?php

/*
$data[0]=lv
$data[1]=exp%
$data[2]=exp
$data[3]=username
*/
 echo "<div id='lv'>Lv.".$data[0]."</div>
                     <div id='user'>".$data[3]."</div>
                     <div class='progress progress-striped'><div class='progress-bar progress-bar-success' role='progressbar' 
                  aria-valuenow='60' aria-valuemin='0' aria-valuemax='100' id='exp'style='width:$data[1]%'"."title=".$data[2]."/".($data[0]*50).">".$data[1]."%</div></div>";
?>