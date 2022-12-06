<?php
session_start();
if ($_SESSION['progress'] != 'two') {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
} else if (!strstr($_SERVER['HTTP_REFERER'],"https://purple.greenriverdev.com/walnutridgewedding/Sprint4/packages.php")) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php");
    exit();
}

$_SESSION['progress'] = 'three';

?>

<html>
<head>
    <title>Extras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passions+Conflict&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="robots.txt">
</head>
<body>
<?php

echo '<div class="container-fluid">';
require '/home/purplegr/wrwreservationdb.php';

$date=$_GET['date'];
$splitdate = explode("-", $date);
$month=$splitdate[1];
$set = $_GET['set'];

$price = 0;

headerImage('images/navimage.jpg', 'Extras');
echo '
            <div class="row">
                <div class="col-12 text-center">
                    <img src="images/walnutridgebg.png">
                </div>
            </div>';

echo '<div class="row">
        <div class="col-6 mx-auto text-center">
            <p>Select Extras:</p>
        </div>
      </div>';

//get extra prices


// set package selected, get package price
$package = array();
$package =$_GET['packageSelected'];
$options = unserialize($_GET["options"]);
$optionsString = $_GET["options"];
$packagevalue = substr($package, -3);
$price += $packagevalue;
$packageNum = 0;

$count = 0;
$value = $options[$count];
while($value != $package){
    $count++;
    $value = $options[$count];
    $packageNum++;
}

echo '<form name="availabilityForm" action="reserve.php" method="GET">
            <div class="row">
                <div class="col-3"></div>
                    <div class="col-6">';

require '/home/purplegr/wrwreservationdb.php';
$startDate = new DateTime($date);
$endDate = new DateTime($date);
date_modify($startDate, '-2 days');
date_modify($endDate, '+2 days');
//$sql = "SELECT * FROM extras WHERE wed_date BETWEEN '".$startDate->format('Y-m-d')."' AND '".$endDate->format('Y-m-d')."'";
$sql = "SELECT * FROM res_info INNER JOIN extras ON res_info.order_num=extras.order_num WHERE wed_date 
    BETWEEN '".$startDate->format('Y-m-d')."' AND '".$endDate->format('Y-m-d')."'";
$result = @mysqli_query($cnxn, $sql);
$extras = array("blue_ball", "clear_ball", "couch", "delivery", "gal_jugs", "hex_arbor", "wine_jugs");
$extrastext = array("Blue Antique Ball Jars $30 for 25 Jars (Assorted Sizes)",
    "Clear Antique Ball Jars $30 for 50 Jars (Assorted Sizes)",
    "Vintage Couch $99",
    "Have your order delivered! (Pricing includes delivery)",
    "Antique Gallon Jugs $4 each",
    "Hexagon Arbor $350",
    "XL Wine Jugs $20 each");

$reserved = checkExtraAvailability($result, $extras);
//echo implode(",", $extras);

$i = 0;
foreach ($reserved as $value) {
    if ($reserved[$i] == 1) {
        echo '<input type="checkbox" id="'.$extras[$i].'" name="'.$extras[$i].'" disabled>
        <label for="'.$extras[$i].'">'.$extrastext[$i].' (not available on your date)</label><br>';
    }else {
        echo '<input type="checkbox" id="'.$extras[$i].'" name="'.$extras[$i].'">
        <label for="'.$extras[$i].'">'.$extrastext[$i].'</label><br>';
    }
    $i++;
}

$LA_Pack = array('FULL SET Rental $849 Get all 12 items for only $',
    'PICK 6 Rental $749 Get 2 more items for only $');
$MR_Pack = array('FULL SET Rental $799 Get all 9 items for only $',
    'PICK 6 Rental $699 Get 2 more options for only $');
$VM_Pack = array('Platinum Package Rental $849 Get all 11 items for only $',
    'Gold Package Rental $799 Get 8 items for only $',
    'Pick 6 Rental Package $649 Get 2 more options for only $');
$RW_DW_Pack = array('Full Package Rental $299 Get 2 more signs for only $',
    '“No Seating” Rental $245 Get 9 extra signs for only $');

if ($set == "Layered Arch Wedding Set") {
    displayUpgrades($options, $LA_Pack, $packageNum, $packagevalue);
} else if ($set == "Modern Round Wedding Set") {
    displayUpgrades($options, $MR_Pack, $packageNum, $packagevalue);
} else if ($set == "Vintage Mirror Wedding Set") {
    displayUpgrades($options, $VM_Pack, $packageNum, $packagevalue);
} else {
    displayUpgrades($options, $RW_DW_Pack, $packageNum, $packagevalue);
}
echo '</div>';

function displayUpgrades($options, $packArray, $packageNum, $packagevalue)
{
    $priceDifference = 0;
    echo '<input type = "hidden" name = "priceDifference" value = "'.$priceDifference.'">';
    if ($packageNum != 0) {
        $i = 0;
        echo '</div>
        <div class="row">
            <div class="col-12 mx-auto text-center pt-4">
                <p>Upgrade Your Package:</p>
            </div>
        </div>
        <div class="row">
            <div class="col-6 mx-auto">';
        echo '<input type="radio" id="upgradeoption" name="upgradeoption" value="upgradeoption" checked>
          <label for="upgradeoption">
            <div>
                No upgrade (selected by default)
            </div>
          </label><br>';

        while ($i < $packageNum) {
            $priceDifference = (int)substr($options[$i], -3) - (int)$packagevalue;
            $packArray[$i].= $priceDifference. " more than current package";
            echo '<input type="radio" id="upgradeoption"' . $i . ' name="upgradeoption" value="upgradeoption' . $i . '">
                  <label for="upgradeoption"' . $i . '>'.$packArray[$i].'</label><br>';
            echo '<input type = "hidden" name = "priceDifference' . $i . '" value = "'.$priceDifference.'">';
            $i++;
        }
    }
}

echo'
                </div>
            </div>
        </div>';

$optionsString = serialize($options);
echo '</div>
    <input type = "hidden" name = "set" value = "'.$set.'">
    <input type = "hidden" name = "date" value = "'.$date.'">
    <input type = "hidden" name = "price" value = "'.$price.'">
    <input type = "hidden" name = "package" value = "'.$package.'">
    <input type = "hidden" name = "packagevalue" value = "'.$packagevalue.'">
    <input type = "hidden" name = "options" value = "'.htmlentities($optionsString).'">';
checkIfSet("custom_m_sm");
checkIfSet("custom_m_md");
checkIfSet("custom_m_lg");
checkIfSet("runner");
checkIfSet("typewriter");
echo'</div>
    ';



echo'<div class="row">
        <div class="col-6 mx-auto">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>';

echo '                
    </form>
</div>';

function checkExtraAvailability($result, $extras) {
    $reserved = array(0, 0, 0, 0, 0, 0, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        $i = 0;
        foreach ($extras as $value) {
            if ($row[$value] == 1) {
                $reserved[$i] = 1;
            }
            $i++;
        }
    }
    return $reserved;
}

/*function checkExtraAvailability ($result, $extras){
    $i = 0;
    foreach ($extras as $value) {
        //$j = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            //echo implode(",", $row);
            foreach ($row as $column) {
                if ($column == 1) {
                    $extras[$i] = 1;
                } else {
                    $extras[$i] = 0;
                }
            }
//            echo $row[$value];
//            if ($row['$value'] == '1'){
//                $j = 1;
//            }
//        }
//        $extras[$i] = $j;
            $i++;
        }
        return $extras;
    }
}*/

//$extras = checkExtraAvailability();


function checkIfSet($box) {
    if (isset($_GET[$box])) {
        echo '<input type = "hidden" name = "' . $box . '" value = "' . $_GET[$box] . '">';
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

echo '</div>';

echo '
<div id="progress">
    <div class="progress col-6 mx-auto" id="progressBar">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
    </div>
</div>';

?>
</body>
</html>
