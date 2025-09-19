<?php
require_once "../classes/book.php";
$bookObj = new Book();
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
            color: #630D0E;
            margin-bottom: 1.5rem;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="table-container">
            <h1>View Products</h1>
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
                foreach($bookObj->viewBook() as $book) {
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