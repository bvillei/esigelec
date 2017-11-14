<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div id="sidebar-wrapper" class="sidebar-toggle">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <ul class="nav navbar-nav navbar-right">
<!--                    If we are not logged in then we see a register and a login button-->
                    <?php if(!isset($_SESSION['username'])) {?>
                        <li ><a href = "register.php" ><span class="glyphicon glyphicon-log-out" ></span > Register</a ></li >
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>Login</a></li>
<!--                        If we are logged in then we see a logout button-->
                    <?php } else { ?>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
</nav>