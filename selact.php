<?php

  require_once "conect.php";

  $connection = @new mysqli($host,$db_user,$db_pass,$db_name);

  if($connection ->connect_errno!=0){

    echo "Error: ".$connection->connect_errno."Opis: ".$connection->connect_error;
    // to echo wykona sie tylko wtedy gdy polaczenia nie uda sie ustanowic.
    // wyswietli numer bledu
  }else{

    $sql = "SELECT * FROM actors ORDER BY name ASC";
    //$sql2 = "SELECT * FROM Actors"

    if($result = @$connection ->query($sql)){

      $json = array();

      while($data = mysqli_fetch_array($result)){

        $row = array(
          'idactors' => $data['idactors'],
          'name' => $data['name'],
          'surname' => $data['surname']
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