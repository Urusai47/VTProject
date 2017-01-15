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
                            <h1><a href="index.html">Employee</a></h1>
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
                            <li><a href="employees.php"><i class="glyphicon glyphicon-briefcase"></i> Employees</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-10">
                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Driver</div>
                        </div>
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
                                        echo "<td>" . $row["TCKN"] . "</td> <td>" . $row["SSN"] . "</td> <td>" . $row["FirstName"] . "</td> <td>" . $row["LastName"] . "</td> <td>" . $row["PhoneNumber"] . "</td> <td>" . $row["FK_Office_OfficeID"] . "</td> <td>"  . $row["FK_Driving_Plate"] . "</td>";
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