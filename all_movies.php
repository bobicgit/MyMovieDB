<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	
	<title>Movie Database</title>
	
	<meta name="description" content="My selected movies, from around the World!" />
	<meta name="keywords" content="movies, actors, database, top movies" />

	<link href="bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="mystyle.css" rel="stylesheet" type="text/css" >
  <link href="fontello-embedded.css" rel="stylesheet" type="text/css" >
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
	<link href="summernote.css" rel="stylesheet" type="text/css" >
  
	<script type="text/javascript" src="jquery-1.11.3.js"></script>
	<script src="jRate.js"></script>
	<script src="summernote.min.js"></script>
  <script src="jquery.validate.js"></script>

	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script> 
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>
	<div id="container">

		<!-- Navigation -->
		<div  id="nav" class="navbar navbar-default navbar-fixed-top">
 			<div class="navbar-header">
 				<a class="navbar-brand" href="index.php" style="font-weight:bold; font-size: 30px;" >MoviesDB</a>

    		</div>
    		<div class="navbar-collapse collapse">
      			<ul class="nav navbar-nav" >
        			<li ><a href="index.php">Home</a></li>
        			<li><a href="all_movies.php">Movies</a></li>
        			<li><a href="top_10.php">Top 10</a></li>
        			<li><a href="contact.php">Contact</a></li>
      			</ul>

    		</div>
		</div>
		<!-- Header -->

		<div id="header">
			<div id="logo">
				<img src="logoiconmin.png" style="float:left"/>
				<h1>Movies<span style="color: #e72f2f">DB</span></h1>
				<div style="clear:both">
			</div>
		</div>
		<!-- Main -->
		<div id="content">
			<h2>List of all movies from database: </h2>
      <div id="all_movies">
        <!-- Zaczynam polaczenie z baza danych, aby pobrac linki -->
<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

    $sql = "SELECT * FROM movies ORDER BY title ASC";
    
      if($result = @$connection ->query($sql)){

        while($data = mysqli_fetch_array($result)){

          $id_movie = $data['id_movie'];
          $title = $data['title'];

          echo ('<a href="movie_details.php?id=' . $id_movie . '">' . $title . '</a><br>');
          // Tworzy unikatowe linki z danym id filmu. Id bedzie przesylane do pliku movie_details 
          //  i wyseitlane beda tam o nim informacje z bazy danych.
          //var_dump($id_movie);
        }

      }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
      }
    
  }
 $connection->close();

?>  
      </div>
		</div>

		<div id="socials">
			<div id="socialdivs"> <!-- jednakowe wymiary dla socialdivs i divach w srodku -->
				<div class="fb"><a href="http://www.facebook.com" target="_blank" title="Facebook" class="sociallink"><i class="icon-facebook-circled"></i></a></div>
				<div class="fw"><a href="http://www.filmweb.pl" target="_blank" title="Filmweb" class="sociallink"><i class="icon-videocam"></i></a></div>
				<div class="imdb"><a href="http://www.imdb.com" target="_blank" title="IMDB" class="sociallink"><i class="icon-video"></i></a></div>
				<div class="kmf"><a href="http://www.kmf.org.pl" target="_blank" title="KMF" class="sociallink"><i class="icon-video-1"></i></a></div>
				<div styl="clear:both"></div>
			</div>
		</div>
		<!-- Footer -->
		<div id="footer">
			Maciej Mańko &copy; 2015r. &nbsp;&nbsp;&nbsp;&nbsp;"I have come here to chew bubblegum and kick ass... and I'm all out of bubblegum.” - Nada, They Live (1988)
		</div>
	</div>
<script type="text/javascript" src="rating.js"></script>

</body>
</html>