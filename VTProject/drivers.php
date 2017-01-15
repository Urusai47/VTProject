<?php
include ("config.php");
session_start();

if ($_POST['delete'] and $_SERVER['REQUEST_METHOD'] == "POST") {
    echo $_POST['name'];
    
    foreach ($_POST as $name => $content) { // Most people refer to $key => $value
        $sql = "CALL delete_driver('".$content."' , '" . $_SESSION["UserName"] . "')";
        $result = mysqli_query($db,$sql);
    }
} 
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $tc = mysqli_real_escape_string($db, $_POST["tc"]);
    $firstname = mysqli_real_escape_string($db, $_POST["firstname"]);
    $lastname = mysqli_real_escape_string($db, $_POST["lastname"]);
    $phonenumber = mysqli_real_escape_string($db, $_POST["phonenumber"]);
    $ssn = mysqli_real_escape_string($db, $_POST["ssn"]);
    $office = mysqli_real_escape_string($db, $_POST["office"]);
    $carplate = mysqli_real_escape_string($db, $_POST["carplate"]);
    if (ctype_space($tc) || ctype_space($firstname) || ctype_space($lastname) || ctype_space($phonenumber) || ctype_space($ssn) || ctype_space($office) || ctype_space($carplate) ||
        $tc == '' || $firstname == '' || $lastname == '' || $phonenumber == '' || $ssn == '' || $office == '' || $carplate == '') {
        $error = 'At least one of the field is empty';
    }  else {
        $sql = "CALL checkIfAlreadyEmployee('".$tc."')";
	$result = mysqli_query($db,$sql);
	$count = mysqli_num_rows($result);
        mysqli_free_result($result);
        mysqli_next_result($db);
        if($count > 0){
            $error = 'This person is already an employee';
        } else {
             $sql = "CALL insert_driver('" . $tc . "', '" . $firstname . "', '" . $lastname . "', '" . $phonenumber . "', '" . $ssn . "' , '" . $office . "' , '" . $carplate . "' , '" . $_SESSION["UserName"] . "')";
             $result = mysqli_query($db, $sql);
        }
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
                            <h1><a href="drivers.php">Drivers</a></h1>
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
                        </ul>
                    </div>
                </div>


                <div class="col-md-10">
                    <div class="col-md-3">
                        <div class="content-box-large">
                            <div class ="row ">
                                <form action="" method="post">  
                                    <label for="tc">TCKN:</label>
                                    <input class="form-control" type="text" name="tc" id="tc">
                                    <label for="firstName">First Name:</label>
                                    <input class="form-control" type="text" name="firstname" id="firstName">
                                    <label for="lastName">Last Name:</label>
                                    <input class="form-control" type="text" name="lastname" id="lastName">
                                    <label for="phonenumber">Phone Number:</label>
                                    <input class="form-control" type="text" name="phonenumber" id="phonenumber">
                                    <label for="ssn">SSN:</label>
                                    <input class="form-control" type="text" name="ssn" id="ssn">
                                    
                                    <label for="office">Office:</label>
                                    <select name="office">
                                        <?php
                                        include("config.php");
                                        $query = "CALL get_offices()";
                                        $result = mysqli_query($db, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value=\"owner1\">" . $row['Name'] . "</option>";
                                        }
                                         mysqli_free_result($result);
                                         mysqli_next_result($db);
                                        ?>
                                    </select>
                                    <br />
                                    <label for="carplate">Car Plate:</label>
                                       <select name="carplate">
                                        <?php
                                        include("config.php");
                                        $query = "CALL get_vehicles()";
                                        $result = mysqli_query($db, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value=\"owner1\">" . $row['Plate'] . "</option>";
                                        }
                                         mysqli_free_result($result);
                                         mysqli_next_result($db);
                                        ?>
                                    </select>
                                    <br />
                                    <div style = "font-size:11px; color:#cc0000; margin-top:10px">
                                        <?php echo $error; ?>
                                    </div>
                                    <div class="action">
                                        <input class="btn btn-primary signup" type = "submit" value = " Add Driver "/><br />
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
                                            <th>TCKN</th>
                                            <th>SSN</th>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>PhoneNumber</th>
                                            <th>Office</th>
                                            <th>Plate</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                     
                                    <tbody>
                                        
                                        <?php
                                        include("config.php");
                                        //$query = "select field1, fieldn from table [where clause][group by clause][order by clause][limit clause]";
                                        $query = "CALL get_drivers()";
                                        $result = mysqli_query($db, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo "<td>" . $row["TCKN"] . "</td> <td>" . $row["SSN"] . "</td> <td>" . $row["FirstName"] 
                                                    . "</td> <td>" . $row["LastName"] . "</td> <td>" . $row["PhoneNumber"] 
                                                    . "</td> <td>" . $row["Name"] . "</td> <td>" . $row["FK_Driving_Plate"] ;
                                            echo '<form action="" method="post">';
                                            echo "</td> <td> <input type ='submit' class='button' name='delete' value='Delete' /> "
                                            . "<input type ='hidden' name='delete' value='".$row["TCKN"]."' /> </td>";
                                            echo '</form>';
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