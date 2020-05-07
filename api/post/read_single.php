<?php
    // headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // instantiate and connect database
    $database = new Database();
    $db = $database->connect();

    // instantiate blog post object
    $post = new Post($db);

    // Get ID from url
    $post->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get Post
    $post->read_single();

    // Create Array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    // Convert to JSON
    print_r(json_encode($post_arr));