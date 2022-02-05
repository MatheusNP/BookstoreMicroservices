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
    <title>Online Bookstore | Category</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">

    <style>
        #books {margin-bottom:50px;}
        @media only screen and (width: 767px) { body{margin-top:150px;}}
        #books .row{margin-top:20px;margin-bottom:10px;font-weight:800;}
        @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}

    </style>
</head>
<body>

    <?php include "./components/navbar.php"; ?>

    <div id="top" >
        <?php include "./components/searchbox.php"; ?>

        <div class="container-fluid" id="books">
            <div class="row">
            <div class="col-xs-12 text-center" id="heading">
                <h2 style="color:rgb(228, 55, 25);text-transform:uppercase;margin-bottom:0px;"> STORE </h2>
            </div>
            </div>
            <div class="container fluid">
                <div class="row">
                    <div class="col-sm-5 col-sm-offset-6 col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8">
                        <label for="sort">Sort by &nbsp: &nbsp</label>
                        <select name="sort" id="select" onchange="setOrder(this.value);">
                            <option value="" selected>Select</option>
                            <option value="offered_price#asc">Low To High Price </option>
                            <option value="offered_price#desc">Highest To Lowest Price </option>
                            <option value="discount_pctg#asc">Low To High Discount </option>
                            <option value="discount_pctg#desc">Highest To Lowest Discount</option>
                        </select>
                    </div>
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
    var category_name = urlParams.get('value');
    var order_by = "";

    $(document).ready(function() {

        actionButtons();
    });

    function actionButtons() {

        $.ajax({
            url: `http://localhost:8000/api/books/category/`,
            method: 'GET',
            data: {
                'category_name': category_name,
                'order_by': order_by
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
            },
            success: function(response) {
                setBookListElements(response.data);
            },
            error: function(error) {
                getErrorMessage(error);
            }
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

    function setBookListElements(data) {
        $('#list').remove();

        $('#heading>h2').html(`${category_name} STORE`);

        let orders = $(`<div id="list"></div>`);
        const book_element = $(`
            <div>
                <a href="#">
                    <div class="col-sm-6 col-md-3 col-lg-3 text-center">
                        <div class="book-block" style="border :3px solid #DEEAEE;">
                            <img class="book block-center img-responsive" src="#">
                            <hr>
                            <span class="book_title"></span><br>
                            <span class="book_price"></span> &nbsp
                            <span style="text-decoration:line-through;color:#828282;"> <span class="book_mrp"></span> </span>
                            <span class="label label-warning"><span class="book_discount"></span>%</span>
                        </div>
                    </div>
                </a>
            </div>
        `);

        let row_clone = $(`<div class="row"></div>`);

        let offset = 0
        let aux_offset = 1;
        data.forEach(function(value, index) {

            let book_clone = book_element.clone();
            book_clone.find('a').attr('href', `description.php?ID=${value.product_id}`);
            book_clone.find('img').attr('src', `img/books/${value.product_id}.jpg`);
            book_clone.find('.book_title').html(value.title);
            book_clone.find('.book_price').html(value.offered_price);
            book_clone.find('.book_mrp').html(value.maximum_price);
            book_clone.find('.book_discount').html(value.discount_pctg);

            row_clone.append(book_clone[0].outerHTML);

            offset = ((aux_offset++) % 4);
            if (offset == 0) {
                orders.append(row_clone[0].outerHTML);
                row_clone = $(`<div class="row"></div>`);
            }
        });
        if (offset != 0) {
            orders.append(row_clone[0].outerHTML);
        }

        $('#books').append(orders[0].outerHTML);
    }

    function setOrder(value) {

        order_by = value;
        actionButtons();
    }
    </script>

</body>
</html>