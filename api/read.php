<?php
/// headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once('../core/initialize.php');

$post=new Post($db);

$result=$post->read();
$num = $result->rowCount();
if ($num>0){
    $post_arr=array();
    $post_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        print_r($row);
        $post_item=array(
            $id=$row['id'],
            $category_id=$row['category_id'],
            $title=$row['title'],
            $body=$row['body'],
            $author=$row['author'],
            $createdAt=$row['created_at']
        );
        array_push($post_arr['data'], $post_item);
    }
    echo json_encode($post_arr);
}
else {
    echo json_encode(array('message'=>'No posts found.'));
}
?>