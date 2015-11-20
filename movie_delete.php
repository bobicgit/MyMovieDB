<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

    $id_movie_delete = $_GET['id']; 

    $sql_movie_delete = "DELETE FROM movies WHERE id_movie = $id_movie_delete";
    

    if($result = @$connection ->query($sql_movie_delete)){

      $sql_movie_delete_2 = "DELETE FROM actors_movies WHERE movie_id = $id_movie_delete";

      if($result = @$connection -> query($sql_movie_delete_2)){
        $msg = "You have just deleted a movie!";
        header("Location: all_movies.php?message=$msg");
      }else{

        echo "ERROR: Could not able to execute $sql_movie_delete_2. " . mysqli_error($connection);
      }

    }else{
      echo "ERROR: Could not able to execute $sql_movie_delete. " . mysqli_error($connection);
    }
    
  }
 $connection->close();

?>	