<?php
    require_once('includes/init.php');
    global $session;
    
    $cookieValues=[];
    for($i=0;$i<=15;$i++){
        $cookie_name = "question".$i;
        if(isset($_COOKIE[$cookie_name])) {
            array_push($cookieValues,$cookie_name);
            array_push($cookieValues,$_COOKIE[$cookie_name]);
        } 
    }  

    $myJson=json_encode($cookieValues,true);
    echo $myJson;

?>


