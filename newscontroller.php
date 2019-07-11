<?php

include "utilities/db.php";

class NewsController extends Database
{

  public function insertRecord($table, $fields){
    $sql = "";
    $sql .= "INSERT INTO ".$table;
    $sql .= " (".implode(",", array_keys($fields)).") VALUES ";
    $sql .= "('".implode("','", array_values($fields))."')";

    $query = mysqli_query($this->con, $sql);

    if($query){
      return true;
    }

  }

  public function fetchRecord($table){
    $sql = "SELECT * FROM ".$table;
    $array = array();
    $query = mysqli_query($this->con,$sql);

    while($row = mysqli_fetch_assoc($query)){
      $array[] = $row;
    }
    return $array;
  }

  public function deleteRecord($table, $where){
    $sql = "";
    $condition = "";

    foreach ($where as $key => $value) {
      $condition .= $key . "='" . $value . "' AND ";
    }

    $condition = substr($condition, 0, -5);
    $sql = "DELETE FROM ".$table." WHERE ".$condition;
    echo $sql;
    if(mysqli_query($this->con, $sql)){
      return true;
    }
  }

}


$obj = new NewsController;

if(isset($_POST["submit"])){
  $news = array(
    "title" => $_POST["title"],
    "body" => $_POST["body"],
    "created_at" => date('Y-m-d')
  );
  if($obj->insertRecord("news", $news)){
    header("location:index.php?msg=Record Inserted");
  }

}

if(isset($_POST["createcomment"])){
  $comment = array(
    "news_id" => $_POST["news_id"],
    "body" => $_POST["body"],
    "created_at" => date('Y-m-d')
  );

  if($obj->insertRecord("comment", $comment)){
    header("location:index.php?msg=Record Inserted");
  }
}

if(isset($_GET["delete"])){
  $id = $_GET["id"] ?? null;
  $where = array("id"=>$id);
  $whereComment = array("news_id", $id);
  if($obj->deleteRecord("news", $where) && $obj->deleteRecord("comment", $whereComment)){
    header("location:index.php?msg=Record Deleted Successfully");
  }
}

?>



