<!DOCTYPE html>
<html>
    <head>
        <title>Bootstrap Admin Theme v3</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- jQuery UI -->
        <link href="https://code.jquery.com/ui/1.10.3/themes/redmond/jquery-ui.css" rel="stylesheet" media="screen">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- styles -->
        <link href="css/styles.css" rel="stylesheet">
    </head>
    
    <body>
        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <!-- Logo -->
                        <div class="logo">
                            <h1><a href="index.html">Bootstrap Admin Theme</a></h1>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="input-group form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">Search</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="navbar navbar-inverse" role="banner">
                            <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Account <b class="caret"></b></a>
                                        <ul class="dropdown-menu animated fadeInUp">
                                            <li><a href="profile.html">Profile</a></li>
                                            <li><a href="login.html">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="page-content">
            <div class="row">
                <div class="col-md-2">
                    <div class="sidebar content-box" style="display: block;">
                        <ul class="nav">
                            <!-- Main menu -->
                            <<li class="current"><a href="index.html"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li><a href="employees.php"><i class="glyphicon glyphicon-briefcase"></i> Employees</a></li>
                            <li class="submenu">
                                <a href="#">
                                    <i class="glyphicon glyphicon-list"></i> Pages
                                    <span class="caret pull-right"></span>
                                </a>
                                <!-- Sub menu -->
                                <ul>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="signup.html">Signup</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Bootstrap dataTables</div>
                        </div>
                        <div class="panel-body">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
                                <thead>
                                    <tr>
                                        <th>Rendering engine</th>
                                        <th>Browser</th>
                                        <th>Platform(s)</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include("config.php");
                                    //$query = "select field1, fieldn from table [where clause][group by clause][order by clause][limit clause]";

                                    $query = "SELECT * FROM user";
                                    $result = mysqli_query($db, $query);


                                    echo "<table>"; // start a table tag in the HTML
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "Username: " . $row["UserName"] . " - Name: " . $row["Password"] . " " . $row["Type"] . "<br>";
                                    }
                                    echo "</table>";
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>




                <footer>
                    <div class="container">

                        <div class="copy text-center">
                            Copyright 2014 <a href='#'>Website</a>
                        </div>

                    </div>
                </footer>

                <link href="vendors/datatables/dataTables.bootstrap.css" rel="stylesheet" media="screen">

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://code.jquery.com/jquery.js"></script>
                <!-- jQuery UI -->
                <script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="bootstrap/js/bootstrap.min.js"></script>

                <script src="vendors/datatables/js/jquery.dataTables.min.js"></script>

                <script src="vendors/datatables/dataTables.bootstrap.js"></script>

                <script src="js/custom.js"></script>
                <script src="js/tables.js"></script>
                </body>
                </html>




