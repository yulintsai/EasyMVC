       //狀態更新
       
$(document).ready(function(){
$('button,.button').click(function(){
status=$(this).attr("id");
 url="UpdateStatus.php?status="+status;
       $.get(url);
 ShowOnlinePlayers();
});
});