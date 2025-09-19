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

    public function viewBook($search="") {
        $sql = "SELECT * FROM books WHERE title LIKE CONCAT('%', :search, '%') ORDER BY title ASC";
        // $query = $this->db->connect()->prepare($sql);
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":search", $search);
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