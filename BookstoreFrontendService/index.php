<?php
session_start();

$index = true;
require_once "./helpers/authorization.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Matheus Nobre">
    <title>Online Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
        .modal-header {background:#D67B22;color:#fff;font-weight:800;}
        .modal-body{font-weight:800;}
        .modal-body ul{list-style:none;}
        .modal .btn {background:#D67B22;color:#fff;}
        .modal a{color:#D67B22;}
        .modal-backdrop {position:inherit !important;}
        #login_button,#register_button{background:none;color:#D67B22!important;}
        #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#D67B22;color:#fff;border-color:#f05f40;border-radius:2px;}
        @media(max-width:767px){
            #query_button {padding: 5px 20px;}
        }

        /* #category ul li{cursor: pointer;color: #337ab7;} */
        /* #category ul li:hover{text-decoration-line: underline;} */
        /* #offer img:hover{cursor: pointer;} */
        #new div div div{color: #337ab7;}
        #new div div div:hover{cursor: pointer;text-decoration-line: underline;}
        /* #author div div img:hover{cursor: pointer;} */
    </style>
</head>
<body>

    <?php include "./components/navbar.php"; ?>

    <div id="top">
        <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
            <div>
                <form role="search" method="POST" action="Result.php">
                    <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book , Author Or Category">
                </form>
            </div>
        </div>

        <div class="container-fluid" id="header">
        <div class="row">
            <div class="col-md-3 col-lg-3" id="category">
                <div style="background:#D67B22;color:#fff;font-weight:800;border:none;padding:15px;"> The Book Shop </div>
                    <ul>
                        <li><a href="Product.php?value=Entrance Exam">Entrance Exam</a></li>
                        <li><a href="Product.php?value=Literature and Fiction">Literature & Fiction</a></li>
                        <li><a href="Product.php?value=Academic and Professional">Academic & Professional</a></li>
                        <li><a href="Product.php?value=Biographies and Auto Biographies">Biographies & Auto Biographies</a></li>
                        <li><a href="Product.php?value=Children and Teens">Children & Teens</a></li>
                        <li><a href="Product.php?value=Regional Books">Regional Books</a></li>
                        <li><a href="Product.php?value=Business and Management">Business & Management</a></li>
                        <li><a href="Product.php?value=Health and Cooking">Health & Cooking</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                            <li data-target="#myCarousel" data-slide-to="4"></li>
                            <li data-target="#myCarousel" data-slide-to="5"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img class="img-responsive" src="img/carousel/1.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive "src="img/carousel/2.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/3.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive"src="img/carousel/4.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/5.jpg">
                            </div>

                            <div class="item">
                                <img class="img-responsive" src="img/carousel/6.jpg">
                            </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3" id="offer">
                    <a href="Product.php?value=Regional Books"><img class="img-responsive center-block" src="img/offers/1.png" title="Regional Books"></a>
                    <a href="Product.php?value=Health and Cooking"><img class="img-responsive center-block" src="img/offers/2.png" title="Health and Cooking"></a>
                    <a href="Product.php?value=Academic and Professional"><img class="img-responsive center-block" src="img/offers/3.png" title="Academic and Professional"></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid text-center" id="new">
        <div class="row">
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-1&category=new">
                    <div class="book-block" id="NEW-1">
                        <div class="tag">New</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="book block-center img-responsive" src="img/new/1.jpg">
                        <hr>
                        <span>Like A Love Song <br>
                        Rs 113  &nbsp</span>
                        <span style="text-decoration:line-through;color:#828282;"> 175 </span>
                        <span class="label label-warning">35%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-2&category=new">
                    <div class="book-block" id="NEW-2">
                        <div class="tag">New</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/2.jpg">
                        <hr>
                        <span>General Knowledge 2017  <br>
                        Rs 68 &nbsp</span>
                        <span style="text-decoration:line-through;color:#828282;"> 120 </span>
                        <span class="label label-warning">43%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-3&category=new">
                    <div class="book-block" id="NEW-3">
                        <div class="tag">New</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/3.png">
                        <hr>
                        <span>Indian Family Bussiness Mantras <br>
                        Rs 400 &nbsp</span>
                        <span style="text-decoration:line-through;color:#828282;"> 595 </span>
                        <span class="label label-warning">33%</span>
                    </div>
                </a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="description.php?ID=NEW-4&category=new">
                    <div class="book-block" id="NEW-4">
                        <div class="tag">New</div>
                        <div class="tag-side"><img src="img/tag.png"></div>
                        <img class="block-center img-responsive" src="img/new/4.jpg">
                        <hr>
                        <span>Kiran s SSC Mathematics Chapterwise Solutions <br>
                        Rs 289 &nbsp</span>
                        <span style="text-decoration:line-through;color:#828282;"> 435 </span>
                        <span class="label label-warning">33%</span>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid" id="author">
        <h3 style="color:#D67B22;"> POPULAR AUTHORS </h3>
        <div class="row">
            <div class="col-sm-5 col-md-3 col-lg-3">
                <a href="Author.php?value=Durjoy Datta"><img class="img-responsive center-block" src="img/popular-author/0.jpg" title="Durjoy Datta"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Chetan Bhagat"><img class="img-responsive center-block" src="img/popular-author/1.jpg" title="Chetan Bhagat"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Dan Brown"><img class="img-responsive center-block" src="img/popular-author/2.jpg" title="Dan Brown"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Ravinder Singh"><img class="img-responsive center-block" src="img/popular-author/3.jpg" title="Ravinder Singh"></a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5 col-md-3 col-lg-3">
                <a href="Author.php?value=Jeffrey Archer"><img class="img-responsive center-block" src="img/popular-author/4.jpg" title="Jeffrey Archer"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Salman Rushdie"><img class="img-responsive center-block" src="img/popular-author/5.jpg" title="Salman Rushdie"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=J K Rowling"><img class="img-responsive center-block" src="img/popular-author/6.jpg" title="J K Rowling"></a>
            </div>
            <div class="col-sm-6 col-md-3 col-lg-3">
                <a href="Author.php?value=Subrata Roy"><img class="img-responsive center-block" src="img/popular-author/7.jpg" title="Subrata Roy"></a>
            </div>
        </div>
    </div>

    <footer style="margin-left:-6%;margin-right:-6%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-1 col-md-1 col-lg-1"></div>
                <div class="col-sm-7 col-md-5 col-lg-5">
                    <div class="row text-center">
                        <h2>Let's Get In Touch!</h2>
                        <hr class="primary">
                        <p>Still Confused? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                    </div>
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-earphone"></span>
                            <p>123-456-6789</p>
                        </div>
                        <div class="col-md-6 text-center">
                            <span class="glyphicon glyphicon-envelope"></span>
                            <p>BookStore@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="hidden-sm-down col-md-2 col-lg-2"></div>
                <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                    <h2 style="color:#D67B22;">Follow Us At</h2>
                    <div>
                        <a href="https://twitter.com/strandbookstore">
                            <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
                        </a>
                        <a href="https://www.linkedin.com/company/strand-book-store">
                            <img title="LinkedIn" alt="LinkedIn" src="img/social/linkedin.png" width="35" height="35" />
                        </a>
                        <a href="https://www.facebook.com/strandbookstore/">
                            <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                        </a>
                        <a href="https://plus.google.com/111917722383378485041">
                            <img title="google+" alt="google+" src="img/social/google.jpg" width="35" height="35" />
                        </a>
                        <a href="https://www.pinterest.com/strandbookstore/">
                            <img title="Pinterest" alt="Pinterest" src="img/social/pinterest.jpg" width="35" height="35" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="container">
        <!-- Trigger the modal with a button -->
        <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query">Ask query</button>
        <!-- Modal -->
        <div class="modal fade" id="query" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Ask your query here</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="query.php" class="form" role="form">
                            <div class="form-group">
                                <label class="sr-only" for="name">Name</label>
                                <input type="text" class="form-control"  placeholder="Your Name" name="sender" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="email">Email</label>
                                <input type="email" class="form-control" placeholder="abc@gmail.com" name="senderEmail" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="query">Message</label>
                                <textarea class="form-control" rows="5" cols="30" name="message" placeholder="Your Query" required></textarea>
                            </div>
                            <div class="form-group">
                                <button type="button" name="submit" id="send_query" class="btn btn-block">Send Query</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>

    <script>
    $(document).ready(function() {

        actionButtons();
    });

    function actionButtons() {
        // Log in;
        $("#send_login").click(function() {
            $.ajax({
                url: `http://localhost:8000/api/users/login`,
                method: 'POST',
                data: {
                    username: $("#login_username").val(),
                    password: $("#login_password").val()
                },
                success: function(response) {
                    let user = response.data.user;
                    let token = `Bearer ${response.data.token}`;

                    userLogin(user, token);
                },
                error: function(error) {
                    getErrorMessage(error);
                }
            });
        });

        // Sign up;
        $("#send_register").click(function() {
            $.ajax({
                url: `http://localhost:8000/api/users`,
                method: 'POST',
                data: {
                    username: $("#register_username").val(),
                    password: $("#register_password").val(),
                    password_confirmation: $("#register_password").val()
                },
                success: function(response) {
                    alert("Successfully Registered!!!");
                    $('.btn.btn-default').trigger('click');
                },
                error: function(error) {
                    getErrorMessage(error);
                }
            });
        });

        // Log out;
        $("#send_logout").click(function() {
            $.ajax({
              url: `http://localhost:8000/api/users/logout`,
              method: 'POST',
              beforeSend: function(xhr) {
                  xhr.setRequestHeader('Authorization', "<?= $_SESSION['token']; ?>");
              },
              success: function(data) {
                  userLogout()
              },
              error: function(error) {
                  getErrorMessage(error);
              }
            });
        });

        // Send query;
        $("#send_query").click(function() {
            alert('send_query');
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

    function userLogin(user, token) {
        alert("successfully logged in!!!");

        let form = $('<form action="index.php" method="post">' +
            '<input type="hidden" name="user" value="' + user + '" />' +
            '<input type="hidden" name="token" value="' + token + '" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }

    function userLogout() {
        let form = $('<form action="index.php" method="post">' +
            '<input type="hidden" name="logout" value="1" />' +
            '</form>');
        $('body').append(form);
        form.submit();
    }
    </script>
</body>
</html>