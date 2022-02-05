<?php
session_start();
require_once "./helpers/authorization.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Matheus Nobre">
    <title> Online Bookstore | Book</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <style>
        @media only screen and (width: 768px) { body{margin-top:150px;}}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
        .tag {display:inline;float:left;padding:2px 5px;width:auto;background:#F5A623;color:#fff;height:23px;}
        .tag-side{display:inline;float:left;}
        #books {border:1px solid #DEEAEE; margin-bottom:20px;padding-top:30px;padding-bottom:20px;background:#fff; margin-left:10%;margin-right:10%;}
        #description {border:1px solid #DEEAEE; margin-bottom:20px;padding:20px 50px;background:#fff;margin-left:10%;margin-right:10%;}
        #description hr{margin:auto;}
        #service{background:#fff;padding:20px 10px;width:112%;margin-left:-6%;margin-right:-6%;}
        .glyphicon {color:#D67B22;}
    </style>
</head>
<body>

    <?php include "./components/navbar.php"; ?>

    <div id="top" >
        <?php include "./components/searchbox.php"; ?>

        <div class="container-fluid" id="books">
            <div class="row">
                <div class="col-sm-10 col-md-6">
                    <div class="tag"><span class="book_discount"></span>%OFF</div>
                    <div class="tag-side"><img src="img/orange-flag.png"></div>
                    <img class="center-block img-responsive" src="img/books/<?= $_GET['ID']; ?>.jpg" height="550px" style="padding:20px;">
                </div>
                <div class="col-sm-10 col-md-4 col-md-offset-1">
                    <h2> <span class="book_title"></span></h2>
                    <span style="color:#00B9F5;">
                        #<span class="book_author"></span>&nbsp &nbsp #<span class="book_publisher"></span>
                    </span>
                    <hr>
                    <span style="font-weight:bold;"> Quantity : </span>
                    <select id="quantity"></select>
                    <br><br><br>
                    <button type="button" id="send_order" class="btn btn-lg btn-danger" style="padding:15px;color:white;text-decoration:none;">
                        ADD TO CART for R$ <span class="book_price"></span> <br>
                        <span style="text-decoration:line-through;"> R$ <span class="book_mrp"></span></span>
                        | <span class="book_discount"></span>% discount
                    </button>
                </div>
            </div>
        </div>

        <div class="container-fluid" id="description">
            <div class="row">
                <h2> Description </h2>
                <p class="book_description"></p>
                <pre style="background:inherit;border:none;">
                    PRODUCT CODE  <span class="book_pid"></span><hr>
                    TITLE         <span class="book_title"></span><hr>
                    AUTHOR        <span class="book_author"></span><hr>
                    AVAILABLE     <span class="book_available"></span><hr>
                    PUBLISHER     <span class="book_publisher"></span><hr>
                    EDITION       <span class="book_edition"></span><hr>
                    LANGUAGE      <span class="book_language"></span><hr>
                    PAGES         <span class="book_page"></span><hr>
                    WEIGHT        <span class="book_weight"></span><hr>
                </pre>
            </div>
        </div>

        <div class="container-fluid" id="service">
            <div class="row">
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-heart"></span> <br>
                    24X7 Care <br>
                    Happy to help 24X7, call us on 0120-3062244 or click here
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-ok"></span> <br>
                    Trust <br>
                    Your money is yours! All refunds come with no question asked guarantee.
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-check"></span> <br>
                    Assurance <br>
                    We provide 100% assurance. If you have any issue, your money is immediately refunded. Sit back and enjoy your shopping.
                </div>
                <div class="col-sm-6 col-md-3 text-center">
                    <span class="glyphicon glyphicon-tags"></span> <br>
                    24X7 Care <br>
                    Happiness is guaranteed. If we fall short of your expectations, give us a shout.
                </div>
            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <script>

    var urlParams = new URLSearchParams(window.location.search);
    var product_id = urlParams.get('ID');
    var book_id = 0;

    $(document).ready(function() {

        $.ajax({
            url: `http://localhost:8000/api/books/${product_id}`,
            method: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
            },
            success: function(response) {
                setBookElements(response.data[0]);
            },
            error: function(error) {
                getErrorMessage(error);
            }
        });

        actionButtons();
    });

    function actionButtons() {
        // Order;
        $("#send_order").click(function() {
            $.ajax({
                url: `http://localhost:8000/api/orders`,
                method: 'POST',
                data: {
                    book_id: book_id,
                    quantity: $("#quantity").val()
                },
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
                },
                success: function(data) {
                    orderBook();
                },
                error: function(error) {
                    getErrorMessage(error);
                }
            });
        });
    }

    function getErrorMessage(error) {
        if (typeof error.responseJSON !== 'undefined') {
            let errorMessage = Object
                .values(error.responseJSON.error)
                .flat(Infinity)
                .join(' ');
            alert(errorMessage);
        } else {
            console.log('error:', error);
            alert('Something is wrong. Try again later.');
        }
    }

    function orderBook() {
        alert('Added to cart successfully.');
        window.location.replace("cart.php");
    }

    function setBookElements(data) {
        book_id = data.id;

        for (let i = 1; i <= data.available; i++) {
            $('#quantity').append(`<option value="${i}">${i}</option>`);
        }
        $('.book_price').html(data.offered_price);
        $('.book_mrp').html(data.maximum_price);
        $('.book_discount').html(data.discount_pctg);
        $('.book_description').html(data.description);
        $('.book_pid').html(data.product_id);
        $('.book_title').html(data.title);
        $('.book_author').html(data.author);
        $('.book_available').html(data.available);
        $('.book_publisher').html(data.publisher);
        $('.book_edition').html(data.edition);
        $('.book_language').html(data.language);
        $('.book_page').html(data.page);
        $('.book_weight').html(data.weight);
    }

    </script>
</body>
</html>
