<!-- Php ktory updatuje dane po uzupelnieniu formularza i przekierowuje dalej--> 
<?php
  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

    if(isset($_GET['id'])){
      $id_movie = $_GET['id']; 
      // kolejny warunek po zatwierdzeniu nowego formularza sie wykonuje
      if(isset($_POST['update'])){
        $new_title = mysqli_real_escape_string($connection, $_POST['new_title']);
        $new_description = $_POST['new_summernote_holder'];
        $new_year = mysqli_real_escape_string($connection,$_POST['new_year']);
        $new_rating = $_POST['new_actual_rate'];
        $new_id_genre = $_POST['new_selection_to_send'];

        $new_title = htmlentities($new_title, ENT_QUOTES, "UTF-8");
        $new_year = htmlentities($new_year, ENT_QUOTES, "UTF-8");

        $new_actors = $_POST['check_list'];

        $sql_update = "UPDATE movies SET title = '$new_title', description = '$new_description',
        year = '$new_year', rating = '$new_rating', id_genres = '$new_id_genre' WHERE id_movie = $id_movie";

          if($result = @$connection ->query($sql_update)){
          // dobre przekierowanie, po aktorach.
          //Header('Location: movie_details.php?id='.$id_movie);
          }else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
          }
// AKTORZY NIE DZIAŁAJA JESZCZE
          if(isset($new_actors)){
            $new_number_of_checked_boxes = count($new_actors);
              for ($i=0; $i <$new_number_of_checked_boxes ; $i++) { 
                $sql_new_actors="UPDATE actors_movies SET actor_id = '.new_actors[$i].' WHERE movie_id=$id_movie";
                $result = @$connection ->query($sql_new_actors);
              }
          }else{
            echo "You did not choose an actors!";
          }
// DOTAD

      }else{
        echo('<nie udalo sie!');
      }
    }
  }

 $connection->close();

?>
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
<!--- Zaczyna sie phpwyciagajce dane o aktualnie wybranym filmie Header -->

<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

  

// ********** Wybieranie informacji z bazy danych o filmie o danym id. Wartości te będą ustawione w formularzu jako początkowe, do edycji. ************//

      $id_movie_edit = $_GET['id']; // pobiera id z linku ktory tworzy sie w petli while w pliku all_movies

// 1. zapytanie wyciaga wszystkie dane z tabeli movies o filmie z danym id.
      $sql_1 = "SELECT * FROM movies WHERE id_movie = $id_movie_edit";

        if($result = @$connection ->query($sql_1)){

          while($data = mysqli_fetch_array($result)){
            $title = $data['title'];
            $year = $data['year'];
            $description = $data['description'];
            $rating = $data['rating'];
            $id_genres = $data['id_genres']; 
          }
        }else {
          echo "ERROR: Could not able to execute $sql_1. " . mysqli_error($connection);
        } 

// 2. zapytanie Wyciaganie id actorow z tabeli actors_movies, grajacych w danym filmie
      $sql_2 = "SELECT actor_id FROM actors_movies WHERE movie_id=$id_movie_edit";

        if($result2 = @$connection -> query($sql_2)){
        // tworze tablice do ktorej bede przekazywal wartosci id poszczegolnych aktorow do zapytan
        // pozniej zostanie ona wykorzystana do petli aby wyswietlic info o aktorach.
        $array_of_actors_id = array();
          while($data_2 = mysqli_fetch_array($result2)){
            $actor_id_edit = $data_2['actor_id'];
            // trzwe tablice z idkami aktorow PHP
            array_push($array_of_actors_id, "$actor_id_edit");
            // konwertuje tablice do postaci stringa, aby ja przekazac do javascriptu, gdzie pozniej
            // bede tworzyc z tego tablice
            $string_of_actors_id_edit = implode(",",$array_of_actors_id);


          }

      }else{
          echo "ERROR: Could not able to execute $sql_2. " . mysqli_error($connection);
        }


    } // glowny if z isset id

 $connection->close();

?>

    <div id="header">
      <div id="logo">
        <img src="logoiconmin.png" style="float:left"/>
        <h1>Movies<span style="color: #e72f2f">DB</span></h1>
        <div style="clear:both">
      </div>
    </div>
    <!-- Main -->
    <div id="content">
      <h2>Edit "<?php echo $title; ?>" movie: </h2>
      <form class="form-horizontal" id="update_movie" action="" method="post">
          <div class="form-group">
            <label for="title" class="col-sm-4 control-label">Title</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" name="new_title" placeholder="Title" value="<?php echo $title; ?>" >
              </div>
          </div>

          <div class="form-group">
            <label for="despription" class="col-sm-4 control-label">Description</label>
              <div  class="col-sm-4">
                  <textarea id = "summernote_field" class="form-control" rows="4" ></textarea>
                  <input type="hidden" class="form-control" name="new_summernote_holder" id="summernote_plain" >
              </div>
          </div>

          <div class="form-group">
            <label for="year" class="col-sm-4 control-label">Year</label>
              <div class="col-sm-4">
                  <input type="text" class="form-control" name="new_year" placeholder="Year" value="<?php echo $year; ?>" >
              </div>
          </div>

        <!-- rating SELECT BOX podpinasz plugin pod siatke bootstrapa z class col-sm-->

           <div id="forselect" class="form-group" >
            <label for="selection" class="col-sm-4 control-label">Genre</label>
              <div class=" col-sm-3">
                <select id="selection" name="new_selection_to_send">
      
                </select>
              </div>
          </div>

          <!-- rating RATING PLUGIN podpinasz plugin pod siatke bootstrapa z class col-sm-->
          <div  class="form-group ">
            <label for="jRate" class="col-sm-4 control-label">Rating</label>
            <div class=" col-sm-1" id="jRate">
              <!-- tutaj siedza wszystkie gwiazki z jRate plugin -->
            </div>
          </div>
          <div class="form-group">
          <input type="hidden" class="form-control" name="new_actual_rate" id="new_actual_rate">
          <div id="container_for_error"></div></div>

          <!-- Multi wybór aktorów z bazy danych -->
           <div id="formultiselect" class="form-group" >
            <label for="selection" class="col-sm-4 control-label">Actors</label>
              <div class=" col-sm-3" id="actors">
                
                <!-- tutaj siedzi wynik z jRate plugin, ktory pobieram potwirdzajac formularz -->
                
              </div>
          </div>


          <div class="form-group">
            <div class="col-sm-offset-5 col-sm-2">
                <button type="submit" class="btn btn-default" id="subbut" name="update">Update a movie!</button>
            </div>
        </div>
      </form>
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
  <!-- Pobieram zmienne potrzebne mi w osobnym pliku javascriptu, do wyswietlenia danych aktualnych -->
<script type="text/javascript">
  var genre_edit_id = "<?= $id_genres ?>";
  var description_edit = '<?= $description ?>';
  var rating_edit = '<?=$rating ?>';
  var string_of_actors_id_edit = '<?=$string_of_actors_id_edit ?>'
</script>
<script type="text/javascript" src="rating_edit.js"></script>

</body>
</html>
