function keyFunction() {
    if (event.keyCode==37){$('#2').click();}//左鍵
    
    if (event.keyCode==39){$('#1').click();}//右鍵
    
    if (event.keyCode==27) { $('#logout').click();}//ESC
    
    if (event.keyCode==88) { 
        $.ajax({
		  	url: "ShowOnlinePlayer.php",
		  	type:"POST",
		  	success:function(data){$('#show_online').append(data);}
		  });}//ESC
	if (event.keyCode==109){document.location.href="../../V2/index.php";}	  
}
document.onkeydown=keyFunction;