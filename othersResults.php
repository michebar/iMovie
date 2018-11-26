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
    <link rel="stylesheet" type="text/css" href="css/otherRes.css">
	
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <h4><a id="back" href="index.php">חזרה למסך הראשי</a></h4>
		
	</header>
    
	<!-- Main -->
        
    <main>
        <h1>סטטיסטיקות של שאר המשתמשים</h1>
        <section class="barcharts">
            <div class="question">
                <h4>איך אתה מעדיף לבלות את סוף השבוע?</h4>
                <div class="charts" id="top_x_div1"></div>
            </div>
            <div class="question">
                <h4>מי השחקן המועדף עלייך?</h4>
                <div class="charts" id="top_x_div2"></div>
            </div>
            <div class="question">
                <h4>מי הדמות האהובה עלייך?</h4>
                <div class="charts" id="top_x_div3"></div>
            </div>
            <div class="question">
                <h4>באופן כללי, איך היית מגדיר/ה את עצמך?</h4>
                <div class="charts" id="top_x_div4"></div>
            </div >
        </section>
        
        <div style="clear:both"></div>
        
        <h1>סטטיסטיקת תוצאות השאלון לכלל המשתמשים</h1>
        
<div id="movieSection">
    
<!-- second movie -->
        <section id="comedy">
            <h2 id="title1" class="movieTitle"></h2>
            <img id="IFeelPretty" class="movieRes" src="/pic/moviesPics/iFeelPretty.jpg" alt="I Feel Pretty" />
            <div class="details">
                <h3 id='precentage2'>אחוז המשתמשים: <b><?php echo quizRes::get_stats_of_res(1); ?>%</b></h3>
                <p id="genre1"> ג'אנר : </p>
                <p id="date1"> יצא להקרנים : </p>
                <p id="rate1"> ממוצע דירוג IMDB : </p>

            </div>
        </section>
    
<!-- second movie -->

        <section id="romance">
            <h2 id="title3" class="movieTitle"></h2>
            <img id="Adrift" class="movieRes" src="/pic/moviesPics/adrift.jpg" alt="Adrift" />
                <div class="details">
                <h3 id='precentage3'>אחוז המשתמשים: <b><?php echo quizRes::get_stats_of_res(2); ?>%</b></h3>
                <p id="genre3"> ג'אנר : </p>
                <p id="date3"> יצא להקרנים : </p>
                <p id="rate3"> ממוצע דירוג IMDB : </p>

            </div>
        </section>

    
<!-- third movie -->
        <section id="action">
            <h2 id="title2" class="movieTitle"></h2>
            <img id="Oceans8" class="movieRes" src="/pic/moviesPics/ocean's8.jpg" alt="Ocean's8" />
            <div class="details">
                <h3 id='precentage2'>אחוז המשתמשים: <b><?php echo quizRes::get_stats_of_res(3); ?>%</b></h3>
                <p id="genre2"> ג'אנר : </p>
                <p id="date2"> יצא להקרנים : </p>
                <p id="rate2"> ממוצע דירוג IMDB : </p>

            </div>
        </section>
    
<!-- forth movie -->
        <section id="horror">
            <h2 id="title4" class="movieTitle"></h2>
            <img id="AQuietPlace" class="movieRes" src="/pic/moviesPics/AQuietPlace.jpg" alt="A Quiet Place" />
                <div class="details">
                <h3 id='precentage4'>אחוז המשתמשים: <b><?php echo quizRes::get_stats_of_res(4); ?>%</b></h3>
                <p id="genre4"> ג'אנר : </p>
                <p id="date4"> יצא להקרנים : </p>
                <p id="rate4"> ממוצע דירוג IMDB : </p>

            </div>
        </section>
        </div>

        <h1>ממוצע הדירוגים של הסרטים ע"י המשתמשים מתוך השאלון</h1>
        <div id="movies">
            <p>החטופה<br>דירוג: <?php echo quizRes::get_movie_rating('q5'); ?><br><img src="pic/moviesPics/Action-taken.jpg" alt="taken"></p>

            <p>It<br>דירוג: <?php echo quizRes::get_movie_rating('q6'); ?><br><img src="pic/moviesPics/Horror-it.png" alt="it"></p>

            <p>בדרך לחתונה עוצרים בווגאס<br><?php echo quizRes::get_movie_rating('q7'); ?><br><img src="pic/moviesPics/Comedy-TheHangOver.jpg" alt="TheHangOver"></p>

            <p>תומב ריידר<br>דירוג: <?php echo quizRes::get_movie_rating('q8'); ?><br><img src="pic/moviesPics/Action-tomRaider.png" alt="tomRaider"></p>

            <p>צא<br>דירוג: <?php echo quizRes::get_movie_rating('q9'); ?><br><img src="pic/moviesPics/Horror-getout.jpg" alt="getout"></p>

            <p>טיטאניק<br>דירוג: <?php echo quizRes::get_movie_rating('q10'); ?><br><img src="pic/moviesPics/Romance-Titanic.jpg" alt="Titanic"></p>

            <p>סיפור אהבה בלתי נשכח<br>דירוג: <?php echo quizRes::get_movie_rating('q11'); ?><br><img src="pic/moviesPics/Romance-aWalkToRemember.jpg" alt="Avatar"></p>

            <p>לחטוף את הבוס<br>דירוג: <?php echo quizRes::get_movie_rating('q12'); ?><br><img src="pic/moviesPics/Comedy-HorribleBosses.jpg" alt="HorribleBosses"></p>

            <p>היומן<br>דירוג: <?php echo quizRes::get_movie_rating('q13'); ?><br><img src="pic/moviesPics/Romance-notebook.png" alt="notebook"></p>

            <p>בתול בן 40<br>דירוג: <?php echo quizRes::get_movie_rating('q14'); ?><br><img src="pic/moviesPics/Comedy-the40.jpg" alt="the40"></p>

            <p>אל תנשום<br>דירוג: <?php echo quizRes::get_movie_rating('q15'); ?><br><img src="pic/moviesPics/Horror-dontbreathe.jpg" alt="dontbreathe"></p>

            <p>ת'ור<br>דירוג: <?php echo quizRes::get_movie_rating('q16'); ?><br><img src="pic/moviesPics/Action-thor.jpg" alt="thor"></p>
        </div>      
    </main>
    
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
            var data1 = new google.visualization.arrayToDataTable([
                ['', ''],
                ["בהופעת סטנד-אפ", <?php echo quizRes::get_results_by_question('q1',1); ?>],
                ["לצאת לדייט לאור נרות", <?php echo quizRes::get_results_by_question('q1',2); ?>],
                ["לצאת לטיול אקסטרים", <?php echo quizRes::get_results_by_question('q1',3); ?>],
                ["לעשות סיאנס", <?php echo quizRes::get_results_by_question('q1',4); ?>],
            ]);

            var options1 = {
                title: '',
                width: 300,
                backgroundColor: {
                      fill: '#C8E0D7',
                    },
                legend: {
                    position: 'none'
                },
                bars: 'horizontal', // Required for Material Bar Charts.
                axes: {
                    x: {
                        0: {
                            side: 'bottom',
                            label: 'סה"כ'
                        } // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: "90%"
                }
                
                
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div1'));
            chart.draw(data1, options1);
            
            //q-2 data
            var data2 = new google.visualization.arrayToDataTable([
                ['', ''],
                ["סת׳ רוגן", <?php echo quizRes::get_results_by_question('q2',1); ?>],
                ["ג׳ייסון סטאהם", <?php echo quizRes::get_results_by_question('q2',2); ?>],
                [" ריאן גוסלינג ", <?php echo quizRes::get_results_by_question('q2',3); ?>],
                ["הבובה צ׳אקי ", <?php echo quizRes::get_results_by_question('q2',4); ?>],
            ]);

            var options2 = {
                title: 'Chess opening moves',
                width: 300,
                legend: {
                    position: 'none'
                },

                bars: 'horizontal', // Required for Material Bar Charts.
                axes: {
                    x: {
                        0: {
                            side: 'bottom',
                            label: 'סה"כ'
                        } // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: "90%"
                }
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div2'));
            chart.draw(data2, options2);


            //q-3 data

            var data3 = new google.visualization.arrayToDataTable([
                ['', ''],
                ["ג׳ואי מחברים", <?php echo quizRes::get_results_by_question('q3',1); ?>],
                ["הילדה מהצלצול", <?php echo quizRes::get_results_by_question('q3',2); ?>],
                ["דומיניק ממהיר ועצבני", <?php echo quizRes::get_results_by_question('q3',3); ?>],
                ["בל מהיפה והחיה", <?php echo quizRes::get_results_by_question('q3',4); ?>],
            ]);

            var options3 = {
                title: 'Chess opening moves',
                width: 300,
                legend: {
                    position: 'none'
                },

                bars: 'horizontal', // Required for Material Bar Charts.
                axes: {
                    x: {
                        0: {
                            side: 'bottom',
                            label: 'סה"כ'
                        } // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: "90%"
                }
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div3'));
            chart.draw(data3, options3);


            //q-4 data

            var data4 = new google.visualization.arrayToDataTable([
                ['', ''],
                ["מצחיק", <?php echo quizRes::get_results_by_question('q4',1); ?>],
                ["רומנטיקן", <?php echo quizRes::get_results_by_question('q4',2); ?>],
                ["אוהב אתגרים", <?php echo quizRes::get_results_by_question('q4',3); ?>],
                ["סקרן", <?php echo quizRes::get_results_by_question('q4',4); ?>],
            ]);

            var options4 = {
                title: 'Chess opening moves',
                width: 300,
                legend: {
                    position: 'none'
                },

                bars: 'horizontal', // Required for Material Bar Charts.
                axes: {
                    x: {
                        0: {
                            side: 'bottom',
                            label: 'סה"כ'
                        } // Top x-axis.
                    }
                },
                bar: {
                    groupWidth: "90%"
                }
            };

            var chart = new google.charts.Bar(document.getElementById('top_x_div4'));
            chart.draw(data4, options4);
        };

        //I Feel Pretty
        $.getJSON('https://api.themoviedb.org/3/movie/460668?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
            $("#title1").append(data.title);
            $("#genre1").append(data.genres[0].name);
            $("#date1").append(data.release_date);
            $("#rate1").append(data.vote_average);

        });

        //  Ocean's 8
        $.getJSON('https://api.themoviedb.org/3/movie/402900?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
            $("#title2").append(data.title);
            $("#genre2").append(data.genres[2].name);
            $("#date2").append(data.release_date);
            $("#rate2").append(data.vote_average);

        });

        //Adrift
        $.getJSON('https://api.themoviedb.org/3/movie/429300?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
            $("#title3").append(data.title);
            $("#genre3").append(data.genres[1].name);
            $("#date3").append(data.release_date);
            $("#rate3").append(data.vote_average);


        });

        //A Quiet Place
        $.getJSON('https://api.themoviedb.org/3/movie/447332?api_key=524aa185383cadf566ba92abcf0dbf66', function(data) {
            $("#title4").append(data.title);
            $("#genre4").append(data.genres[1].name);
            $("#date4").append(data.release_date);
            $("#rate4").append(data.vote_average);

        });
        
        
    </script>



</body>
</html>
