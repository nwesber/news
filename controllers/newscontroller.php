<?php

include "utilities/db.php";

class NewsController extends Database
{

  public function createNews($table, $fields){
    $sql = "";
    $sql .= "INSERT INTO ".$table;
    $sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
    $sql .= "('".implode("','", array_values($fileds))."')";

    $query = mysqli_query($this->con, $sql);

    if($query){
      return true;
    }

  }

  public function readNews(){

  }

  public function updateNews(){

  }

  public function deleteNews(){

  }

}


$obj = new NewsController;

if(isset($_POST["submit"])){
  $news = array(
    "title" => $_POST["title"],
    "body" => $_POST["body"]
  );
  if($obj->createNews("news", $news)){
    header("location:index.php?msg=Record Inserted");
  }

}

?>



