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
        $("#ball_box button").remove();
        $("#g_time").text("Time up").css({"background-color":"inherit"});
        
        $("#game_over").show(1000,function(){
            $("#replay").show();
            $("#ball_box button").remove();
            $("#user_score").html(score);
            $("#rank").trigger("click",10000); 
        });
        
            //在gameover時show出成績板
    
            
       url_score="/EasyMVC/Game/endGame?score="+score;
        $.get(url_score,function(data){
         $('#user_scoreboard').html(data);
         $('#lv,#user,#exp,#showcombo,.heart').remove();
         $('#player').load('/EasyMVC/Game/UserLvExp');
       //傳送成績
         })
        }
    
    }
    
    
    //gameover 功能
    
    $('#x').click(function(){
        $("#gameover").hide();
        
    });
    
    