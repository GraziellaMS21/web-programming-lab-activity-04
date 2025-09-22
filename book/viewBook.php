<?php
require_once "../classes/book.php";
$bookObj = new Book();

$search = "";
$genre = "";



if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = isset($_GET["search"]) ? trim(htmlspecialchars($_GET["search"])) : "";
    $genre  = isset($_GET["genre"]) ? trim(htmlspecialchars($_GET["genre"])) : "";
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Book</title>
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
            flex-direction: column;
            min-height: 100vh;
        }

        .table-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            box-shadow: inset 0 0 0 2px #C4A161;
        }

        h1 {
            text-align: center;
            color: #ffffffff;
            margin-bottom: 0.5rem;
            font-size: 3rem;
            text-shadow: 2px 2px 4px black;
        }

        button {
            background-color: #630D0E;
            border: none;
            border-radius: 5px;
            padding: 0.7rem 1.2rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #8d0a0a;;
            transform: scale(1.05);
        }

        button a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        table td {
            border: 1px solid #C4A161;
            padding: 0.8rem;
        }

        .header {
            background-color: #A2793D;
            color: #fff;
            font-weight: 500;
        }

        table tr:nth-child(even) {
            background-color: #fdf6e3;
        }

        .data:hover {
            background-color: #f3e2b3;
            transition: background-color 0.3s ease;
        }
        
        .search-container {
            margin: 1rem 0;
            display: flex;
            justify-content: center;
            width: 80%;
            max-width: 800px;
        }

        .search-container form {
            display: flex;
            align-items: center;
            gap: 0.5rem; 
            width: 100%;
        }

        .search-container label {
            font-weight: bold;
            color: #333;
            min-width: 60px; 
        }

        .search-container input[type="search"] {
            flex: 1;
            padding: 0.5rem;
            border: 1px solid #C4A161;
            border-radius: 5px;
            outline: none;
            transition: 0.3s;
        }

        .search-container input[type="search"]:focus {
            border-color: #630D0E;
            box-shadow: 0 0 5px rgba(99, 13, 14, 0.4);
        }

        .search-container input[type="submit"] {
            background-color: #630D0E;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 0.6rem 1.2rem;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .search-container input[type="submit"]:hover {
            background-color: #8d0a0a;
            transform: scale(1.05);
        }

        #genre {
            border-radius: 5px;
            padding: 0.6rem 1.2rem;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>VIEW BOOKS</h1>
        <div class="search-container">
            <form action="" method="get">
                <label for="search">Search: </label>
                <input type="search" name="search" id="search" value="<?= $search ?>">
                <select name="genre" id="genre">
                    <option value="">-- Select Option --</option>
                    <option value="History" <?= $genre == "History" ? "selected" : "" ?> >History</option>
                    <option value="Science" <?= $genre == "Science" ? "selected" : "" ?> >Science</option>
                    <option value="Fiction" <?= $genre == "Fiction" ? "selected" : "" ?> >Fiction</option>
                </select>
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="table-container">
            <button><a href="addBook.php">Add Book</a></button>
            <table border="1">
                <tr class="header">
                    <td>id</td>
                    <td>Title</td>
                    <td>Author</td>
                    <td>Genre</td>
                    <td>Publication Year</td>
                </tr>
        
                <?php 
                $no = 1;
                foreach($bookObj->viewBook($search, $genre) as $book) {
                ?>
                <tr class="data">
                    <td><?= $no++ ?></td>
                    <td><?= $book["title"] ?></td>
                    <td><?= $book["author"]  ?></td>
                    <td><?= $book["genre"]  ?></td>
                    <td><?= $book["publication_year"] ?></td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>