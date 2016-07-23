var t=0;
function showTime(){
    if(t!=0){
    
    t -= 1;
    document.getElementById('g_time').innerHTML= "Time<br>"+t+"s";
    if(t<5){
      $("#g_time").css({"color":"red","background":"yellow"});
    }
     setTimeout("showTime()",1000);
    }else{ //GAMEOVER時間到做的事情
        $('.ball').prop("disabled",true);
        $("#g_time").text("Time up").css({"background-color":"inherit"});
        $('#start').prop("value","RESTART");
        $('#start').prop("disabled",false);
        
        $("#game_over").show(1000,function(){
            $("#replay").show();
            $("#ball_box button").remove();
            $("#user_score").html(score);
            $("#rank").trigger("click",10000); 
        });
        
            //在gameover時show出成績板
    
            
       url_score="GameOver.php?score="+score;
        $.get(url_score,function(data){
         $('#user_scoreboard').html(data);
         $('#lv,#user,#exp,#showcombo,.heart').remove();
         $('#player').load('UserLvExp.php');
       //傳送成績
        })
        
      //  $("#showbox button").remove();
       // t=t+10;
       // startgame_lv(2);
        /*if(confirm("是否再來一次")){
            
        }else{
        alert("你按下取消");
            }*/
        
    }
    
    
        //location.href='https://lab-rain123473.c9users.io/project/php/testphp/ball.php';
    

    //每秒執行一次,showTime()
   
    }
    
    
    //gameover 功能
    
    $('#x').click(function(){
        $("#gameover").hide();
        
    });
    
    