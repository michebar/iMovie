<?php
    require_once('includes/init.php');
    global $session;

    $urlContents = file_get_contents('php://input');
    $urlaray = json_decode($urlContents, true);

    $quizRes = new quizRes;

    //!is_numeric is used in order to except value 0
    if ($urlaray['question0'] == -1)
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 1');
    else if ($urlaray['question1'] == -1)
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 2');
    else if ($urlaray['question2'] == -1)
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 3');
    else if ($urlaray['question3'] == -1)
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 4');
    else if (!is_numeric($urlaray['question4']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 5');
    else if (!is_numeric($urlaray['question5']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 6');
    else if (!is_numeric($urlaray['question6']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 7');
    else if (!is_numeric($urlaray['question7']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 8');
    else if (!is_numeric($urlaray['question8']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 9');
    else if (!is_numeric($urlaray['question9']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 10');
    else if (!is_numeric($urlaray['question10']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 11');
    else if (!is_numeric($urlaray['question11']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 12');
    else if (!is_numeric($urlaray['question12']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 13');
    else if (!is_numeric($urlaray['question13']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 14');
    else if (!is_numeric($urlaray['question14']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 15');
    else if (!is_numeric($urlaray['question15']))
        $post_data = array('code'=>0,'error'=>'*אנא הזן תשובה לשאלה 16');


    else{
        $quizRes->add_results($urlaray['userName'],$urlaray['question0'],$urlaray['question1'],$urlaray['question2'],$urlaray['question3'],$urlaray['question4'],$urlaray['question5'],$urlaray['question6'],$urlaray['question7'],$urlaray['question8'],$urlaray['question9'],$urlaray['question10'],$urlaray['question11'],$urlaray['question12'],$urlaray['question13'],$urlaray['question14'],$urlaray['question15']);
        
        $user = new user;
        $user->set_finish_quiz($urlaray['userName']);

        $post_data = array('code'=>1,'error'=>'');
    }
        
    $info = json_encode($post_data);
    echo $info;
        
?>


