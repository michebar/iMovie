<!DOCTYPE html>
<html>
<head>
	<title>iMovies - מוצא את הסרט בשבילך</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!-- Local CSS -->
	<link rel="stylesheet" type="text/css" href="css\connect.css">
    <link rel="stylesheet" type="text/css" href="css\default.css">
    
	<!-- Bootstap links -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
	<!-- Font link -->
	<link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
	
	<!-- JS+JQ scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
</head>
<body>

<!-- Page Content -->
	<!-- Header -->
	<header>

	</header>
	

	<!-- Main -->
	<main>
        <h1 style="text-align: center"><b>iMovies</b><br>התחבר לצורך קבלת המלצה לסרט</h1>
<!--    Log-in div-->
        <div id="connect">
            <ul class="nav nav-tabs"> 
                <li class="active"><a href="#">התחברות</a></li>
                <li><a href="#" class="switch">הרשמה</a></li>
            </ul>
            
            <p class="formIntro">אנא הזן את פרטי ההתחברות:</p>
			<form id="connectForm">
                <p><label>שם משתמש: <input type="text" name="userName" id="userName" ></label></p>
                <p><label>סיסמה: <input type="password" name="password" id="password" ></label></p>
                <p id="loginError"></p>
			</form> 
            
            <p><input class="button" type="button" value="התחבר" onclick='login()' form="connectForm"></p>
		</div>
		
<!--    Sign-in div-->
        <div id="register" style="display:none">
            <ul class="nav nav-tabs">
                <li><a href="#" class="switch">התחברות</a></li>
                <li class="active"><a href="#">הרשמה</a></li>
            </ul>
            
            <p class="formIntro">במידה והנך משתמש חדש, הזן את הפרטים הבאים:</p>
			<form id="registerForm">
                <p><label>שם משתמש: <input name="userName" type="text" id="newUserName"></label></p>
                <p><label>סיסמה: <input type="text" name="password" id="newPassword"></label></p>
                <p><label>שם פרטי: <input type="text" name="name" id="name"></label></p>
                <p><label>עיר מגורים: <input type="text" name="city" id="city"></label></p>
                <p><label>גיל: <input type="text" name="age" id="age"></label></p>
                <p><label>מין:
                    <select id="gender" name="gender" id="gender">
                        <option>נקבה</option>
                        <option>זכר</option>
                    </select></label>
                </p>
                <p id="signinError"></p>
			</form> 
            
            <p><input class="button" type="button" value="הרשם" onclick='signin()' form="registerForm"></p>    
		</div>
        
	</main>
    

    <script>
        // Switch between log-in and sign-in options
        $(".switch").click(function(){
            $("#register").toggle();
            $("#connect").toggle();
        }); 
        
    
        function login(){
            var request=new XMLHttpRequest();

            request.onreadystatechange=function(){
                if (request.readyState==4 & request.status==200){
                    var myObj = JSON.parse(this.responseText);
                    if (myObj.code == 1)
                        window.location.href = "index.php";
                    else
                        document.getElementById("loginError").innerHTML=myObj.loginError;
                }
            }
            
            request.open("POST",'validateLogin.php',true);
            request.setRequestHeader('Content-type','application/json');
            var user_data = { 
              "userName" : document.getElementById("userName").value,
              "password": document.getElementById("password").value,
            }
            
            var data= JSON.stringify(user_data);
            request.send(data);
        }
        
        function signin(){
            var request = new XMLHttpRequest();

            request.onreadystatechange=function(){
                if (request.readyState==4 & request.status==200){
                    var myObj = JSON.parse(this.responseText);
                    if (myObj.code == 1){
                        swal({  title: 'נרשמת בהצלחה!',  text: 'כעת התחבר',  icon: 'success',  buttons: true, buttons: ['ביטול', 'המשך להתחברות'], }) .then((ok) => { if (ok) { window.location.href = "index.php";  } });
                    }
                    else
                        document.getElementById("signinError").innerHTML=myObj.signinError;
                    }
            }
            
            request.open("POST",'validateSignin.php',true);
            request.setRequestHeader('Content-type','application/json');
            var user_data = { 
              "newUserName" : document.getElementById("newUserName").value,
              "newPassword": document.getElementById("newPassword").value,
              "name": document.getElementById("name").value,
              "city": document.getElementById("city").value,
              "age": document.getElementById("age").value,
              "gender": document.getElementById("gender").value,
            }
            
            var data= JSON.stringify(user_data);
            request.send(data);
        }
    </script>
	
</body>
</html>