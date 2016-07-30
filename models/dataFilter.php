<?php
    class dataFilter{
        function __construct(){
            Server::setConnect();
        }
        
        function test_input($data) {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          $data = Server::$mysqli->real_escape_string($data);
          return $data;
        } //過濾Input
        
        
        
    }
?>