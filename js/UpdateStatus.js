       //狀態更新
       
$(document).ready(function(){
$('.i_m,button,.button').click(function(){
status=$(this).attr("id");
 url="/EasyMVC/Game/UpdateStatus?status="+status;
       $.get(url);
 ShowOnlinePlayers();
});
});