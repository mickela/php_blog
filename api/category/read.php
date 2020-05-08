<?php
  // headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Category.php';

  // instantiate and connect database
  $database = new Database();
  $db = $database->connect();

  // instantiate blog post object
  $category = new Category($db);

  // Blog category query
  $result = $category->read();
  // Get row count
  $num = $result->rowCount();

  // check if any categories
  if($num > 0){
    // Category array
    $category_arr = array();
    $category_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $category_item = array(
        'id' => $id,
        'name' => $name
      );

      // push to "data"
      array_push($category_arr['data'], $category_item);
    } // end while loop

    // Convert to JSON and output
    echo json_encode($category_arr);
  }else{
    // no Categories
    echo json_encode(
      array('message' => 'No Category Found')
    );
  };
