<?php
session_start();

require_once "./helpers/authorization.php";
// if(!isset($_SESSION['user']))
//        header("location: index.php?Message=Login To Continue");

$customer=$_SESSION['user'];
if (isset($_GET['place'])) {
    $query="DELETE FROM cart where Customer='$customer'";
    $result=mysqli_query($con,$query);
    ?>
    <script type="text/javascript">
        alert("Order SuccessFully Placed!! Kindly Keep the cash Ready. It will be collected on Delivery");
    </script>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cart">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta name="author" content="Matheus Nobre">
    <title>Order</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
        #cart {margin-top:30px;margin-bottom:30px;}
        .panel {border:1px solid #D67B22;padding-left:0px;padding-right:0px;}
        .panel-heading {background:#D67B22 !important;color:white !important;}
        @media only screen and (width: 767px) { body{margin-top:150px;}}

        #has-orders{display: none;}
    </style>
</head>
<body>

    <?php include "./components/navbar.php"; ?>

    <div id="top" >
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" method="POST" action="Result.php">
                    <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book , Author Or Category">
                </form>
            </div>
        </div>

        <div class="container-fluid" id="cart">
            <div class="row">
                <div class="col-xs-12 text-center" id="heading">
                    <h2 style="color:#D67B22;text-transform:uppercase;">  YOUR CART </h2>
                </div>
            </div>

            <div id="empty_orders">
                <div class="row">
                    <div class="col-xs-9 col-xs-offset-3 col-sm-4 col-sm-offset-5 col-md-4 col-md-offset-5">
                        <span class="text-center" style="color:#D67B22;font-weight:bold;">&nbsp &nbsp &nbsp &nbspCart Is Empty</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-9 col-xs-offset-3 col-sm-2 col-sm-offset-5 col-md-2 col-md-offset-5">
                        <a href="index.php" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;">Do Some Shopping</a>
                    </div>
                </div>
            </div>

            <div id="has_orders">
                <div class="container">
                    <div class="row">
                        <div class="panel col-xs-8 col-xs-offset-2 col-sm-4 col-sm-offset-4 col-md-4 col-md-offset-4 col-lg-4 col-lg-offset-4 text-center" style="color:#D67B22;font-weight:800;">
                            <div class="panel-heading">TOTAL</div>
                            <div class="panel-body" id="total_price">'.$total.'</div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2  col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-3 col-lg-4 col-lg-offset-3">
                        <a href="index.php" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;">Continue Shopping</a>
                    </div>
                    <div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-2 col-md-4 col-md-offset-1 col-lg-4 ">
                        <a href="cart.php?place=true" class="btn btn-lg" style="background:#D67B22;color:white;font-weight:800;margin-top:5px;">Place Order</a>
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
    $(document).ready(function() {

        $.ajax({
            url: `http://localhost:8000/api/orders/me`,
            method: 'GET',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
            },
            success: function(response) {
                setOrderElements(response.data);
            },
            error: function(error) {
                getErrorMessage(error);
            }
        });

        actionButtons();
    });

    function actionButtons() {

        // Remove pedido;
        $(".send_remove_order").click(function() {
            $.ajax({
                url: `http://localhost:8000/api/orders/${$(this).val()}`,
                method: 'DELETE',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
                },
                success: function(data) {
                    removeOrder();
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

    function setOrderElements(data) {
        let orders = $(`<div></div>`);
        const book_element = $(`
            <div class="panel col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center" style="color:#D67B22;font-weight:800;">
                <div class="panel-heading">Order 0</div>
                <div class="panel-body">
                    <img class="image-responsive block-center" src="#" style="height :100px;"> <br>
                    Title : <span class="book_title"></span><br>
                    Code : <span class="book_product_id"></span><br>
                    Author : <span class="book_author"></span><br>
                    Edition : <span class="book_edition"></span><br>
                    Quantity : <span class="book_quantity"></span><br>
                    Price : <span class="book_price"></span><br>
                    Sub Total : <span class="book_subtotal"></span><br>
                    <button type="button" value="" class="send_remove_order btn btn-sm"
                        style="background:#D67B22;color:white;font-weight:800;">
                        Remove
                    </button>
                </div>
            </div>
        `);

        let total = 0;
        let row_clone = $(`<div class="row row-element"></div>`);

        let offset = 0
        let aux_offset = true;
        data.forEach(function(value, index) {

            let book_clone = book_element.clone();

            offset = (aux_offset = !aux_offset) + 1;
            book_clone.addClass(`col-sm-offset-${offset}`);
            book_clone.addClass(`col-md-offset-${offset}`);
            book_clone.addClass(`col-lg-offset-${offset}`);

            let subtotal = value.quantity * value.book.offered_price;
            total += subtotal;

            book_clone.find('.panel-heading').html(`Order ${index + 1}`);
            book_clone.find('img').attr('src', `img/books/${value.book.product_id}.jpg`);
            book_clone.find('.book_title').html(value.book.title);
            book_clone.find('.book_product_id').html(value.book.product_id);
            book_clone.find('.book_author').html(value.book.author);
            book_clone.find('.book_edition').html(value.book.edition);
            book_clone.find('.book_quantity').html(value.quantity);
            book_clone.find('.book_price').html(value.book.offered_price);
            book_clone.find('.book_subtotal').html(subtotal);
            book_clone.find('button').val(value.id);

            row_clone.append(book_clone[0].outerHTML);

            if (offset == 2) {
                orders.append(row_clone[0].outerHTML);
                row_clone = $(`<div class="row row-element"></div>`);
            }
        });
        if (offset == 1) {
            orders.append(row_clone[0].outerHTML);
        }

        $('#has_orders').prepend(orders[0].outerHTML);
        $('#total_price').html(total);
        $('#empty_orders').hide();

        actionButtons();
    }

    function removeOrder() {
        alert("Item Successfully Removed");
        document.location.reload();
    }
    </script>
</body>
<html>