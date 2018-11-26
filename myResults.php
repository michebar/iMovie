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
    
    $quizRes = new quizRes;  
    $quizRes->find_res_by_userName($userName);

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
    <link rel="stylesheet" type="text/css" href="css/myRes.css">
	
	<!-- Bootstap links -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    	
	<!-- Font link -->
	<link href="https://fonts.googleapis.com/css?family=Heebo" rel="stylesheet">
	
	<!-- JS+JQ scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
     <!-- API TMDB version 3 documentation: 
        https://developers.themoviedb.org/3/search
        https://developers.themoviedb.org/3/movies
    -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function log_out(){
            window.location='logout.php';
        }
    </script>
</head>
<body onload="display_by_order()">

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
        <div style='display:none'>
            <form>
                <input id="comedyValue" type="hidden" value="<?php echo $quizRes->get_comedy() ?>">
                <input id="actionValue" type="hidden" value="<?php echo $quizRes->get_action() ?>">
                <input id="romanceValue" type="hidden" value="<?php echo $quizRes->get_romantic() ?>">
                <input id="horrorValue" type="hidden" value="<?php echo $quizRes->get_horror() ?>">
            </form>
        
        </div>

        <h1>הסרט המומלץ ביותר</h1>
        <div id="firstmovie">
        <!-- first movie -->
                    <h2 id="title1" class="movieTitle"></h2>
                    <img id="picture1"/>
                    <div class="details">
                        <h3 id='precentage1'>אחוזי התאמה: </h3>
                        <p id="genre1"> ג'אנר : </p>
                        <p id="date1"> יצא להקרנים : </p>
                        <p id="rate1"> ממוצע דירוג IMDB : </p>

                    </div>
        </div>

        <h1>שאר הסרטים</h1>
        <div id="movieSection">
        <!-- second movie -->
                <section id="second">
                    <h2 id="title2" class="movieTitle"></h2>
                    <img id="picture2"/>
                    <div class="details">
                        <h3 id='precentage2'>אחוזי התאמה: </h3>
                        <p id="genre2"> ג'אנר : </p>
                        <p id="date2"> יצא להקרנים : </p>
                        <p id="rate2"> ממוצע דירוג IMDB : </p>

                    </div>
                </section>

        <!-- third movie -->

                <section id="third">
                    <h2 id="title3" class="movieTitle"></h2>
                    <img id="picture3"/>
                        <div class="details">
                        <h3 id='precentage3'>אחוזי התאמה: </h3>
                        <p id="genre3"> ג'אנר : </p>
                        <p id="date3"> יצא להקרנים : </p>
                        <p id="rate3"> ממוצע דירוג IMDB : </p>

                    </div>
                </section>

        <!-- forth movie -->
                <section id="forth">
                    <h2 id="title4" class="movieTitle"></h2>
                        <img id="picture4"/>
                        <div class="details">
                        <h3 id='precentage4'>אחוזי התאמה: </h3>
                        <p id="genre4"> ג'אנר : </p>
                        <p id="date4"> יצא להקרנים : </p>
                        <p id="rate4"> ממוצע דירוג IMDB : </p>

                    </div>
                </section>
                </div>
    </main>
    
    <script>
        
        function calculate_recommendation(){
            var comedy={
                precentage: parseInt(document.getElementById("comedyValue").value),
                genere: "comedy"
            };
            var action={
                precentage: parseInt(document.getElementById("actionValue").value),
                genere: "action"
            };
            var romance={
                precentage: parseInt(document.getElementById("romanceValue").value),
                genere: "romance"
            };
            var horror={
                precentage: parseInt(document.getElementById("horrorValue").value),
                genere: "horror"
            };
            var movies=[comedy,action,romance,horror];
            movies.sort(function(a,b) { return a.precentage.valueOf() < b.precentage.valueOf();});
            return movies;

        }
        
        function get_first_genere(){
            var movies=calculate_recommendation();
            return movies[0];
        }
        
        function get_sec_genere(){
            var movies=calculate_recommendation();
            return movies[1];
        }
        
        function get_third_genere(){
            var movies=calculate_recommendation();
            return movies[2];
        }
        
        function get_forth_genere(){
            var movies=calculate_recommendation();
            return movies[3];
        }
        
        function display_by_order(){
            if(get_first_genere().genere=="comedy"){
                //image data
                document.getElementById('picture1').setAttribute('class','movieResFirst');
                document.getElementById('picture1').setAttribute('src','/pic/moviesPics/iFeelPretty.jpg');
                document.getElementById('picture1').setAttribute('alt','I Feel Pretty');
                // precentage number
                $("#precentage1").append(get_first_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/460668?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title1").append(data.title);
                $("#genre1").append(data.genres[0].name);
                $("#date1").append(data.release_date);
                $("#rate1").append(data.vote_average);

                });
            }
                
            else if (get_first_genere().genere=="action"){
                //image data
                document.getElementById('picture1').setAttribute('class','movieResFirst');
                document.getElementById('picture1').setAttribute('src',"/pic/moviesPics/ocean's8.jpg");
                document.getElementById('picture1').setAttribute('alt',"ocean's8");
                // precentage number
                $("#precentage1").append(get_first_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/402900?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title1").append(data.title);
                $("#genre1").append(data.genres[2].name);
                $("#date1").append(data.release_date);
                $("#rate1").append(data.vote_average);

                });
            }
                
            else if (get_first_genere().genere=="romance"){
                //image data
                document.getElementById('picture1').setAttribute('class','movieResFirst');
                document.getElementById('picture1').setAttribute('src',"/pic/moviesPics/adrift.jpg");
                document.getElementById('picture1').setAttribute('alt',"adrift");
                // precentage number
                $("#precentage1").append(get_first_genere().precentage);
                //IMDB data
                    $.getJSON('https://api.themoviedb.org/3/movie/429300?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                    $("#title1").append(data.title);
                    $("#genre1").append(data.genres[1].name);
                    $("#date1").append(data.release_date);
                    $("#rate1").append(data.vote_average);
                });
            }
                
            else if (get_first_genere().genere=="horror"){
                //image data
                document.getElementById('picture1').setAttribute('class','movieResFirst');
                document.getElementById('picture1').setAttribute('src',"/pic/moviesPics/AQuietPlace.jpg");
                document.getElementById('picture1').setAttribute('alt',"A Quiet Place");
                // precentage number
                $("#precentage1").append(get_first_genere().precentage);
                $.getJSON('https://api.themoviedb.org/3/movie/447332?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                    $("#title1").append(data.title);
                    $("#genre1").append(data.genres[1].name);
                    $("#date1").append(data.release_date);
                    $("#rate1").append(data.vote_average);

                });
            }
            
            //second movie
            
            if(get_sec_genere().genere=="comedy"){
                //image data
                document.getElementById('picture2').setAttribute('class','movieRes');
                document.getElementById('picture2').setAttribute('src','/pic/moviesPics/iFeelPretty.jpg');
                document.getElementById('picture2').setAttribute('alt','I Feel Pretty');
                // precentage number
                $("#precentage2").append(get_sec_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/460668?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title2").append(data.title);
                $("#genre2").append(data.genres[0].name);
                $("#date2").append(data.release_date);
                $("#rate2").append(data.vote_average);

                });
            }
                
            else if (get_sec_genere().genere=="action"){
                //image data
                document.getElementById('picture2').setAttribute('class','movieRes');
                document.getElementById('picture2').setAttribute('src',"/pic/moviesPics/ocean's8.jpg");
                document.getElementById('picture2').setAttribute('alt',"ocean's8");
                // precentage number
                $("#precentage2").append(get_sec_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/402900?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title2").append(data.title);
                $("#genre2").append(data.genres[2].name);
                $("#date2").append(data.release_date);
                $("#rate2").append(data.vote_average);

                });
            }
                
            else if (get_sec_genere().genere=="romance"){
                //image data
                document.getElementById('picture2').setAttribute('class','movieRes');
                document.getElementById('picture2').setAttribute('src',"/pic/moviesPics/adrift.jpg");
                document.getElementById('picture2').setAttribute('alt',"adrift");
                // precentage number
                $("#precentage2").append(get_sec_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/429300?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title2").append(data.title);
                $("#genre2").append(data.genres[1].name);
                $("#date2").append(data.release_date);
                $("#rate2").append(data.vote_average);


                });
            }
                
            else if (get_sec_genere().genere=="horror"){
                //image data
                document.getElementById('picture2').setAttribute('class','movieRes');
                document.getElementById('picture2').setAttribute('src',"/pic/moviesPics/AQuietPlace.jpg");
                document.getElementById('picture2').setAttribute('alt',"A Quiet Place");
                // precentage number
                $("#precentage2").append(get_sec_genere().precentage);
                $.getJSON('https://api.themoviedb.org/3/movie/447332?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                    $("#title2").append(data.title);
                    $("#genre2").append(data.genres[1].name);
                    $("#date2").append(data.release_date);
                    $("#rate2").append(data.vote_average);

                });
            }
            
            //third movie
            
            if(get_third_genere().genere=="comedy"){
                //image data
                document.getElementById('picture3').setAttribute('class','movieRes');
                document.getElementById('picture3').setAttribute('src','/pic/moviesPics/iFeelPretty.jpg');
                document.getElementById('picture3').setAttribute('alt','I Feel Pretty');
                // precentage number
                $("#precentage3").append(get_third_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/460668?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title3").append(data.title);
                $("#genre3").append(data.genres[0].name);
                $("#date3").append(data.release_date);
                $("#rate3").append(data.vote_average);

                });
            }
                
            else if (get_third_genere().genere=="action"){
                //image data
                document.getElementById('picture3').setAttribute('class','movieRes');
                document.getElementById('picture3').setAttribute('src',"/pic/moviesPics/ocean's8.jpg");
                document.getElementById('picture3').setAttribute('alt',"ocean's8");
                // precentage number
                $("#precentage3").append(get_third_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/402900?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title3").append(data.title);
                $("#genre3").append(data.genres[2].name);
                $("#date3").append(data.release_date);
                $("#rate3").append(data.vote_average);

                });
            }
                
            else if (get_third_genere().genere=="romance"){
                //image data
                document.getElementById('picture3').setAttribute('class','movieRes');
                document.getElementById('picture3').setAttribute('src',"/pic/moviesPics/adrift.jpg");
                document.getElementById('picture3').setAttribute('alt',"adrift");
                // precentage number
                $("#precentage3").append(get_third_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/429300?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title3").append(data.title);
                $("#genre3").append(data.genres[1].name);
                $("#date3").append(data.release_date);
                $("#rate3").append(data.vote_average);


                });
            }
                
            else if (get_third_genere().genere=="horror"){
                //image data
                document.getElementById('picture3').setAttribute('class','movieRes');
                document.getElementById('picture3').setAttribute('src',"/pic/moviesPics/AQuietPlace.jpg");
                document.getElementById('picture3').setAttribute('alt',"A Quiet Place");
                // precentage number
                $("#precentage3").append(get_third_genere().precentage);
                $.getJSON('https://api.themoviedb.org/3/movie/447332?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                    $("#title3").append(data.title);
                    $("#genre3").append(data.genres[1].name);
                    $("#date3").append(data.release_date);
                    $("#rate3").append(data.vote_average);

                });
            }
            
            
            //forth movie
            
            if(get_forth_genere().genere=="comedy"){
                //image data
                document.getElementById('picture4').setAttribute('class','movieRes');
                document.getElementById('picture4').setAttribute('src','/pic/moviesPics/iFeelPretty.jpg');
                document.getElementById('picture4').setAttribute('alt','I Feel Pretty');
                // precentage number
                $("#precentage4").append(get_forth_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/460668?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title4").append(data.title);
                $("#genre4").append(data.genres[0].name);
                $("#date4").append(data.release_date);
                $("#rate4").append(data.vote_average);

                });
            }
                
            else if (get_forth_genere().genere=="action"){
                //image data
                document.getElementById('picture4').setAttribute('class','movieRes');
                document.getElementById('picture4').setAttribute('src',"/pic/moviesPics/ocean's8.jpg");
                document.getElementById('picture4').setAttribute('alt',"ocean's8");
                // precentage number
                $("#precentage4").append(get_forth_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/402900?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title4").append(data.title);
                $("#genre4").append(data.genres[2].name);
                $("#date4").append(data.release_date);
                $("#rate4").append(data.vote_average);

                });
            }
                
            else if (get_forth_genere().genere=="romance"){
                //image data
                document.getElementById('picture4').setAttribute('class','movieRes');
                document.getElementById('picture4').setAttribute('src',"/pic/moviesPics/adrift.jpg");
                document.getElementById('picture4').setAttribute('alt',"adrift");
                // precentage number
                $("#precentage4").append(get_forth_genere().precentage);
                //IMDB data
                $.getJSON('https://api.themoviedb.org/3/movie/429300?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                $("#title4").append(data.title);
                $("#genre4").append(data.genres[1].name);
                $("#date4").append(data.release_date);
                $("#rate4").append(data.vote_average);

                });
            }
                
            else if (get_forth_genere().genere=="horror"){
                //image data
                document.getElementById('picture4').setAttribute('class','movieRes');
                document.getElementById('picture4').setAttribute('src',"/pic/moviesPics/AQuietPlace.jpg");
                document.getElementById('picture4').setAttribute('alt',"A Quiet Place");
                // precentage number
                $("#precentage4").append(get_forth_genere().precentage);
                $.getJSON('https://api.themoviedb.org/3/movie/447332?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
                    $("#title4").append(data.title);
                    $("#genre4").append(data.genres[1].name);
                    $("#date4").append(data.release_date);
                    $("#rate4").append(data.vote_average);

                });
            }
            
            $("#precentage1").append('%');    
            $("#precentage2").append('%');  
            $("#precentage3").append('%');  
            $("#precentage4").append('%');
        }
    </script>
</body>
</html>
