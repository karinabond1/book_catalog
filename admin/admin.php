<?php
//error_reporting(0);
include "../Book_class.php";
include_once '../DB.php';
include_once '../Config.php';
$db = new DB();
$db->connect();
$book_name = $_REQUEST['book_name'];
$arr_book = $db->selectAllWhere("books", "book", $book_name);
if (isset($_REQUEST['update'])) {
    $id = $_POST['id'];
    $book = $_POST['book'];
    $about = $_POST['about'];
    $price = $_POST['price'];
    $img = $_POST['img'];
    $inf_book = new Book_class($book, $about, $price, $img);

    if (isset($_POST['update'])) {
        $db->update("books", "book", $inf_book->book, "about", $inf_book->about, "price", $inf_book->price, "img", $inf_book->img, "id", $id);
    }
}

function insert_author($str, $id){
    $db = new DB();
    $db->connect();
    $db->insert($str, $id,"authors","id","author","books_authors","book_id","authors_id");
}

function insert_genre($str, $id){
    $db = new DB();
    $db->connect();
    $db->insert($str, $id,"genres","id","genre","books_genres","book_id","genre_id");
}

if (isset($_REQUEST['add'])) {
    $db = new DB();
    $db->connect();
    $book_add = $_POST['book'];
    $about_add = $_POST['about'];
    $price_add = $_POST['price'];
    $img_add = $_POST['img'];
    $inf_book_add = new Book_class($book_add, $about_add, $price_add, $img_add);
    $db->selectWhereTwoPar("id", "book", "books", $inf_book_add->book, "about", "price", "img", $inf_book_add->about, $inf_book_add->price, $inf_book_add->img);

    $arr_book_add = $db->selectWhere("id", "books", "book", $inf_book_add->book);
    for ($i = 0; $i < count($arr_book_add); $i++) {
        $id = $arr_book_add[$i]['id'];
    }

    for ($i = 1; $i < 4; $i++) {
        insert_author($_POST["author" . $i], $id);
    }
    for ($i = 1; $i < 9; $i++) {
        insert_genre($_POST["genre" . $i], $id);
    }


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book catalog</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/fontawesome.min.css">-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">B<i class="far fa-circle" aria-hidden="true"></i><i
                        class="far fa-circle"></i>KS CATALOG </a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="active"><a href="#">Home</a></li>
                <li class="active"><a href="#edit">Edit</a></li>
                <li class="active"><a href="#add">Add</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="edit" class="container">
    <div class="row centered">

        <br><br>
        <h3>Find the book for editing</h3>
        <form method="post">
            <div class="modal-body form-group">
                <input type="text" class="form-control form-control-lg" name="book_name"
                       placeholder="Book" required/>
            </div>
            <?php $book_name = $_REQUEST['book_name']; ?>
            <a href="?genre_id=<?= $book_name ?>">
                <button type="submit" name="btn_send" class="btn btn-danger btn-lg">Send</button>
            </a>
        </form>

        <?php

        if (isset($_REQUEST['btn_send'])) {
            ?>
            <form method="post">

                <?
                for ($i = 0; $i < count($arr_book); $i++) { ?>

                    <?
                    if ($arr_book[$i]["id"]) {
                        ?>
                        <div class="form-group" style="visibility: hidden">
                            <label>id</label>
                            <input name='id'
                                   type='text'
                                   class="form-control"
                                   value='<?= isset($arr_book[$i]["id"]) ? $arr_book[$i]["id"] : '' ?>'>
                            </input>
                        </div>
                    <? }
                    ?>
                    <div class="form-group">
                        <label>Book</label>
                        <input name='book'
                               type='text'
                               class="form-control"
                               value='<?= isset($arr_book[$i]["book"]) ? $arr_book[$i]["book"] : '' ?>'>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>About</label>
                        <textarea name='about'
                                  class="form-control"
                                  rows="3"><?= isset($arr_book[$i]["about"]) ? $arr_book[$i]["about"] : '' ?>
                    </textarea>
                    </div>
                    <div class="form-group">
                        <label>Price ($)</label>
                        <input name='price'
                               type='text'
                               class="form-control"
                               value='<?= isset($arr_book[$i]["price"]) ? $arr_book[$i]["price"] : '' ?>'>
                        </input>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input name='img'
                               type='text'
                               class="form-control"
                               value='<?= isset($arr_book[$i]["img"]) ? $arr_book[$i]["img"] : '' ?>'>
                        </input>
                    </div>

                    <?// }
                }
                ?>
                <br>
                <button name='update' class="btn btn-danger btn-lg" type='submit' value='Update'>Update</button>
            </form>
            <?
        }
        ?>

    </div>

</div>

<div id="add" class="container">
    <div class="row centered">

        <br><br>
        <h3>Add the book</h3>

        <?php

//
//        function insert_author($str, $book_id)
//        {
//            if ($str != "") {
//                $query_author = "SELECT `id` `author` FROM `authors` WHERE `author`='$str'";
//                $result_author = mysql_query($query_author);
//                if (mysql_num_rows($result_author) == 0) {
//                    $query_author_add = "INSERT INTO `authors` (`author`) VALUES ('$str')";
//                    $result_author_add = mysql_query($query_author_add);
//                    if ($result_author_add) {
//                        ?><!--<br>-->
<!--                        <p>Author is added</p>-->
<!--                        --><?//
//                    }
//                }
//
//                $query_author_id = "SELECT `id` FROM `authors` WHERE `author`='$str'";
//                $result_author_id = mysql_query($query_author_id);
//                $author_id = 0;
//                while ($row = mysql_fetch_assoc($result_author_id)) {
//                    $author_id = $row['id'];
//                }
//                $query_author_book = "SELECT `book_id` `authors_id` FROM `books_authors` WHERE `book_id`='$book_id' AND `authors_id`='$author_id'";
//                $result_genre_book = mysql_query($query_author_book);
//                if (mysql_num_rows($result_genre_book) == 0) {
//                    $query_books_author = "INSERT INTO `books_authors` (`book_id`,`authors_id`) VALUES ('$book_id','$author_id')";
//                    $result_books_author = mysql_query($query_books_author);
//                    if ($result_books_author) {
//                        ?><!--<br>-->
<!--                        <p>Id book and id author are added</p>-->
<!--                        --><?//
//                    }
//                }
//            }
//
//        }
//
//        function insert_genre($str, $book_id)
//        {
//        if ($str != "") {
//        $query_genre = "SELECT `id` `genre` FROM `genres` WHERE `genre`='$str'";
//        $result_genre = mysql_query($query_genre);
//        if (mysql_num_rows($result_genre) == 0) {
//            $query_genre_add = "INSERT INTO `genres` (`genre`) VALUES ('$str')";
//            $result_genre_add = mysql_query($query_genre_add);
//            if ($result_genre_add) {
//                ?><!--<br>-->
<!--                <p>Genre is added</p>-->
<!--                --><?//
//            }
//        }
//
//        $query_genre_id = "SELECT `id` FROM `genres` WHERE `genre`='$str'";
//        $result_genre_id = mysql_query($query_genre_id);
//        //$genre_id = 0;
//        while ($row = mysql_fetch_assoc($result_genre_id)) {
//            $genre_id = $row['id'];
//        }
//        $query_genre_book = "SELECT `book_id` `genre_id` FROM `books_genres` WHERE `book_id`='$book_id' AND `genre_id`='$genre_id'";
//        $result_genre_book = mysql_query($query_genre_book);
//        if (mysql_num_rows($result_genre_book) == 0) {
//        $query_books_genres = "INSERT INTO `books_genres` (`book_id`,`genre_id`) VALUES ('$book_id','$genre_id')";
//        $result_books_genres = mysql_query($query_books_genres);
//        if ($result_books_genres) {
//        ?><!--<br>-->
<!--        <p>Id book and id genre are added</p>-->
<!--        --><?//
//        }
//        }
//
//        }
//        }


        if (isset($_POST['add'])) {
        //$id = $_POST['id'];
        //            $book = $_POST['book'];
        //            $about = $_POST['about'];
        //            $price = $_POST['price'];
        //            $img = $_POST['img'];
        //            $inf_book = new Book_class($book, $about, $price, $img);
        //            $query_book = "SELECT `id` `book` FROM `books` WHERE `book`='$inf_book->book'";
        //            $result_book = mysql_query($query_book, $connect);
        //            if (mysql_num_rows($result_book) == 0) {
        //                $query = "INSERT INTO `books` (`book`,`about`,`price`,`img`) VALUE ('$inf_book->book','$inf_book->about','$inf_book->price','$inf_book->img')";
        //                $result = mysql_query($query);
        //                if ($result) {
        //                    ?><!--<br>-->
        <!--                    <p>Book is added</p>-->
        <!--                    --><?//
    //                }
    //            }
    //    $query_bookk = "SELECT `id` FROM `books` WHERE `book`='$inf_book->book'";
    //    $result_bookk = mysql_query($query_bookk, $connect);
    //    while ($row = mysql_fetch_assoc($result_bookk)) {
    //        $id = $row['id'];
    //        //echo $row['id'];
    //    }


    //    for ($i = 1; $i < 4; $i++) {
    //        insert_author($_POST["author" . $i], $id);
    //    }
    //    for ($i = 1; $i < 9; $i++) {
    //        insert_genre($_POST["genre" . $i], $id);
    //    }
    //            for ($i = 1; $i < 9; $i++) {
    //                echo $_POST["author" . $i];
    //            }


    }

    ?>
        <form method="post">

            <div class="form-group">
                <label>Book</label>
                <input name='book'
                       type='text'
                       class="form-control">
                </input>
            </div>
            <div class="form-group container1">
                <label>Author</label>

                <div><input name='author1'
                            type='text'
                            class="form-control">
                    </input></div>
                <button class="add_form_field btn btn-info ">Add New Field &nbsp;
                    <span style="font-size:16px; font-weight:bold;">+ </span></button>
                <br><br>
            </div>
            <div class="form-group">
                <label>About</label>
                <textarea name='about'
                          class="form-control"
                          rows="3"></textarea>
            </div>
            <div class="form-group">
                <label>Price ($)</label>
                <input name='price'
                       type='text'
                       class="form-control">
                </input>
            </div>
            <div class="form-group">
                <label>Image</label>
                <input name='img'
                       type='text'
                       class="form-control">
                </input>
            </div>
            <div class="form-group container2">
                <label>Genre</label>

                <div><input name='genre1'
                            type='text'
                            class="form-control">
                    </input></div>
                <button class="add_form_field2 btn btn-info ">Add New Field &nbsp;
                    <span style="font-size:16px; font-weight:bold;">+ </span></button>
                <br><br>
            </div>

            <br>
            <button name='add' class="btn btn-danger btn-lg" type='submit' value='Add'>Add</button>
        </form>

        <br>

    </div>

</div>


<footer>
    <div id="f">
        <div class="container">
            <div class="row centered">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-vk"></i></a>
            </div>
        </div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type='text/javascript'>
    $(document).ready(function () {
        var max_fields = 3;
        var max_fields_g = 8;
        var wrapper = $(".container1");
        var add_button = $(".add_form_field");
        var wrapper_g = $(".container2");
        var add_button_g = $(".add_form_field2");

        var x = 1;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<div><input type="text" class="form-control" name="author' + x + '"/><a href="#" class="delete">Delete</a></div>');
            }
            else {
                alert('You Reached the limits')
            }
        });
        var x_g = 1;
        $(add_button_g).click(function (e) {
            e.preventDefault();
            if (x_g < max_fields_g) {
                x_g++;
                $(wrapper_g).append('<div><input type="text" class="form-control" name="genre' + x_g + '"/><a href="#" class="delete">Delete</a></div>');
            }
            else {
                alert('You Reached the limits')
            }
        });

        $(wrapper).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
        $(wrapper_g).on("click", ".delete", function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x_g--;
        });
    });

</script>
</body>
</html>


