<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

    $sql = "SELECT title FROM movies ORDER BY title ASC";
    

    if($result = @$connection ->query($sql)){

      $json = array();

      while($data = mysqli_fetch_array($result)){

        $row = array(
          'title'=> $data['title'],
          

        );
        array_push($json, $row);
      }
 
    echo json_encode($json);

    }else{

      echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);

    }
    
  }
 $connection->close();

?>	