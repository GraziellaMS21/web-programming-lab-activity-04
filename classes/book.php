<?php
require_once "database.php";

class Book extends Database{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";

    protected $db;

    // public function __construct() {
    //     $this->db = new Database();
    // }
    
    public function addBook() {
        $sql = "INSERT INTO books (title, author, genre, publication_year) VALUE (:title, :author, :genre, :publication_year)";
        //  $query = $this->db->connect()->prepare($sql);
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        
        return $query->execute();
    }

    public function viewBook($search="", $genre="") {
        if($genre != "" && $search != ""){
            $sql = "SELECT * FROM books WHERE title LIKE CONCAT('%', :search, '%') AND genre = :genre ORDER BY title ASC";
        }
        else if($search != ""){
            $sql = "SELECT * FROM books WHERE title LIKE CONCAT('%', :search, '%') ORDER BY title ASC";
        }else if($genre != ""){
            $sql = "SELECT * FROM books WHERE genre = :genre ORDER BY title ASC";
        }
        else{
            $sql = "SELECT * FROM books";
        }
            
        // $query = $this->db->connect()->prepare($sql);
        $query = $this->connect()->prepare($sql);
         if($search != ""){
             $query->bindParam(":search", $search);
         }
        if($genre != ""){
            $query->bindParam(":genre", $genre);
        }

        if($query->execute()){
            return $query->fetchAll();
        }else{
            return null;
        }
    }
    
    public function isBookExist($bTitle){
        $sql = "SELECT COUNT(*) as total_books FROM books WHERE title = :title";
        $query = $this->connect()->prepare($sql);

        $query->bindParam(":title", $bTitle);
        $record = NULL;

        if ($query->execute()) {
            $record = $query->fetch();
        }
        
        if($record["total_books"] > 0){
            return true;
        }else{
            return false;
        }

    }
    
}


// $obj = new Book();
// $obj->title = "Harry Potter";
// $obj->author = "kk";
// $obj->genre = "ff00";
// $obj->publication_year = 11;

// var_dump($obj->viewBook());