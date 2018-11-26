<?php
    require_once('includes/init.php');
    global $session;

    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    for($i=0;$i<=15;$i++){
        if ($urlaray['question'.$i] != NULL){
        $cookie_name = "question".$i;
        $cookie_value = $urlaray['question'.$i];
        setcookie($cookie_name,$cookie_value, time() + (349329 * 30), "/");
        }
        
    }
        
?>


