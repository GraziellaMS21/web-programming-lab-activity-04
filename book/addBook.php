<?php 

require_once "../classes/book.php";
$bookObj = new Book();

$book = [];
$errors = [];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $book["title"] = trim(htmlspecialchars($_POST["title"]));
    $book["author"] = trim(htmlspecialchars($_POST["author"]));
    $book["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $book["publication_year"] = trim(htmlspecialchars($_POST["publication_year"]));

    if(empty($book["title"])){
        $errors["title"] = "Title is Required";
    }else if ($bookObj->isBookExist($book["title"])){
         $errors["title"] = "Book Title Already Exist";
    }

    if(empty($book["author"])){
        $errors["author"] = "Author is Required";
    }

    if(empty($book["genre"])){
        $errors["genre"] = "Please Select a Genre";
    }

    if(empty($book["publication_year"])){
        $errors["publication_year"] = "Publication Year is Required";
    } else if (!is_numeric($book["publication_year"])){
        $errors["publication_year"] = "Invalid Publication Year Format";
    } else if ($book["publication_year"] > 2025){
        $errors["publication_year"] = "Publication Year can't be in the Future";
    }

    if(empty(array_filter($errors))){
        $bookObj->title = $book["title"];
        $bookObj->author = $book["author"];
        $bookObj->genre = $book["genre"];
        $bookObj->publication_year = $book["publication_year"];

        if($bookObj->addBook()){
            header("location: viewBook.php");
        }else {
            echo "FAILED";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #DCBE81;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 2rem;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            border: 2px solid #C4A161;
        }

        h1 {
            text-align: center;
            color: #630D0E; 
            margin-bottom: 1rem;
        }

        label {
            display: block;
            font-weight: bold;
            margin: 0.5rem 0 0.2rem;
            color: #981A1A; 
        }

        span {
            color: #981A1A;
        }

        input[type="text"], select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #C4A161;
            border-radius: 5px;
            margin-bottom: 0.3rem;
        }

        input[type="text"]:focus, select:focus {
            outline: none;
            border: 2px solid #A2793D;
        }
            
        .errors {
            color: #981A1A;
            font-size: 0.9rem;
            margin: 0 0 0.5rem;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #630D0E;
            color: #fff;
            padding: 0.7rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 1rem;
            transition: background-color 0.4s ease, transform 0.4s ease;
            
        }

        input[type="submit"]:hover {
            transform: translateY(-10%);
            transition: transform 0.4s ease;
        }

        input[type="submit"]:focus {
            background-color: #8d0a0a;
            transition: background-color 0.4s ease;
        }

        .form-note {
            font-size: 0.85rem;
            margin-bottom: 1rem;
            color: #A2793D;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>ADD BOOK</h1>
            <form action="" method="POST">
                <label for="" class="form-note">Field with <span>*</span> is required</label>
        
                <label for="title">Book Title: <span>*</span></label>
                <input type="text" name="title" id="" value="<?= $book["title"] ?? "" ?>">
                <p class="errors"><?= $errors["title"] ?? ""?></p>
        
                <label for="author">Book Author: <span>*</span></label>
                <input type="text" name="author" id="" value="<?= $book["author"] ?? ""?>">
                <p class="errors"><?= $errors["author"] ?? ""?></p>
        
                <label for="genre">Genre <span>*</span></label>
                <select name="genre" id="">
                    <option value="">--Select Option--</option>
                    <option value="History" <?= isset($book["genre"]) && ($book["genre"] == "History") ? "selected" : "" ?>>History</option>
                    <option value="Science" <?= isset($book["genre"]) && ($book["genre"] == "Science") ? "selected" : "" ?>>Science</option>
                    <option value="Fiction" <?= isset($book["genre"]) && ($book["genre"] == "Fiction") ? "selected" : "" ?>>Fiction</option>
                </select>
                <p class="errors"><?= $errors["genre"] ?? ""?></p>
        
                <label for="publication_year">Publication Year: <span>*</span></label>
                <input type="text" name="publication_year" id="" value="<?= $book["publication_year"] ?? ""?>">
                <p class="errors"><?= $errors["publication_year"] ?? ""?></p>
                <br>
                <input type="submit" value="Save Product">
            </form>
        </div>
    </div>
</body>
</html>