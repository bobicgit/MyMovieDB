
<!DOCTYPE HTML>
<html lang="pl">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  
  <title>Movie Database</title>
  
  <meta name="description" content="My selected movies, from around the World!" />
  <meta name="keywords" content="movies, actors, rowbase, top movies" />

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

<!-- SCRIPT PHP WHICH IS UPDATING DATA IN DATABASE, AFTER EDITING A FORM. -->

<?php
  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){
    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
  }else{
    if(isset($_GET['id'])){
      $id_movie = $_GET['id']; 

// NEXT CONDITION IS RUNNING AFTER SUBMITTING A NEW FORM

      if(isset($_POST['update'])){
        $new_title = mysqli_real_escape_string($connection, $_POST['new_title']);
        $new_description = $_POST['new_summernote_holder'];
        $new_year = mysqli_real_escape_string($connection,$_POST['new_year']);
        $new_rating = mysqli_real_escape_string($connection,$_POST['new_actual_rate']);
        $new_id_genre = mysqli_real_escape_string($connection,$_POST['new_selection_to_send']);

        $new_title = htmlentities($new_title, ENT_QUOTES, "UTF-8");
        $new_year = htmlentities($new_year, ENT_QUOTES, "UTF-8");


        $sql = "UPDATE movies SET title = '$new_title', description = '$new_description',
        year = '$new_year', rating = '$new_rating', genre_id = '$new_id_genre' WHERE id = $id_movie";

          if($result = @$connection ->query($sql)){

          }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
          }

// SCRIPT IS CHECKING IF NEW CHECKLIST OF CHECKBOXES IS SET.(actors selected). IF IS SET, SCRIPT IS DELETING
// OLD REDORDS FROM actors_movies TABLE WITH SPECIFIC MOVIE ID AND IS ADDING NEW DEPENDS ON WHAT CHECKBOXES WERE 
// CHECKED. IF NEW LIST OF CHECKBOXES IS EMPTY, SCRIPT STILL IS DELETING OLD REDORDS.
          
          if(isset($_POST['new_check_list'])){
            $new_actors = $_POST['new_check_list'];
              if(isset($new_actors)){
                $new_number_of_checked_boxes = count($new_actors);
                $sql = "DELETE FROM actors_movies WHERE movie_id = $id_movie";
                  if($result = @$connection ->query($sql)){ }else{
                    echo "ERROR: Could not able to execute $sql_movie_delete. " . mysqli_error($connection);
                  }
                  for ($i=0; $i <$new_number_of_checked_boxes ; $i++) { 

                    $sql="INSERT INTO actors_movies (id,actor_id, movie_id) 
                    Values (NUll, '.$new_actors[$i].', '$id_movie')";
                      if($result = @$connection ->query($sql)){ }else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                      }
                    }
                Header('Location: movie_details.php?id='.$id_movie);
              }else{
                echo('<script>console.log("You did not choose any actors!");</script');
              }
          }else{
            $sql = "DELETE FROM actors_movies WHERE movie_id = $id_movie";
                  if($result = @$connection ->query($sql)){ }else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
                  }
            Header('Location: movie_details.php?id='.$id_movie);
          }
      }
    }
  }

 $connection->close();

?>

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
        <h1>Movies<span style="color: #e72f2f">DB</span></h1>
          <div style="clear:both"></div>
      </div><!-- #/logo -->
    </div><!-- #/header -->
  </div><!-- ./container -->
</section><!-- #/movie_logo -->

<!-- SCRIPT PHP WHICH IS GETTING INFO ABOUT ACTUAL SPECIFIC MOVIE. THIS DATA WILL BE USE TO FILL STARTING FORM -->

<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){
    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
  }else{
      $id_movie_edit = $_GET['id']; //GET ID FROM LINK WHICH IS MADE IN movie_details

// FIRST QUERY GET ALL DATA FROM TABLE movies ABOUT A MOVIE WITH SPECIFIC ID

      $sql = "SELECT * FROM movies WHERE id = $id_movie_edit";

        if($result = @$connection ->query($sql)){
          while($row = mysqli_fetch_array($result)){
            $title = $row['title'];
            $year = $row['year'];
            $description = $row['description'];
            $rating = $row['rating'];
            $genre_id = $row['genre_id']; 
          }
        }else {
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        } 

// SECOND QUERY GET ID'S ACTORS FROM actors_movies TABLE, WHICH ARE STARING IN SPECIFIC MOVIE

      $sql = "SELECT actor_id FROM actors_movies WHERE movie_id=$id_movie_edit";
       
        if($result = @$connection -> query($sql)){

// CREATING AN ARRAY IN WHICH WILL BE HOLD ID'S OF ACTORS.

         $array_of_actors_id = array();
          while($row = mysqli_fetch_array($result)){
            $actor_id_edit = $row['actor_id'];

// FILLING ARRAY

            array_push($array_of_actors_id, "$actor_id_edit");
          }

// CHECKING IF ARRAY IS EMPTY AND THEN CONVERTING IT TO STRING ON THE PURPOSE TO SEND IT TO JAVASCRIPT

            if(empty($array_of_actors_id)){
              $string_of_actors_id_edit = '';
            }else{
              $string_of_actors_id_edit = implode(",",$array_of_actors_id);
            }
      }else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
        }
    } 
 $connection->close();
?>

<!-- FORM TO EDIT, ALREADY FILLED -->

<section id="main_form">
  <div class="container">
    <div id="content">
      <h2>Edit "<?php echo $title; ?>" movie: </h2>
      <form class="form-horizontal" id="add_movie" action="/">
        <div class="form-group">
          <label for="title" class="col-sm-3 control-label">Title</label>
            <div class="col-sm-12 col-md-6">
              <input type="text" class="form-control" name="new_title" placeholder="Title" value="<?php echo $title; ?>" >
            </div>
        </div>
        <div class="form-group">
          <label for="despription" class="col-sm-3 control-label">Description</label>
            <div  class="col-sm-12 col-md-6">
              <textarea id = "summernote_field" class="form-control" rows="4" ></textarea>
              <input type="hidden" class="form-control" name="new_summernote_holder" id="summernote_plain" >
            </div>
        </div>
        <div class="form-group">
          <label for="year" class="col-sm-3 control-label">Year</label>
            <div class="col-sm-12 col-md-6">
              <input type="text" class="form-control" name="new_year" placeholder="Year" value="<?php echo $year; ?>" >
            </div>
        </div>
        <div id="forselect" class="form-group" >
          <label for="selection" class="col-sm-3 control-label">Genre</label>
            <div class=" col-sm-12 col-md-6">
              <select id="selection" name="new_selection_to_send"></select>
            </div>
          </div>

<!-- jRATE plugin, for nice looking stars for rating-->

        <div  class="form-group" id="for_rating">
          <label for="jRate" class="col-sm-3 control-label">Rating</label>
            <div class=" col-sm-12 col-md-6" id="jRate">
              <!-- here are stored all stars from jRate plugin -->
            </div>
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" name="new_actual_rate" id="new_actual_rate">
            <div id="container_for_error"></div>
          </div>

<!-- Multiselect checkboxes with actors from database -->

        <div id="formultiselect" class="form-group" >
          <label for="selection" class="col-sm-3 control-label">Actors</label>
            <div class=" col-sm-12 col-md-6" id="actors"></div>
        </div>
        <div class="form-group">
          <div class="center-block">
            <button type="submit" class="btn btn-default" id="subbut" name="update">Update a movie!</button>
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

<script type="text/javascript">
  var genre_edit_id = "<?= $genre_id ?>";
  var description_edit = '<?= $description ?>';
  var rating_edit = "<?=$rating ?>";
  var string_of_actors_id_edit = '<?=$string_of_actors_id_edit ?>';
</script>
<script type="text/javascript" src="rating_edit.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>



</body>
</html>
