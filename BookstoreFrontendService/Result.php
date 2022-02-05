<?php
session_start();
require_once "./helpers/authorization.php";
?>

<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css/my.css" type="text/css">
<body>
<style>

    #books .row{margin-top:30px;font-weight:800;}
    @media only screen and (max-width: 760px) { #books .row{margin-top:10px;}}
    .book-block {margin-top:20px;margin-bottom:10px; padding:10px 10px 10px 10px; border :1px solid #DEEAEE;border-radius:10px;height:100%;}
</style>

</head>

<body>

    <?php include "./components/navbar.php"; ?>

    <div id="top" >
        <?php include "./components/searchbox.php"; ?>

        <div class="container-fluid" id="search">
            <div class="row">
                <div class="col-xs-12 text-center" id="heading">
                    <h4 style="color:#00B9F5;text-transform:uppercase;"> found 0 records </h4>
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
    var term = urlParams.get('term');

    $(document).ready(function() {

        $.ajax({
            url: `http://localhost:8000/api/search/`,
            method: 'GET',
            data: {
                'term': term,
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

        actionButtons();
    });

    function actionButtons() {
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

        $('#heading>h4').html(` found ${data.length} records `);

        let orders = $(`<div id="list"></div>`);
        const book_element = $(`
            <div>
                <a href="#">
                    <div class="col-sm-5 col-sm-offset-1 col-md-3 col-lg-3 text-center w3-card-8 w3-dark-grey">
                        <div class="book-block">
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
            book_clone.find('.col-sm-5').addClass(`col-md-offset-${(offset > 1 ? 1 : offset)}`);
            book_clone.find('img').attr('src', `img/books/${value.product_id}.jpg`);
            book_clone.find('.book_title').html(value.title);
            book_clone.find('.book_price').html(value.offered_price);
            book_clone.find('.book_mrp').html(value.maximum_price);
            book_clone.find('.book_discount').html(value.discount_pctg);

            row_clone.append(book_clone[0].outerHTML);

            offset = ((aux_offset++) % 3);
            if (offset == 0) {
                orders.append(row_clone[0].outerHTML);
                row_clone = $(`<div class="row"></div>`);
            }
        });
        if (offset != 0) {
            orders.append(row_clone[0].outerHTML);
        }

        $('#search').append(orders[0].outerHTML);
    }

    </script>

</body>
</html>