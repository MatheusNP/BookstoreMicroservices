
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo.jpg"  style="width: 147px;margin: 0px;"></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <?php if(!isset($_SESSION['user'])): ?>
                <li>
                    <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                    <div id="login" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Login Form</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Username</label>
                                            <input type="text" name="login_username" id="login_username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" name="login_password" id="login_password" class="form-control"  placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" name="login" id="send_login" class="btn btn-block">Log in</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
                    <div id="register" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center">Member Registration Form</h4>
                                </div>
                                <div class="modal-body">
                                    <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Username</label>
                                            <input type="text" name="register_username" id="register_username" class="form-control" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" name="register_password" id="register_password" class="form-control"  placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" name="submit" id="send_register" class="btn btn-block">Sign Up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php else: ?>
                <li> <span class="btn btn-lg" onClick='window.location.replace("index.php");'> Hello <?= $_SESSION['user']; ?></span></li>
                <li> <span id='send_cart' class="btn btn-lg" onClick='window.location.replace("cart.php");'> Cart </span> </li>
                <li> <span id='send_logout' class="btn btn-lg"> LogOut </span> </li>
                <?php endif; ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>