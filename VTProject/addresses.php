<?php
include ("config.php");
session_start();

if ($_POST['delete'] and $_SERVER['REQUEST_METHOD'] == "POST") {
    
    foreach ($_POST as $name => $content) { // Most people refer to $key => $value
        $sql = "CALL delete_address('".$content."' , '" . $_SESSION["UserName"] . "')";
        $result = mysqli_query($db,$sql);
    }
} 
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $type = mysqli_real_escape_string($db, $_POST["type"]);
    $fulladdress = mysqli_real_escape_string($db, $_POST["fulladdress"]);
   
    if (ctype_space($type) || ctype_space($fulladdress) ||
        $type == '' || $fulladdress == '' ) {
        $error = 'At least one of the field is empty';
    }  
    else {
        
        $sql = "CALL insert_address('" . $type . "', '" . $fulladdress . "', '" . $_SESSION["UserName"] . "')";
        $result = mysqli_query($db, $sql);       
    }
} 
else {}
?>
<html><head>

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
                            <h1><a href="addresses.php">Addresses</a></h1>
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
                           <li class="current"><a href="index.php"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                            <li class="submenu">
                                <a href="#">
                                    <i class="glyphicon glyphicon-briefcase"></i> Employee
                                    <span class="caret pull-right"></span>
                                </a>
                                <!-- Sub menu -->
                                <ul>
                                    <li><a href="couriers.php">Couriers</a></li>
                                    <li><a href="officers.php">Officers</a></li>
                                    <li><a href="drivers.php">Drivers</a></li>
                                </ul>
                            </li>
                            <li class="current"><a href="addresses.php"><i class="glyphicon glyphicon-road"></i> Addresses</a></li>
                            <li class="current"><a href="cargo.php"><i class="glyphicon glyphicon-inbox"></i> Cargo</a></li>
                            <li class="current"><a href="customers.php"><i class="glyphicon glyphicon-user"></i> Customers</a></li>
                            <li class="current"><a href="deliveryTypes.php"><i class="glyphicon glyphicon-upload"></i> Delivery Type</a></li>
                            <li class="current"><a href="discounts.php"><i class="glyphicon glyphicon-usd"></i> Discounts </a></li>
                            <li class="current"><a href="feedbacks.php"><i class="glyphicon glyphicon-thumbs-up"></i> Feedbacks </a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="col-md-3">
                        <div class="content-box-large">
                            <div class ="row ">
                                <form action="" method="post">  
                                    <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                                        <?php echo $error; ?>
                                    </div>
                                    <label for="type">Type:</label>
                                    <input class="form-control" type="text" name="type" id="type">
                                    <label for="fulladdress">Full Address:</label>
                                    <input class="form-control" type="text" name="fulladdress" id="fulladdress">                                   
                                    <br />

                                    <div class="action">
                                        <input class="btn btn-primary signup" type = "submit" value = " Add Address "/><br />
                                    </div>    
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="content-box-large">
                            <div class="panel-body">
                                <table class="table table-striped table-bordered" id="example" cellspacing="0" cellpadding="0" border="0">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Full Address</th>
                                        </tr>
                                    </thead>
                                     
                                    <tbody>
                                        
                                        <?php
                                        include("config.php");
                                        //$query = "select field1, fieldn from table [where clause][group by clause][order by clause][limit clause]";
                                        $query = "CALL get_addresses()";
                                        $result = mysqli_query($db, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo "<td>" . $row["Type"] . "</td> <td>" . $row["FullAddress"] . "</td>" ;
                                            echo '</tr>';                                  
                                        }
                                        mysqli_free_result($result);
                                        mysqli_next_result($db);
                                        ?>  
                                        
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


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

    </body></html>