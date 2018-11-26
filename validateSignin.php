<?php
    require_once('includes/init.php');
    global $session;

    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    $user = new user;
    
    if (!$urlaray['newUserName'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן שם משתמש');

    else if($user->find_user_by_userName($urlaray['newUserName']))
        $post_data = array('code'=>0,'signinError'=>'*שם המשתמש תפוס');

    else if(!preg_match('/^[a-zA-Z][a-zA-Z0-9-_\.]{1,15}$/', $urlaray['newUserName']))
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן שם משתמש באנגלית בלבד');
    
    else if(!$urlaray['newPassword'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן סיסמה');

    else if(!$urlaray['name'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן שם פרטי');

    else if(!$urlaray['city'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן עיר');

    else if(!preg_match("/[\\x{0590}-\\x{05FF}]+/u", $urlaray['city']))
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן עיר בעברית');

    else if(!$urlaray['gender'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן מין');
    
    else if(!$urlaray['age'])
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן גיל');

    else if(!preg_match('/^[0-9]{1,2}$/', $urlaray['age']))
        $post_data = array('code'=>0,'signinError'=>'*אנא הזן גיל תקין');

    else{
        $result=$user->add_user($urlaray['newUserName'],$urlaray['newPassword'],$urlaray['name'],$urlaray['age'],$urlaray['gender'],$urlaray['city']);
        if ($result){
            $session->login($user);
            $post_data = array('code'=>1,'signinError'=>'');
        }
        else
            $post_data = array('code'=>0,'signinError'=>'*קרתה תקלה');
        }
        
    $info = json_encode($post_data);
    echo $info;

 
?>


