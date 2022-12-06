<?php
session_start();
if ($_SESSION['progress'] != 'four') {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
} else if (!strstr($_SERVER['HTTP_REFERER'],"https://purple.greenriverdev.com/walnutridgewedding/Sprint4/reserve.php")) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
}

// unset one session variable
unset($_SESSION['progress']);
// clear all session variables
$_SESSION = array();
// destroy session
session_destroy();

?>
<html>
<head>
    <title>Confirm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <link href="receiptstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passions+Conflict&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="robots.txt">
</head>
<body>
<?php

$servername = "localhost";
$username = "purplegr_purplegr";
$pass = "1+6DymgN6[PAf2";
$dbname = "purplegr_wrwreservation";

$conn = mysqli_connect($servername,$username,$pass,$dbname);

echo '<div class="container-fluid">';
headerImage('images/navimage.jpg', 'Order Details');
echo '
            <div class="row">
                <div class="col-12 text-center">
                    <img src="images/walnutridgebg.png">
                </div>
            </div>
            <div class="row text-center">
                <div class="col-lg-4 col-md-6 col-sm-11 mx-auto receipt">
                <h3 class="text-center">Thank you,</h3>
                <h3 class="text-center">Your Order Is Complete!</h3>
                <p class="text-center">The Walnut Ridge Wedding Rental Team will be confirming your order soon</p>
                <p class="text-center">A complete breakdown of your order will be sent to the email you provided</p>
                <ul><b>Order Summary:</b>';

$to ="";
$subject = "Walnut Ridge Wedding Rentals Order Confirmation";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <walnutridge@orders.com>' . "\r\n";
$message = "
<html>
<head>
<title>Walnut Ridge Order Receipt</title>
</head>
<body>
<ul><b>Order Summary:</b>
";

$firstName = "";
$lastName = "";
$relationship = "";
$phone = "";
$email = "";
$other_name = "";
$other_email = "";
$other_phone = "";
$date = "";
$set = "";
$package = "";
$price = "";
$couch = 0;
$hex = 0;
$galJugs = 0;
$xlWine = 0;
$clearJars = 0;
$blueJars = 0;
$delivery = 0;
$runner = 0;
$typewriter = 0;
$custom_m_sm = 0;
$custom_m_md = 0;
$custom_m_lg = 0;

foreach($_GET as $key => $value)
{
    if ($key == 'custName') {
        $fullName = explode(" ", $value);
        $firstName = $fullName[0];
        $lastName = $fullName[1];
        $message .='<li>Customer: '.$firstName.' '.$lastName.'</li>';
        echo '<li>Customer: '.$firstName.' '.$lastName.'</li>';
    } else if ($key == 'relationship') {
        $message .= '<li>relationship to wedding: ' . $value . '</li>';
        echo '<li>relationship to wedding: ' . $value . '</li>';
        $relationship = $value;
    } else if ($key == 'phone') {
        $message .= '<li>Phone: ' . $value . '</li>';
        echo '<li>Phone: ' . $value . '</li>';
        $phone = $value;
    } else if ($key == 'email') {
        $message .= '<li>Email: ' . $value . '</li>';
        $to = $value;
        echo '<li>Email:  ' . $value . '</li>';
        $email = $value;
    } else if ($key == 'other_name') {
        $message .='<li>Other Customer: '.$value.'</li>';
        echo '<li>Additional Contact: '.$value.'</li>';
        $other_name = $value;
    } else if ($key == 'other_phone') {
        $message .= '<li>Other Phone: ' . $value . '</li>';
        echo '<li>Additional Contact Phone: ' . $value . '</li>';
        $other_phone = $value;
    } else if ($key == 'other_email') {
        $message .= '<li>Other Email: ' . $value . '</li>';
        $to = $value;
        echo '<li>Additional Contact Email:  ' . $value . '</li>';
        $other_email = $value;
    } else if ($key == 'date') {
        $message .= '<li>Date: ' . $value . '</li>';
        echo '<li>Date:  ' . $value . '</li>';
        $date = $value;
    } else if ($key == 'set') {
        $message .= '<li>Set Selected: ' . $value . '</li>';
        echo '<li>Set Selected:  ' . $value . '</li>';
        $set = $value;
    } else if ($key == 'package') {
        $message .= '<li>Package: ' . $value . '</li>';
        echo '<li>Package Selected:  ' . $value . '</li>';
        $package = $value;
    } else if ($key == 'price') {
        $message .= '<li>Price: ' . $value . '</li>';
        echo '<li>Total Estimated Price:  $' . $value . '</li>';
        $price = $value;
    }
}

$message .= '</ul';
echo'</ul';
$count = 0;
foreach($_GET as $key => $value) {
    if ($value == 'on') {
        $count++;
    }
}

if ($count > 0) {
    $message .= 'ul><b>Extras:</b>';
    echo 'ul><b>Extras:</b>';
}

$extras = array("blue_ball", "clear_ball", "couch", "delivery", "gal_jugs", "hex_arbor", "wine_jugs");
foreach($_GET as $key => $value) {
    if ($value == 'on') {
        if ($key == 'couch') {
            $message .= '<li>Vintage Couch</li>';
            echo '<li>Vintage Couch</li>';
            $couch = 1;
        } else if ($key == 'hex_arbor') {
            $message .= '<li>Hexagon Arbor</li>';
            echo '<li>Hexagon Arbor</li>';
            $hex = 1;
        } else if ($key == 'gal_jugs') {
            $message .= '<li>Antique Gallon Jugs</li>';
            echo '<li>Antique Gallon Jugs</li>';
            $galJugs = 1;
        } else if ($key == 'wine_jugs') {
            $message .= '<li>XL Wine Jugs</li>';
            echo '<li>XL Wine Jugs</li>';
            $xlWine = 1;
        } else if ($key == 'clear_ball') {
            $message .= '<li>Clear Antique Ball Jars</li>';
            echo '<li>Clear Antique Ball Jars</li>';
            $clearJars = 1;
        } else if ($key == 'blue_ball') {
            $message .= '<li>Blue Antique Ball Jars</li>';
            echo '<li>Blue Antique Ball Jars</li>';
            $blueJars = 1;
        } else if ($key == 'delivery') {
            $message .= '<li>Your order will be delivered free of charge!</li>';
            echo '<li>Your order will be delivered free of charge!</li>';
            $delivery = 1;
        } else if ($key == 'runner') {
            $message .= '<li>Aisle Runner</li>';
            echo '<li>Aisle Runner</li>';
            $runner = 1;
        } else if ($key == 'typewriter') {
            $message .= '<li>Antique Typewriter</li>';
            echo '<li>Antique Typewriter</li>';
            $typewriter = 1;
        } else if ($key == 'custom_m_sm') {
            $message .= '<li>Small (up to 12 words)</li>';
            echo '<li>Small (up to 12 words)</li>';
            $custom_m_sm = 1;
        } else if ($key == 'custom_m_mg') {
            $message .= '<li>Medium (up to 24 words)</li>';
            echo '<li>Medium (up to 24 words)</li>';
            $custom_m_md = 1;
        } else if ($key == 'custom_m_lg') {
            $message .= '<li>Large (up to 60 words)</li>';
            echo '<li>Large (up to 60 words)</li>';
            $custom_m_lg = 1;
        }
    }
}

$orderNum = "";
$sql = "insert into res_info (sign_set, package, est_cost, wed_date)
            values ('".$set."', '".$package."' , '".$price."', '".$date."')";
if (mysqli_query($conn, $sql)) {

    $grabNum = "select * from res_info order by order_num desc limit 1";
    $result = @mysqli_query($conn, $grabNum);
    $row = mysqli_fetch_assoc($result);
    $orderNum = $row['order_num'];

    $conn->autocommit(FALSE);
    $stmt = $conn->prepare('insert into cust_info (first_name, last_name, relationship, email, phone, order_num, other_name, other_email, other_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->bind_param("sssssisss", $firstName, $lastName, $relationship, $email, $phone, $orderNum, $other_name, $other_email, $other_phone);
    $stmt->execute();
    $stmt->close();
    $conn->autocommit(TRUE);

    $insertExtras = "insert into extras (blue_ball, clear_ball, couch, custom_m_lg, custom_m_md, custom_m_sm, delivery, gal_jugs, hex_arbor, order_num, runner, typewriter, wine_jugs)
            values ('".$blueJars."', '".$clearJars."' , '".$couch."', '".$custom_m_lg."', '".$custom_m_md."', '".$custom_m_sm."', '".$delivery."' , '".$galJugs."'
            , '".$hex."', '".$orderNum."', '".$runner."', '".$typewriter."', '".$xlWine."')";
    mysqli_query($conn, $insertExtras);
} else {
    echo "New record unsuccessful";
}

$message .= '</ul>';

mail($to,$subject,$message,$headers);

echo '</ul>
      </div>
      </div>
      </div>';

function headerImage($imagepath, $set) {
    echo'<style>
.title h1{
    margin-top: 115px;
    font-size: 130px;
    font-family: "Passions Conflict", cursive;;
}

#navBar1 {
    background-image: url('.$imagepath.');
    min-height: 350px;
    background-position: center;
    background-size: cover;
    filter: brightness(0.70);
}

#links1 {
    overflow: hidden;
    background-color: #333;
}

#navContainer1 {
    margin: 20px;
    width: auto;
    float: right;
}

.navigation {
    float: left;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    font-size: 17px;
}


#links {
    overflow: hidden;
    background-color: #333;
}

#navContainer {
    margin: 20px;
    width: auto;
    float: right;
}

a {
    text-decoration: none;
    color: white;
}

a:hover {
    color: white;
}

h1 {
    margin-top: 30px;
    text-align: center;
}

.text-center h1 {
    font-size: 35px;
    font-weight: bold;
    font-family: "Times New Roman", serif;
    color: #d5b6ae;
    margin-bottom: 35px;
}
</style>
<div class="row">
            <div class="col-12" id="navBar1">
                <div id="navContainer1">
                    <div id="links1">
                        <a href="https://www.walnutridgeweddingrentals.com/" target="_blank" class="navigation">Home</a>
                    </div>
                </div>
            <div class="title">
                <h1 style="color : white; text-shadow: 2px 2px 5px black;">'.$set.'</h1>
            </div>
        </div>
    </div>';
}

echo '
<div id="progress">
    <div class="progress col-6 mx-auto" id="progressBar">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">100%</div>
    </div>
</div>';

?>
</body>
</html>
<!-- ALTER TABLE res_info AUTO_INCREMENT = 21 -->