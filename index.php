<?php
error_reporting(0);
include_once 'DB.php';
include_once 'Config.php';

$db = new DB();
$db->connect();

$arr_genre = $db->selectAll('genres');
sort($arr_genre);

$genre = $_REQUEST['genre_id'];
$arr_book_genre = $db->selectAllJoinOn("books", "books_genres", "id", "book_id", "genre_id", $genre);


$arr_author = $db->selectAll('authors');
sort($arr_author);

$auth = $_REQUEST['author_id'];
$arr_book_author = $db->selectAllJoinOn("books", "books_authors", "id", "book_id", "authors_id", $auth);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book catalog</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="css/fontawesome.min.css">-->
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
    <link rel="apple-touch-icon" sizes="57x57" href="img/klogo.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/klogo.png">
    <link rel="icon" type="image/png" href="img/klogo.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/klogo.png" sizes="16x16">
    <link rel="shortcut icon" href="img/klogo.png">
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
                <li class="active"><a href="#genres">Genres</a></li>
                <li class="active"><a href="#authors">Authors</a></li>
                <li class="active"><a href="/admin/admin.php"">Admin</a></li>
            </ul>
        </div>
    </div>
</div>
<div id="headerwrap">
    <div class="container">
        <div class="row centered">
            <div class="col-lg-8 col-lg-offset-2">
                <h1>Books are awesome!</h1>
                <h2>Here you can find a huge variety of different literature!</h2>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row centered"><br>
        <h3>Why is reading important?</h3>
        <br><br>
        <div class="col-lg-4">
            <i class="fas fa-user-friends"></i>
            <h4>Society</h4>
            <p>Reading is fundamental to functioning in today's society. There are many adults who
                cannot read well enough to understand the instructions on a medicine bottle. That
                is a scary thought - especially for their children. Filling out applications
                becomes impossible without help. Reading road or warning signs is difficult.
                Even following a map becomes a chore. Day-to-day activities that many people take
                for granted become a source of frustration, anger and fear.</p>
        </div>
        <div class="col-lg-4">
            <i class="fas fa-brain"></i>
            <h4>Mind</h4>
            <p>Reading is important because it develops the mind. The mind is a muscle. It needs
                exercise. Understanding the written word is one way the mind grows in its ability.
                Teaching young children to read helps them develop their language skills. It also
                helps them learn to listen. Everybody wants to talk, but few can really listen.
                Lack of listening skills can result in major misunderstandings which can lead to
                job loss, marriage breakup, and other disasters - small and great. Reading helps
                children [and adults] focus on what someone else is communicating.</p>
        </div>
        <div class="col-lg-4">
            <i class="fas fa-user-edit"></i>
            <h4>Job</h4>
            <p>Reading is a vital skill in finding a good job. Many well-paying jobs require
                reading as a part of job performance. There are reports and memos which must
                be read and responded to. Poor reading skills increases the amount of time it
                takes to absorb and react in the workplace. A person is limited in what they can
                accomplish without good reading and comprehension skills.</p>
        </div>
    </div>
    <br><br>
</div>

<div id="genres" class="gen">
    <div class="container">
        <div class="row centered">
            <h3>Genres</h3>
            <p>A genre is a broad term that translates from the French to mean 'kind' or 'type.' In entertainment,
                this can translate to horror, romance, science fiction, etc. In general, these types differ for all
                sorts of reasons, from the actions in their plots to the feelings they elicit from the audience.
                However, in literature, there are some more defined genres. It is important to know which genre a
                piece of work falls into because the reader will already have certain expectations before he even
                begins to read.</p>
            <div class="col-lg-12">
                <?php for ($i = 0; $i < count($arr_genre); $i++) { ?>
                    <a href="?genre_id=<?= $arr_genre[$i]['id'] ?>#genres">
                        <button name="<?= $arr_genre[$i]['id'] ?>" class="btn btn-secondary">
                            <h5><?= $arr_genre[$i]['genre'] ?></h5>
                        </button>

                    </a>
                    <?php
                } ?><br><br>
                <?php
                if (isset($_REQUEST['genre_id'])) {

                    for ($i = 0; $i < count($arr_book_genre); $i++) {
                        ?>
                        <div class="col-lg-4">
                            <a class="imgbook" href="/book.php?book_id=<?= $arr_book_genre[$i]["book_id"] ?>">
                                <img class="img-thumbnail books" src="img/books/<?= $arr_book_genre[$i]["img"] ?>">
                                <p> <?= $arr_book_genre[$i]["book"] ?></p>
                            </a>
                        </div>
                        <?
                    }
                }
                ?>

            </div>
        </div>
    </div>
</div>


<div id="authors" class="gen">
    <div class="container">
        <div class="row centered">
            <h3>Authors</h3>
            <p>One key to being a good writer is to always keep reading—and that doesn't stop after you've been
                published.</p>
            <div class="col-lg-12">
                <?php

                ?>
                <?php for ($i = 0; $i < count($arr_author); $i++) { ?>
                    <a href="?author_id=<?= $arr_author[$i]['id'] ?>#authors">
                        <button name="<?= $arr_author[$i]['id'] ?>" class="btn btn-secondary">
                            <h5><?= $arr_author[$i]['author'] ?></h5>
                        </button>

                    </a>
                    <?php
                } ?><br><br>
                <?php
                if (isset($_REQUEST['author_id'])) {

                for ($i = 0; $i < count($arr_book_author); $i++) {
                        ?>
                        <div class="col-lg-4">
                            <a class="imgbook" href="/book.php?book_id=<?= $arr_book_author[$i]["book_id"] ?>">
                                <img class="img-thumbnail books" src="img/books/<?= $arr_book_author[$i]["img"] ?>">
                                <p> <?= $arr_book_author[$i]["book"] ?></p>
                            </a>
                        </div>
                        <?
                    }
                }
                ?>

            </div>
        </div>
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
<script src="js/bootstrap.min.js"></script>
</body>
</html>