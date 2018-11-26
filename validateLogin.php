<?php
    require_once('includes/init.php');
    global $session;
    
    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);
    $user = new user;

    if (!$urlaray['userName'])
        $post_data = array('code'=>0,'loginError'=>'*אנא הזן שם משתמש');

    else if(!$user->find_user_by_userName($urlaray['userName']))
        $post_data = array('code'=>0,'loginError'=>'*המשתמש לא קיים');
    
    else if(!$urlaray['password'])
        $post_data = array('code'=>0,'loginError'=>'*אנא הזן סיסמה');
    
    else{
        
        if(user::authenticate_user($urlaray['userName'],$urlaray['password'])){
            $session->login($user);
            $post_data = array('code'=>1,'loginError'=>'');
        }

        else
            $post_data = array('code'=>0,'loginError'=>'*הסיסמה אינה נכונה');

    }
      
    $info = json_encode($post_data);
    echo $info;

 
?>


