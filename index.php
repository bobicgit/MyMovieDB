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

<!-- MENU AND NAVBAR -->  

<section id="menu">
  <nav  id="nav" class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php" style="font-weight:bold; font-size: 30px;" >MoviesDB</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>    
      </div><!-- navbar-header -->
      <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav" >
          <li ><a href="index.php">Home</a></li>
          <li><a href="all_movies.php">Movies</a></li>
          <li><a href="top_10.php">Top 10</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div><!-- ./navbar-collapse --> 
    </div><!-- ./container -->
  </nav><!-- ./navbar-default -->
</section><!-- #/menu -->

<!-- LOGO -->

<section id="movie_logo">
  <div class="container">
    <div id="header">
    	<div id="logo">
    		<img src="logoiconmin.png" style="float:left"/>
    		<h1 class="hidden-xs">Movies<span style="color: #e72f2f">DB</span></h1>
    		  <div style="clear:both"></div>
      </div><!-- #/logo -->
    </div><!-- #/header -->
  </div><!-- ./container -->
</section><!-- #/movie_logo -->

<!-- FORM -->

<section id="main_form">
  <div class="container">
    <div id="content">
      <h2>Add your favorite movies to my database!</h2>
      <form class="form-horizontal" id="add_movie" action="/">
        <div class="form-group">
          <label for="title" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-12 col-md-6">
                <input type="text" class="form-control" name="title" placeholder="Title">
            </div>
        </div>
        <div class="form-group">
          <label for="despription" class="col-sm-3 control-label">Description</label>
            <div  class="col-sm-12 col-md-6">
              <input type="hidden" class="form-control" name="summernote_holder" id="summernote_plain" >
                <textarea id = "summernote_field" class="form-control" rows="4"></textarea>
            </div>
        </div>
        <div class="form-group">
          <label for="year" class="col-sm-3 control-label">Year</label>
            <div class="col-sm-12 col-md-6">
              <input type="text" class="form-control" name="year" placeholder="Year">
            </div>
        </div>
        <div id="forselect" class="form-group" >
          <label for="selection" class="col-sm-3 control-label">Genre</label>
            <div class=" col-sm-12 col-md-6">
              <select id="selection" name="selection_to_send"></select>
            </div>
          </div>

<!-- jRATE plugin, for nice looking stars for rating-->

        <div  class="form-group" id="for_rating">
          <label for="jRate" class="col-sm-3 control-label">Rating</label>
            <div class=" col-sm-12 col-md-6" id="jRate">
              <!-- here are stored all stars from jRate plugin -->
              <div>
                <input type="hidden" class="form-control" name="rate" id="actual_rate">
              </div>
            </div>
        </div>

<!-- Multiselect checkboxes with actors from database -->

        <div id="formultiselect" class="form-group" >
          <label for="selection" class="col-sm-3 control-label">Actors</label>
            <div class=" col-sm-12 col-md-6" id="actors"></div>
        </div>
        <div class="form-group">
          <div class="center-block">
            <button type="submit" class="btn btn-default" id="subbut">Add a movie!</button>
          </div>
        </div>
      </form>
    </div>   
  </div>
</section>
		

<!-- SOCIAL LINKS -->

<section id= "wraper_for_socials">
  <div class="container">
    <div class="row">
      <div class="col-md-3 col-sm-12 col-xs-12">        
        <div class="fb"><a href="http://www.facebook.com" target="_blank" title="Facebook" class="sociallink"><i class="icon-facebook-circled"></i></a></div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12">        
        <div class="fw"><a href="http://www.filmweb.pl" target="_blank" title="Filmweb" class="sociallink"><i class="icon-videocam"></i></a></div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12">        
        <div class="imdb"><a href="http://www.imdb.com" target="_blank" title="IMDB" class="sociallink"><i class="icon-video"></i></a></div>
      </div>
      <div class="col-md-3 col-sm-12 col-xs-12">        
        <div class="kmf"><a href="http://www.kmf.org.pl" target="_blank" title="KMF" class="sociallink"><i class="icon-video-1"></i></a></div>
      </div>
      <div styl="clear:both"></div>
    </div> <!-- ./row -->
  </div><!-- ./container -->
</section><!-- #/wraper_for_socials -->
		
<!-- FOOTER -->

<section id="foot_of_page">
  <div class="container">
    <div id="footer">
      Maciej Mańko &copy; 2015r.</br>"I have come here to chew bubblegum and kick ass...
      and I'm all out of bubblegum.” - Nada, They Live (1988)
    </div><!-- #/footer -->   
  </div><!-- ./container -->
</section><!-- #/foot_of_page -->

<!-- SCRIPTS -->

<script type="text/javascript" src="rating.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>

</body>
</html>