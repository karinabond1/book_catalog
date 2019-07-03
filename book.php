<?php
error_reporting(0);
include_once 'DB.php';
include_once 'Config.php';
$book = $_REQUEST['book_id'];
$db=new DB();
$db->connect();
$arr_book=$db->selectAllWhere("books","id",$book);

$arr_author_id = $db->selectJoinOn("authors_id","books_authors","books","book_id","id","$book");
for($i=0;$i<count($arr_author_id);$i++){
    $author_id = $arr_author_id[$i]["authors_id"];
}

$arr_author = $db->selectWhere("author","authors","id","$author_id");
for($i=0;$i<count($arr_author);$i++){
    $author_name = $arr_author[$i]["author"];
}
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
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">
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
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row centered">

        <br><br>

        <?php
        if (isset($_REQUEST['book_id'])) {

            for ($i = 0; $i < count($arr_book); $i++) {?>
                <div class="col-lg-12">
                    <h2><?= $arr_book[$i]["book"] ?></h2>
                    <h3><?= $author_name ?></h3>
                    <img class="img-thumbnail " src="img/books/<?= $arr_book[$i]["img"] ?>">
                    <h4 class="lefth"><?= $arr_book[$i]["about"] ?></h4>
                    <h3>Price: <?php echo $arr_book[$i]["price"]; ?> $</h3>

                    <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal">BUY
                    </button>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Fill in the fields to buy a book</h4>
                                </div>
                                <form action="buy.php?book_id=<?= $book ?>" method="post">
                                    <div class="modal-body form-group">
                                        <input type="text" class="form-control form-control-lg" name="full_name"
                                               placeholder="Full Name" required/><br>
                                        <input type="text" class="form-control form-control-lg" name="address"
                                               placeholder="Address"/><br>
                                        <input type="number" class="form-control form-control-lg" name="number"
                                               placeholder="Number of copies"/>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger btn-lg">Send</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                    <br><br>

                </div>


                <?
            }
        }

        ?>

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
