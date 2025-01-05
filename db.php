<?php
$host ='localhost';
$dbname = 'users_authentication_system';
$username = 'root';
$password = '';

try{
    $conn = new mysqli($host, $username, $password, $dbname);
    
} catch(Exception $e) {
    echo 'connection failed: '. $e->getMessage();
}

?>