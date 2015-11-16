<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

   // mysli_real_escape_string jest ogolnodostepna funkcja, ktora chroni przed wstrzykiwaniem SQLa przez
  //  uzytkownikow. Characters encoded are NUL (ASCII 0), \n, \r, \, ', ", and Control-Z.
   if(isset($_POST)){
    $title = mysqli_real_escape_string($connection, $_POST['title']);
    $description = $_POST['summernote_holder'];
    $year = mysqli_real_escape_string($connection,$_POST['year']);
    $rate = $_POST['rate'];
    $id_genres = $_POST['selection_to_send'];


    // encja - zastepczy zestaw znakow, ktory przegladarka pokaze w ten sam sposob jak znak, ktory zastepuje 
    //encje. ENT-QUOTES mowi o tym aby zamieniac na encje cudzyslowie i apostrofy takze. UTF-8 - cahrset
    $title = htmlentities($title, ENT_QUOTES, "UTF-8");
    $year = htmlentities($year, ENT_QUOTES, "UTF-8");
    

    echo $title."<br>".$description."<br>".$year."<br>".$rate."<br>".$id_genres."<br>";

    $actors = $_POST['check_list']; // tablica zaznaczonych checkboxow
    $number_of_checked_boxes = count($actors); // zlicza ile checkboxow zostalo zaznaczonych.

    echo "You selected ".$number_of_checked_boxes." boxes</br>";

    $sql_movie = "INSERT INTO movies (id_movie, title, description, year, id_genres, rating)
     VALUES (Null, '$title', '$description', '$year', '$id_genres', '$rate')";
    $result = @$connection ->query($sql_movie);
    $movie_id = $connection->insert_id; // id ostatniego insertu przechowuje w zmiennej movieid

    echo "The id of the movie you have just added is ".$movie_id."</br>";

    }

    if(isset($actors)){
      echo "Ids of selected checkboxes: <br>";
      foreach ($actors as $actor){
        $selected_id =  "<br>".$actor."<br>";
        echo $selected_id; // wyswietla idactors wybranych checkboxow z aktorami.
      } 

      for ($i=0; $i <$number_of_checked_boxes ; $i++) { 

         $sql_actors="INSERT INTO actors_movies (id,actor_id, movie_id) 
         Values (NUll, '.$actors[$i].', '$movie_id')";
         $result = @$connection ->query($sql_actors);
      }

    }else{
      echo "You did not choose an actors!";
    }

      $connection ->close();
    }
?>


