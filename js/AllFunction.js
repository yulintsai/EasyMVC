var music=new Array("/EasyMVC/voice/button.wav","/EastMVC/voice/correct.mp3");
function playSound(i){
	//在Div內放置Embed並指定其src = 某音效位置
	document.getElementById("sounds").innerHTML = 
	"<embed width=0 height=0 src=../voice/"+music[i]+" autostart='true'></embed>";
	}
	//產生音效

function startgame_lv(lv)
{

 
 
  /*---------------------產生愛心----------------------------*/
 
       url="/EasyMVC/models/CreateColorBall.php?lv="+lv;        //去撈球
       $.get(url,function(data){
       $('div#ball_box').append(data);
     
               $('.ball').mouseover(function(){ //滑鼠移入球上時
               $(this).css('height','220px');
               $(this).css('width','220px');
               });
          
               $('.ball').mouseout(function(){ //滑鼠離開球時
               $(this).css('height','200px');
               $(this).css('width','200px');
               });
              
               $('.ball').click(function(){//球被按到的時
                  $('.ball').prop("disabled",true);//鎖住球
                  $(this).animate({'width':'250px',
                                   'height':'250px',
                                   'opacity':'0.5',
                                   'left':'110%'},
                       function(){
                          $("#ball_box button").remove();
                          startgame_lv(lv);  //產生新球
                       });
      /*--------------------------BALL音效---------------------------------------*/
                  var ans=(Number($(this).prop("name")));
                  if(ans<0){playSound(0);}else{ playSound(1);}//產生音效
                  $(this).html("<h1 style='font-size:5em'>"+$(this).prop("name")+"</h1>");
                  ballsocre=(Number($(this).prop("name")));
                  score+=ballsocre;
                  
                  if(ballsocre>0){
                   combo+=1;//combo增加
                  }else{
                   $("#heart"+heart).remove();heart-=1;
                   combo=0;
                   //損失愛心
                  }
                  if(heart<1){t=0;}
                  comboscore(combo);
                  $('#combo').html("<h1 id='showcombo'style='color:white'>Combo<br>"+combo+"</h1>");
                  $('#start').val('score:'+score); //將分數丟到記分板
                  });
            });
       }
/**--------------combo加分器 ---------------------*/
function comboscore(combo) {
 if(combo>3){score+=1;  }
 if(combo>8){score+=2;  }
 if(combo>10){score+=2; }
 }
 
function CreateHearts(){
 
 for(var heart=3;heart>0;heart--){
  $("#heart").append("<img class='heart' id='heart"+heart+"'style='width:60px ;height:60px'src='img/heart.png'>");
 }
}
$(document).ready(function(){
 game_time=21;                        //設定遊戲秒數
  $('#player').load("/EasyMVC/Game/UserLvExp"); 
  
$("#start").click(function(){
 CreateHearts();
    $("#game_over,.i_m").hide();
    $("#ball_box button").remove();
    //$("#heart").append("<img style='width:60px ;height:60px'src='../img/heart.png'>");
    $(this).prop("value","Game Start"); //改變Start值
    $(this).prop("disabled",true);
        score=0,combo=0,heart=3;                    //重置分數&combo
        t+=game_time;                 //遊戲秒數
        showTime();                  //啟動時間倒數計時器
        startgame_lv(model);            //產生彩色球
        
     });


$("#replay").click(function(){ //按下Replay做的動作
 $("#game_over").hide(); 
 CreateHearts();
 t+=game_time;
 score=0,combo=0,heart=3;                      //重置分數&combo
 $("#g_time").css({"background-color":"inherit"});
  showTime();
  startgame_lv(2);
  $("#start").prop("value","Game Start");
 });
 
 
 
 $("#Learning").click(function() {
     $("#game_over,.i_m,#start").hide(500);
     startgame_lv(2);
     $("#Md").show();
     $("#ball_box button").remove();
     $("#g_c").text("Try To Choose Right ColorBall");
 });
 
 
 
 
$('#x').click(function(){$("#game_over").hide(1000);});//GAMEOVER畫面右上角按鈕

$('#close_gameover').click(function() {$("#game_over").hide(1000);});//GAMEOVER的CLOSE按鈕


$('#rank').click(function() {//GAMEOVER的RANK按鈕
    url_rank="/EasyMVC/Game/GlobalRank";
    $.get(url_rank,function(data){
    $('#user_scoreboard').html(data);});
});
  
// $('').click(function() { //左邊個人排行按鈕
//      $('#game_over').show(1000);
//      url_rank="/EasyMVC/models/UserLogScore.php?score="+score;
//      $.get(url_rank,function(data){
//      $('#user_scoreboard').html(data);});
// });
$('#log,#nav_rank').click(function() { //左邊個人排行按鈕
     $('#game_over').show(1000);
     url_rank="/EasyMVC/Game/UserLogScore?";
     $.get(url_rank,function(data){
     $('#user_scoreboard').html(data);});
});
/*$('#nav_rank').click(function() {
    $("#game_over").hide(1000);
}); */ 
$(".i_m").mouseover(function(){
 $(this).animate({'top':'39%'});
 $(this).animate({'top':'41%'});
 $(this).animate({'top':'39%'});
 $(this).animate({'top':'41%'});
 $(this).animate({'top':'40%'});
});
 $('.i_m').click(function() { //左邊模式選擇器按鈕
     $("#start").prop("value","START");
     gm=$(this).prop("id");
     
     function ChangeModel(){
             $('#g_c').text(gm);
             $('.i_m').hide(1000);
             $('#Md,#start').show(1000)
     }
     
       switch (gm) {
         case 'Easy':
             model=2;
           ChangeModel();
             // code
             break;
         case 'Normal':
             model=3
            ChangeModel();
             // code
             break;
         case 'Hard':
             model=4;
            ChangeModel();
             // code
             break;    
     }
     $('#gv_btm').show();
     
     
 });
  $('#Md').click(function() {
            $('#Md,#start,.ball').hide()
            $('#Easy,#Normal,#Hard,#Learning').show(500);
        });
  $("#edit").click(function(){
            $('.i_m,#start,#g_list').hide(500);
            $("#ball_box").load("/EasyMVC/models/Edit.php");
        });      
  $('#logout').click(function() {
      if(confirm("Are You Sure to Logout?"))
       {  
        document.location.href="/EasyMVC/models/Logout.php";
       }
       else
       {
       //alert("你按下取消");
       }
  })      
     
    
        
        
});