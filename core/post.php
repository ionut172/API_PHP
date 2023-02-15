<?php

class Post{
    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($db){
        $this->conn=$db;
    }
    public function read(){
        $query1="SELECT * FROM `posts`";

        $stmt=$this->conn->prepare($query1);
        $stmt->execute();
      
    }
    public function read_single(){
        $query="SELECT * FROM `posts` WHERE id = ? LIMIT 1";
        $stmt=$this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->title=$row['title'];
            $this->body=$row['body'];
            $this->author=$row['author'];
            $this->title=$row['title'];
            $this->category_id=$row['category_id'];
            $this->id=$row['id'];
            $this->created_at=$row['created_at'];
           
        

    }
    public function create(){
        $query="INSERT INTO `posts` SET title= :title, body =:body, author= :author, category_id= :category_id";
        $stmt=$this->conn->prepare($query);
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam("category_id", $this->category_id);
        if($stmt->execute()){
            return true;
        }
        printf("Error".$stmt->error);
        return false;
    }
    public function update(){
        $query="INSERT INTO `posts` SET title= :title, body =:body, author= :author, category_id= :category_id WHERE
        id = :id ";
        $stmt=$this->conn->prepare($query);
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->body=htmlspecialchars(strip_tags($this->body));
        $this->author=htmlspecialchars(strip_tags($this->author));
        $this->category_id=htmlspecialchars(strip_tags($this->category_id));
        $this->id=htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":body", $this->body);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }
        printf("Error".$stmt->error);
        return false;
    }
    public function delete(){
        $query="DELETE FROM `posts` WHERE id = :id";
        $stmt=$this->conn->prepare($query);
        $this->id;
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()){
            return true;
        }
        
    }
}
?>