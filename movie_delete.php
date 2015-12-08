<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){
    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
  }else{

    $id_movie_delete = $_GET['id']; 
    $sql = "DELETE FROM movies WHERE id = $id_movie_delete";
    if($result = @$connection ->query($sql)){
      $sql = "DELETE FROM actors_movies WHERE movie_id = $id_movie_delete";
      if($result = @$connection -> query($sql)){
        $msg = "You have just deleted a movie!";
        header("Location: all_movies.php?message=$msg");
      }else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
      }
    }else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
    }
  }
 $connection->close();

?>	