<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

   // $data=$_POST['serialize'];
   if(isset($_POST)){
    $title = $_POST['title'];
    $description = $_POST['summernote_holder'];
    $year = $_POST['year'];
    $rate = $_POST['rate'];
    $idgenres = $_POST['selection_to_send'];
    

    echo $title."<br>".$description."<br>".$year."<br>".$rate."<br>".$idgenres."<br>";

    $actors = $_POST['check_list']; // tablica zaznaczonych checkboxow
    $number_of_checked_boxes = count($actors); // zlicza ile checkboxow zostalo zaznaczonych.

    echo "You selected ".$number_of_checked_boxes." boxes</br>";

    $sql_movie = "INSERT INTO movies (idmovie, title, description, year, idgenres, rating) VALUES (Null, '$title', '$description', '$year', '$idgenres', '$rate')";
    $result = @$connection ->query($sql_movie);
    $movieid = $connection->insert_id; // id ostatniego insertu przechowuje w zmiennej movieid

    echo "The id of the movie you have just added is ".$movieid."</br>";

    }

    if(isset($actors)){
      echo "Ids of selected checkboxes: <br>";
      foreach ($actors as $actor){
        $selected_id =  "<br>".$actor."<br>";
        echo $selected_id; // wyswietla idactors wybranych checkboxow z aktorami.
      } 

      for ($i=0; $i <$number_of_checked_boxes ; $i++) { 

         $sql_actors="INSERT INTO proba (id,actorid, movieid) Values (NUll, '.$actors[$i].', '$movieid')";
         $result = @$connection ->query($sql_actors);
      }

    }else{
      echo "You did not choose an actors!";
    }

      $connection ->close();
    }
?>


