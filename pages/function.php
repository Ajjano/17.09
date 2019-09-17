<?php
function Connect(
    $host='localhost',
    $username='root',
    $password='11111111',
    $dbname='tour_travel_db'
){
    $link=mysql_connect($host,$username,$password);
    mysql_select_db($dbname);
    mysql_query('set names "utf8"');
    $err=mysql_errno();
}
function checkErrors(){
    $err=mysql_errno();
    if($err){
        echo "<h3><span style='color:red;'>Error code: $err</span></h3>";
        return false;
    }
    return true;
}
function register($login, $password, $email){
    $login=trim(htmlspecialchars($login));
    $password=md5(trim(htmlspecialchars($password)));
    $email=trim(htmlspecialchars($email));

    if($login==''||$password==''||$email==''){
        echo "<h3><span style='color:red;'>You must fill all the fields</span></h3>";
        return false;
    }
    $ins="insert into users(login, password, email, role_id) VALUES ('$login','$password', '$email',2)";
    connect();
    mysql_query($ins);
    return checkErrors();
}