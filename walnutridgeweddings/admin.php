<?php
//if there is a session
session_start();
if ($_SESSION['login'] != true) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/login.php");
    exit();
} else if (!strstr($_SERVER['HTTP_REFERER'],"https://purple.greenriverdev.com/walnutridgewedding/Sprint4/login.php")) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/login.php");
    exit();
} else if ($_POST['uname'] != 'admin' || $_POST['psw'] != 'admin'){
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/login.php");
    exit();
}
session_regenerate_id();

//if(!strstr($_POST['uname'] == 'admin' &&  $_POST['psw'] == 'admin'))
//    die("Wrong user name or password");


?>


<head>
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="sortfunction.js"></script>
    <link href="robots.txt">
</head>
<body class="admin-body">
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mx-auto">
            <h1 class="spacertop">Wedding Reservations</h1>
            <table class="table table-dark" id="adminTable">
                <tr>
                    <th>Order#</th>
                    <th onClick="sortTable(1)">Customer <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(2)">Relation <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(3)">Phone <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(4)">Email <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(5)">Additional Contact<i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(6)">Set <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(7)">Package <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(8)">Extras <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(9)">Cost <i class="fa fa-fw fa-sort"></i></th>
                    <th onClick="sortTable(10)">Wedding Date <i class="fa fa-fw fa-sort"></i></th>
                </tr>

                <?php
                require '/home/purplegr/wrwreservationdb.php';

                //$sql = "select * from order_info order by wed_date";
                $sql = "SELECT * FROM res_info INNER JOIN cust_info ON res_info.order_num=cust_info.order_num INNER JOIN extras ON res_info.order_num=extras.order_num order by wed_date";
                $result = @mysqli_query($cnxn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    $extras = "";
                    $ordernum = $row['order_num'];
                    $first = $row['first_name'];
                    $last = $row['last_name'];
                    $name = $first . " " . $last;
                    $relationship = $row['relationship'];
                    $phone = $row['phone'];
                    $email = $row['email'];
                    $other_name = $row['other_name'];
                    $other_phone = $row['other_phone'];
                    $other_email = $row['other_email'];

                    $set = $row['sign_set'];
                    $package = $row['package'];
                    $hex = $row['hex_arbor'];
                    if ($hex == 1) {
                        $extras .= 'Hexagon Arbor, ';
                    }
                    $couch = $row['couch'];
                    if ($couch == 1) {
                        $extras .= 'Vintage Couch, ';
                    }
                    $wine_jugs = $row['wine_jugs'];
                    if ($wine_jugs == 1) {
                        $extras .= 'XL Wine Jugs, ';
                    }
                    $gal_jugs = $row['gal_jugs'];
                    if ($gal_jugs == 1) {
                        $extras .= 'Antique Gallon Jugs, ';
                    }
                    $clear_ball = $row['clear_ball'];
                    if ($clear_ball == 1) {
                        $extras .= 'Clear Antique Ball Jars, ';
                    }
                    $blue_ball = $row['blue_ball'];
                    if ($blue_ball == 1) {
                        $extras .= 'Blue Antique Ball Jars, ';
                    }
                    $delivery = $row['delivery'];
                    if ($delivery == 1) {
                        $extras .= 'Delivery, ';
                    }
                    $extras = substr($extras, 0, -2);
                    $cost = $row['est_cost'];
                    $wed_date = $row['wed_date'];

                    $other = "No";
                    if ($other_email || $other_phone){
                        $other = "Yes";
                        if ($other_name){
                            $other = $other_name;
                        }
                    }

                    echo '<tr>
<td>'.$ordernum.'</td>
<td>'.$name.'</td>
<td>'.$relationship.'</td>
<td>'.$phone.'</td>
<td>'.$email.'</td>
<td>'.$other.'</td>
<td>'.$set.'</td>
<td>'.$package.'</td>
<td>'.$extras.'</td>
<td>$'.$cost.'</td>
<td>'.$wed_date.'</td>
</tr>';
                }
                ?>

            </table>
        </div>
    </div>
</div>
</body>
