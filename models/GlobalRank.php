<!DOCTYPE html>
<html>
    

<body>

<?php
include("mysql.inc.php");

/*$maxsocre_sql="select id,score from g_log order by score desc limit 0,1;";
$max_score=mysqli_query($link, $maxsocre_sql);

$secondsocre_sql="select DISTINCT id,score from g_log order by score desc limit 1,1;";
$second_score=mysqli_query($link, $secondsocre_sql);

$thirdsocre_sql="select DISTINCT id,score from g_log order by score desc limit 2,1;";
$third_score=mysqli_query($link, $thirdsocre_sql);




if($max_score&&$second_score&&$third_score){

   $result_maxscore=mysqli_fetch_array($max_score);
   $result_secondscore=mysqli_fetch_array($second_score);
   $result_thirdscore=mysqli_fetch_array($third_score);
   
   echo "No.1 ID:".$result_maxscore[0].", Score:".$result_maxscore[1]."<br>";
   echo "No.2 ID:".$result_secondscore[0].", Score:".$result_secondscore[1]."<br>";
   echo "No.3 ID:".$result_thirdscore[0].", Score:".$result_thirdscore[1]."<br>";

    }else{
        
         echo "error";
    }*/
    
    
          $rank_sql="SELECT distinct id,score FROM GameLog order by score desc ,time asc limit 5";
          $rank_score=$mysqli->query($rank_sql);
          $result_rankscore=$rank_score->fetch_all();
          echo "<table border='1px'width='100%' height='100%'> <td>Rank</td><td>ID</td><td>Score</td>";
        foreach ($result_rankscore as $key=>$value) {
           echo "<tr><td>".($key+1)."</td><td>".$value[0]."</td><td>".$value[1]."</td></tr>";
          }
          echo "</table>";
$mysqli->close();

?>

    
</body>

</html>