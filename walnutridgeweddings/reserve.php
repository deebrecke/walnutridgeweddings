<?php
session_start();
if ($_SESSION['progress'] != 'three') {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
} else if (!strstr($_SERVER['HTTP_REFERER'],"https://purple.greenriverdev.com/walnutridgewedding/Sprint4/extras.php")) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
}

$_SESSION['progress'] = 'four';

?>

<html>
<head>
    <title>Reserve</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passions+Conflict&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="robots.txt">
</head>
<body>
<?php

$date=$_GET['date'];
$splitdate = explode("-", $date);
$month=$splitdate[1];
$set = $_GET['set'];
$package = $_GET['package'];
$price = $_GET['price'];
$priceDifference = 0;
$options = unserialize($_GET["options"]);

if (isset($_GET['upgradeoption'])) {
    $priceDifference = $_GET['priceDifference'];
    $upgradeoption = $_GET['upgradeoption'];
    if ($upgradeoption != 'upgradeoption') {
        $upgradeNum = substr($upgradeoption, -1);
        $package = $options[$upgradeNum];
        $priceDifference = $_GET['priceDifference'.$upgradeNum];
        $price += $priceDifference;
    }
}

$packagevalue = $_GET['packagevalue'];


echo '<div class="container-fluid">';

headerImage('images/navimage.jpg', 'Reserve');
echo '
            <div class="row">
                <div class="col-12 text-center">
                    <img src="images/walnutridgebg.png">
                </div>
            </div>';
//You Selected (Package name)
echo '<div class="row">
        <div class="col-6 mx-auto">
            <p>Set Selected: '.$set.'</p> 
            <p>Package Selected: '.$package.'</p>';
//from (Set name)
//with (extras are below)
$price += displayIfSet('hex_arbor', 'Hexagon Arbor', '350');
$price += displayIfSet('couch', 'Vintage Couch', '99');
$price += displayIfSet('gal_jugs', 'Antique Gallon Jugs', '4');
$price += displayIfSet('wine_jugs', 'XL Wine Jugs', '20');
$price += displayIfSet('clear_ball', 'Clear Antique Ball Jars', '30');
$price += displayIfSet('blue_ball', 'Blue Antique Ball Jars', '30');
$price += displayIfSet('delivery', 'Your order will be delivered free of charge', '0');
$price += displayIfSet('runner', 'Aisle Runner', '99');
$price += displayIfSet('typewriter', 'Antique Typewriter', '99');
$price += displayIfSet('custom_m_sm', 'Small (up to 12 words)', '40');
$price += displayIfSet('custom_m_md', 'Medium (up to 24 words)', '60' );
$price += displayIfSet('custom_m_lg', 'Large (up to 60 words)', '80');

echo '<p>Total Estimated Price: $'.$price.'</p>
        </div>
      </div>';

echo '<div class="row">
        <div class="col-6 mx-auto">
            <p>Please provide the following information:</p>
        </div>
      </div>
      
      <form name="availabilityForm" action="confirm.php" method="GET">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="custName">Your Name</label>
                        <input type="text" class="form-control" id="custName" name="custName" required>
                        <label for="custName">Relationship to Wedding (Bride, Groom, Wedding Planner, Mother of Bride, etc.)</label>
                        <input type="text" class="form-control" id="relationship" name="relationship">
                        
                        <label for="phone">Your Phone number (as ###-###-####) </label>
                        <input type="tel" class="form-control" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"required>

                          <label for="email">Your Email Address</label>
                        <input type = "email" class="form-control" id="email" name="email" required>
                        
                        <p>If you would like us to CC anyone, please put their contact info here:</p>
                       
                        <label for="other_name">Other Contact Name</label>
                        <input type = "text" class="form-control" id="other_name" name="other_name">
                        
                        <label for="other_phone">Other Phone number (as ###-###-####) </label>
                        <input type="tel" class="form-control" id="other_phone" name="other_phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}">
                        
                        <label for="other_email">Other Email Address</label>
                        <input type = "email" class="form-control" id="other_email" name="other_email">
                        
                        
                    </div>
                </div>
                <div class="col-3"></div>
            </div>';

echo '</div>
                </div>
                <input type = "hidden" name = "set" value = "'.$set.'">
                <input type = "hidden" name = "package" value = "'.$package.'">
                <input type = "hidden" name = "date" value = "'.$date.'">
                <input type = "hidden" name = "price" value = "'.$price.'">';
checkIfSet("hex_arbor");
checkIfSet("couch");
checkIfSet("gal_jugs");
checkIfSet("wine_jugs");
checkIfSet("clear_ball");
checkIfSet("blue_ball");
checkIfSet("delivery");
checkIfSet("runner");
checkIfSet("typewriter");
checkIfSet("custom_m_sm");
checkIfSet("custom_m_md");
checkIfSet("custom_m_lg");
echo'
                </div>
                <div class="row">
                    <div class="col-6 mx-auto">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>';

function displayPackageSelected($package) {
    echo '
          <p>Package Selected: '.$package.'</p>
     ';
}

function checkIfSet($box) {
    if (isset($_GET[$box])) {
        echo '<input type = "hidden" name = "' . $box . '" value = "' . $_GET[$box] . '">';
    }
}

function displayIfSet($box, $boxname, $boxprice) {
    if (isset($_GET[$box])) {
        echo '<div class="col-6">
                <p>Extra: '.$boxname.' $'.$boxprice.'</p>
              </div>';
        return $boxprice;
    } else {
        return 0;
    }
}

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
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
    </div>
</div>';

?>
</body>
</html>
