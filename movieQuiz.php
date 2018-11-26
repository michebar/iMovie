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
    
    if ($user->get_finishStatus() == true)
        header('Location: index.php');
        
    //set active status for user- boolean flag on db
    $user->set_start_quiz($userName);

?>


<!DOCTYPE html>
<html>
<head>
    <title>iMovies - מוצא את הסרט בשבילך</title>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Local CSS -->
	<link rel="stylesheet" type="text/css" href="css/Quiz.css">
	<link rel="stylesheet" type="text/css" href="css/default.css">
	
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
<body onload="get_cookie()">

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
        <h4><a id="back" href="index.php">חזרה למסך הראשי</a></h4>
		
	</header>
    
	<!-- Main -->
        
        <main>
<!--            Questions and movies menu-->
        <div id="bar">
            <div id="barPic">
            <a href="#" onclick="goToSection(0)"><img id="IM0" class="barM" src="pic/moviesPics/question1.jpg" style="border: #3B4963 2px outset; position:relative;top:-7px; width:5.5%;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2)"></a>
            <a href="#" onclick="goToSection(1)"><img id="IM1" class="barM" src="pic/moviesPics/question2.jpg"></a>
            <a href="#" onclick="goToSection(2)"><img id="IM2" class="barM" src="pic/moviesPics/question3.jpg"></a>
            <a href="#" onclick="goToSection(3)"><img id="IM3" class="barM" src="pic/moviesPics/question4.jpg"></a>
            <a href="#" onclick="goToSection(4)"><img id="IM4" class="barM" src="pic/moviesPics/Action-taken.jpg"></a>
            <a href="#" onclick="goToSection(5)"><img id="IM5" class="barM" src="pic/moviesPics/Horror-it.png"></a>
            <a href="#" onclick="goToSection(6)"><img id="IM6" class="barM" src="pic/moviesPics/Comedy-TheHangOver.jpg"></a>
            <a href="#" onclick="goToSection(7)"><img id="IM7" class="barM" src="pic/moviesPics/Action-tomRaider.png"></a>
            <a href="#" onclick="goToSection(8)"><img id="IM8" class="barM" src="pic/moviesPics/Horror-getout.jpg"></a>
            <a href="#" onclick="goToSection(9)"><img id="IM9" class="barM" src="pic/moviesPics/Romance-Titanic.jpg"></a>    
            <a href="#" onclick="goToSection(10)"><img id="IM10" class="barM" src="pic/moviesPics/Romance-aWalkToRemember.jpg"></a>
            <a href="#" onclick="goToSection(11)"><img id="IM11" class="barM" src="pic/moviesPics/Comedy-HorribleBosses.jpg"></a>
            <a href="#" onclick="goToSection(12)"><img id="IM12" class="barM" src="pic/moviesPics/Romance-notebook.png"></a>
            <a href="#" onclick="goToSection(13)"><img id="IM13" class="barM" src="pic/moviesPics/Comedy-the40.jpg"></a>
            <a href="#" onclick="goToSection(14)"><img id="IM14" class="barM" src="pic/moviesPics/Horror-dontbreathe.jpg"></a>
            <a href="#" onclick="goToSection(15)"><img id="IM15" class="barM" src="pic/moviesPics/Action-thor.jpg"></a>

            </div>
        </div>
<!--        form- display none until clicking the relevant question-->
        <div id="rightSide">
            <a id="prev" href="#" onclick="prev()" style="display:none"><i class="fa fa-angle-right"></i></a>
        </div>
        <form id="FormTest">
<!--        General questions -->
            <div class="Questions" id="M0">
            <h2 class='question'>שאלה מספר 1</h2>
            <h4>איך אתה מעדיף לבלות את סוף השבוע?</h4>
                <input id="hiddenradio0" type="radio" name="question0" value="-1" style="display:none">
                <p><label><input type="radio" name="question0" value="1"> בהופעת סטנד-אפ</label></p>
                <p><label><input type="radio" name="question0" value="2"> לצאת לדייט לאור נרות</label></p>
                <p><label><input type="radio" name="question0" value="3"> לצאת לטיול אקסטרים</label></p>
                <p><label><input type="radio" name="question0" value="4"> לעשות סיאנס</label></p>
                
            </div>
            <div class="Questions" id="M1" style="display: none">
            <h2 class='question'>שאלה מספר 2</h2>
            <h4>מי השחקן המועדף עלייך?</h4>
                <input id="hiddenradio1" type="radio" name="question1" value="-1" style="display:none">
                <p><label><input type="radio" name="question1" value="1"> סת׳ רוגן</label></p>
                <p><label><input type="radio" name="question1" value="2"> ריאן גוסלינג</label></p>
                <p><label><input type="radio" name="question1" value="3"> ג׳ייסון סטאהם</label></p>
                <p><label><input type="radio" name="question1" value="4"> הבובה צ׳אקי</label></p>
            </div>
            <div class="Questions" id="M2" style="display: none">
            <h2 class='question'>שאלה מספר 3</h2>
            <h4>מי הדמות האהובה עלייך?</h4>
                <input id="hiddenradio2" type="radio" name="question2" value="-1" style="display:none">
                <p><label><input type="radio" name="question2" value="1"> ג׳ואי מחברים</label></p>
                <p><label><input type="radio" name="question2" value="2"> בל מהיפה והחיה</label></p>
                <p><label><input type="radio" name="question2" value="3"> דומיניק ממהיר ועצבני</label></p>
                <p><label><input type="radio" name="question2" value="4"> הילדה מהצלצול</label></p>
            </div>
            <div class="Questions" id="M3" style="display: none">
            <h2 class='question'>שאלה מספר 4</h2>
            <h4>באופן כללי, איך היית מגדיר/ה את עצמך?</h4>
                <input id="hiddenradio3" type="radio" name="question3" value="-1" style="display:none">
                <p><label><input type="radio" name="question3" value="1"> מצחיק</label></p>
                <p><label><input type="radio" name="question3" value="2"> רומנטיקן</label></p>
                <p><label><input type="radio" name="question3" value="3"> אוהב אתגרים</label></p>
                <p><label><input type="radio" name="question3" value="4"> סקרן</label></p>
            </div>
<!--        movies rating -->
            <div id="M4" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> החטופה</p><img id="movies" src="pic/moviesPics/Action-taken.jpg">
                <input id="question4" type="hidden">
            </div>
            <div id="M5" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> It</p>
                <img id="movies" src="pic/moviesPics/Horror-it.png"><input id="question5" type="hidden">
            </div>
            <div id="M6" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> בדרך לחתונה עוצרים בוגאס</p>
                <img id="movies" src="pic/moviesPics/Comedy-TheHangOver.jpg"><input id="question6" type="hidden">
            </div>

            <div id="M7" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> תומב ריידר</p>
                <img id="movies" src="pic/moviesPics/Action-tomRaider.png"><input id="question7" type="hidden">
            </div>
            <div id="M8" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> צא</p>
                <img id="movies" src="pic/moviesPics/Horror-getout.jpg"><input id="question8" type="hidden">
            </div>
            <div id="M9" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> טיטאניק</p>
                <img id="movies" src="pic/moviesPics/Romance-Titanic.jpg"><input id="question9" type="hidden">
            </div>
            <div id="M10" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> סיפור אהבה בלתי נשכח</p>
                <img id="movies" src="pic/moviesPics/Romance-aWalkToRemember.jpg"><input id="question10" type="hidden">
            </div>
            <div id="M11" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> לחטוף את הבוס</p>
                <img id="movies" src="pic/moviesPics/Comedy-HorribleBosses.jpg"><input id="question11" type="hidden">
            </div>
            <div id="M12" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> היומן</p>
                <img id="movies" src="pic/moviesPics/Romance-notebook.png"><input id="question12" type="hidden">
            </div>
            <div id="M13" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> בתול בן 40</p>
                <img id="movies" src="pic/moviesPics/Comedy-the40.jpg"><input id="question13" type="hidden">
            </div>
            <div id="M14" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> אל תנשום</p>
                <img id="movies" src="pic/moviesPics/Horror-dontbreathe.jpg"><input id="question14" type="hidden">
            </div>
            <div id="M15" class="Movies" style="display: none">
                <p><b>דרג את הסרט: </b> ת'ור</p>
                <img id="movies" src="pic/moviesPics/Action-thor.jpg"><input id="question15" type="hidden">
            </div>
            
              
        <div id="rates" style="display: none">
            <a href="#" onclick="markStars(1)"><img id="S1" class="stars" src="pic/Rating/star.png"></a>
            <a href="#" onclick="markStars(2)"><img id="S2" class="stars" src="pic/Rating/star.png"></a>
            <a href="#" onclick="markStars(3)"><img id="S3" class="stars" src="pic/Rating/star.png"></a>
            <a href="#" onclick="markStars(4)"><img id="S4" class="stars" src="pic/Rating/star.png"></a>
            <a href="#" onclick="markStars(5)"><img id="S5" class="stars" src="pic/Rating/star.png"></a>
            <button class="buttons" id="S0" onclick="markStars(0);return false;">לא ראיתי</button>
        </div>

        </form>
        <div id="leftSide">
            <a id="next" href="#" onclick="next()" style="display: block;"><i class="fa fa-angle-left"></i></a>    
            
<!--        Save current form data -->
            <p><input type="button" class="buttons" form="FormTest" id="save" name="save" onclick="set_cookie()" value="שמור וצא"></p>
            <p><input id="finishButton" class="buttons" name="submit" type="button" form="FormTest" value="סיים סקר" onclick="finishQuiz()"></p>
            <p id="error"></p>
        </div>
    </main>
<script>
    
    //setting cookies for saving current form data until subbmiting
    function set_cookie(){
            var request = new XMLHttpRequest();

            request.onreadystatechange=function(){
            if (request.readyState==4 & request.status==200)
                window.location.href = "index.php";
            }
            
            request.open("POST",'setCookies.php',true);
            request.setRequestHeader('Content-type','application/json');
        
            //check if no answer was checked in a question
            if(document.querySelector("input[name='question0']:checked")==null)
                document.getElementById("hiddenradio0").checked = true;
            if(document.querySelector("input[name='question1']:checked")==null)
                document.getElementById("hiddenradio1").checked = true;
            if(document.querySelector("input[name='question2']:checked")==null)
                document.getElementById("hiddenradio2").checked = true;
            if(document.querySelector("input[name='question3']:checked")==null)
                document.getElementById("hiddenradio3").checked = true;
        
            //Using Ajax to send current data to server
            var quiz_answers = {
                "question0" : document.querySelector("input[name='question0']:checked").value,
                "question1" : document.querySelector("input[name='question1']:checked").value,
                "question2" : document.querySelector("input[name='question2']:checked").value,
                "question3" : document.querySelector("input[name='question3']:checked").value,
                "question4" : document.getElementById("question4").value,
                "question5" : document.getElementById("question5").value,
                "question6" : document.getElementById("question6").value,
                "question7" : document.getElementById("question7").value,
                "question8" : document.getElementById("question8").value,
                "question9" : document.getElementById("question9").value,
                "question10" : document.getElementById("question10").value,
                "question11" : document.getElementById("question11").value,
                "question12" : document.getElementById("question12").value,
                "question13" : document.getElementById("question13").value,
                "question14" : document.getElementById("question14").value,
                "question15" : document.getElementById("question15").value,
            }
            
            var data= JSON.stringify(quiz_answers);
            request.send(data);
        }
            
    //Pulling saved data from cookies and inject into the form fields
        function get_cookie(){
            var request = new XMLHttpRequest();
            
            request.onreadystatechange=function(){
                if (request.readyState==4 & request.status==200){
                    var form_inputs=JSON.parse(this.responseText);
                    for(var i=0;i<form_inputs.length;i=i+2){
                        if(form_inputs[i] != 'question0' && form_inputs[i] != 'question1' && form_inputs[i] != 'question2' && form_inputs[i] != 'question3')
                            document.getElementById(form_inputs[i]).setAttribute('value',form_inputs[i+1]);
                        else
                            if(form_inputs[i+1]!=-1)
                                document.getElementsByName(form_inputs[i])[form_inputs[i+1]].checked = true;
                    }
                }
            }
            
            request.open("POST",'getCookies.php',true);
            request.send();
            
        }
    
        function finishQuiz(){
        var request = new XMLHttpRequest();

        request.onreadystatechange=function(){
            if (request.readyState==4 & request.status==200){
                var myObj = JSON.parse(this.responseText);
                if (myObj.code == 1){
                    swal({  title: 'בוצע בהצלחה!',  text: 'המשך לצפייה בתוצאות',  icon: 'success',  buttons: true, buttons: ['ביטול', 'המשך'], }) .then((ok) => { if (ok) { window.location.href = "myResults.php";  } });
                }
                else
                    document.getElementById("error").innerHTML=myObj.error;
            }
        }

        request.open("POST",'finishQuiz.php',true);
        request.setRequestHeader('Content-type','application/json');

        //check if no answer was checked in a question
        if(document.querySelector("input[name='question0']:checked")==null)
            document.getElementById("hiddenradio0").checked = true;
        if(document.querySelector("input[name='question1']:checked")==null)
            document.getElementById("hiddenradio1").checked = true;
        if(document.querySelector("input[name='question2']:checked")==null)
            document.getElementById("hiddenradio2").checked = true;
        if(document.querySelector("input[name='question3']:checked")==null)
            document.getElementById("hiddenradio3").checked = true;
        $userName = '<?php echo $user->get_UserName() ?>';
        
            //Using Ajax to send current data to server
        var quiz_answers = {
            "userName" : $userName,
            "question0" : document.querySelector("input[name='question0']:checked").value,
            "question1" : document.querySelector("input[name='question1']:checked").value,
            "question2" : document.querySelector("input[name='question2']:checked").value,
            "question3" : document.querySelector("input[name='question3']:checked").value,
            "question4" : document.getElementById("question4").value,
            "question5" : document.getElementById("question5").value,
            "question6" : document.getElementById("question6").value,
            "question7" : document.getElementById("question7").value,
            "question8" : document.getElementById("question8").value,
            "question9" : document.getElementById("question9").value,
            "question10" : document.getElementById("question10").value,
            "question11" : document.getElementById("question11").value,
            "question12" : document.getElementById("question12").value,
            "question13" : document.getElementById("question13").value,
            "question14" : document.getElementById("question14").value,
            "question15" : document.getElementById("question15").value,
        }

        var data= JSON.stringify(quiz_answers);
        request.send(data);
    }
    

    //Navigation between sections functions
    var curr=0;
    function next(){
        document.getElementById('M'+curr).setAttribute('style','display:none');
        document.getElementById('IM'+curr).setAttribute('style','border:none');
        curr++;
        document.getElementById('M'+curr).setAttribute('style','display:block');
        document.getElementById('IM'+curr).setAttribute('style','border:#3B4963 3px outset;position:relative;top:-7px;width:5.5%;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.3)');
        
        document.getElementById('prev').setAttribute('style','display:block');
        if(curr<4){
            document.getElementById('rates').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
        }
        if(curr>=4){
            document.getElementById('rates').setAttribute('style','display:block');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
            markStarsForEach();
        }
        if(curr==15){
            document.getElementById('next').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 143%;');                
        }

    }

    function prev(){
        document.getElementById('M'+curr).setAttribute('style','display:none');
        document.getElementById('IM'+curr).setAttribute('style','border:none');
        curr--;
        document.getElementById('M'+curr).setAttribute('style','display:block');
        document.getElementById('IM'+curr).setAttribute('style','border:#3B4963 3px outset;position:relative;top:-7px;width:5.5%;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.3)');
        if(curr==0){
            document.getElementById('prev').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
             
        }
        if(curr<4){
            document.getElementById('rates').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
        }
        if(curr>=4){
            document.getElementById('rates').setAttribute('style','display:block');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
            markStarsForEach();
        }
        if(curr!=15){
            document.getElementById('next').setAttribute('style','display:block');
            document.getElementById('save').setAttribute('style','margin-top: 0;');

        }
        if(curr==15){
            document.getElementById('next').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 143%;');
        }

    }
        
    function goToSection(M){
        document.getElementById('M'+curr).setAttribute('style','display:none');
        document.getElementById('IM'+curr).setAttribute('style','border:none');
        document.getElementById('M'+M).setAttribute('style','display:block');
        document.getElementById('IM'+M).setAttribute('style','border:#3B4963 3px outset;position:relative;top:-7px;width:5.5%;box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.3)');
        curr=M;
        document.getElementById('prev').setAttribute('style','display:block');
        document.getElementById('next').setAttribute('style','display:block');
        if(curr==0){
            document.getElementById('prev').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 0;');         
        }
        if(curr<4){
            document.getElementById('rates').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 0;');
        }
         if(curr>=4){
            document.getElementById('rates').setAttribute('style','display:block');
             document.getElementById('save').setAttribute('style','margin-top: 0;');
            markStarsForEach();
        }
        if(curr!=15){
            document.getElementById('next').setAttribute('style','display:block');
            document.getElementById('save').setAttribute('style','margin-top: 0;');

        }
        
        if(curr==15){
            document.getElementById('next').setAttribute('style','display:none');
            document.getElementById('save').setAttribute('style','margin-top: 143%;');
        }

        
    }
    
    $(document).keydown(function(e) {
      if(e.keyCode == 37) { // left
        if(curr!=15)
            next();
        
      }
      else if(e.keyCode == 39) { // right
        if(curr!=0)
            prev();
      }
	else if(e.keyCode == 27) { // esc
        window.location = "index.php";
      }

    });

    
    //Movies Rating functions
    function markStars(x){
         for(var i=1;i<=5;i++){
            document.getElementById('S'+i).setAttribute('src','pic/Rating/star.png');
            document.getElementById('S0').setAttribute('style','color:white');
        }
        var val=parseInt(x);
        document.getElementById('question'+curr).setAttribute('value',val);
        
        for(var i=1;i<=val;i++){
            document.getElementById('S'+i).setAttribute('src','pic/Rating/star-full.png');
        }
        if(val==0){
                document.getElementById('S0').setAttribute('style','color:black');
        }
    }
    
    function markStarsForEach(){
        document.getElementById('S0').setAttribute('style','color:white');
        for(var i=1;i<=5;i++){
            document.getElementById('S'+i).setAttribute('src','pic/Rating/star.png');
            document.getElementById('S0').setAttribute('style','color:white');
        }
        val=parseInt(document.getElementById('question'+curr).value);
        for(var i=1;i<=val;i++){
            document.getElementById('S'+i).setAttribute('src','pic/Rating/star-full.png');
        }
        if(val==0){
            document.getElementById('S0').setAttribute('style','color:black');
        }
    }
            
       
    </script>

</body>
</html>
