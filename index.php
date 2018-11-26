<?php
    require_once('includes/init.php');
    global $session;


    if (!$session->get_signed_in()){
        header('Location: login.php');
        exit;
    }
    
    $userName = $session->get_userName();
    $user=new User;
    $user->find_user_by_userName($userName);
?>


<!DOCTYPE html>
<html>
<head>
    <title>iMovies - מוצא את הסרט בשבילך</title>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Local CSS -->
	<link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
	
	<!-- Bootstap links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	
	<!-- Font link -->
	<link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
	
	<!-- JS+JQ scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function log_out(){
            window.location='logout.php';
        }
    </script>

</head>
<body>

<!-- Page Content -->

	<!-- Header -->
	<header>
        <?php
            if ($user->get_gender() == "נקבה"){
                echo '<h4 id="welcome">ברוכה הבאה '. $user->get_name() .' | <button onclick="log_out()">התנתקי</button></h4>';
            }
            else{
                echo '<h4 id="welcome">ברוך הבא '. $user->get_name() .' | <button onclick="log_out()">התנתק</button></h4>';
            }
        ?>
		
	</header>
    
	<!-- Main -->
        
    <main>
        <?php
            if ($user->get_finishStatus() == null)
                echo '<a id="go2quiz" href="movieQuiz.php"><img src="pic/mymovie.png"><br><h1>תמצא לי סרט</h1></a>';
            else if ($user->get_finishStatus() == false)
                echo '<a id="go2quiz" href="movieQuiz.php"><img src="pic/mymovie.png"><br><h1>המשך בסקר</h1></a>';
            else if ($user->get_finishStatus() == true)
                echo '<a id="go2quiz" href="myResults.php"><img src="pic/mymovie.png"><br><h1>הסרט שנבחר עבורך</h1></a>';
        ?>
        <a id="go2res" href="othersResults.php"><img src="pic/others.png"><br><h1>מה יצא לאחרים?</h1></a>

    </main>
</body>
</html>
