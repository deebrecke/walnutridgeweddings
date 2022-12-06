<?php
session_start();
if ($_SESSION['progress'] != 'one') {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint5/form.php");
    exit();
} else if (!strstr($_SERVER['HTTP_REFERER'],"https://purple.greenriverdev.com/walnutridgewedding/Sprint4/form.php")) {
    header("Location: https://purple.greenriverdev.com/walnutridgewedding/Sprint5/form.php");
    exit();
}

$_SESSION['progress'] = 'two';

?>

<html>
<head>
    <title>packages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Passions+Conflict&display=swap" rel="stylesheet">
    <meta name="robots" content="noindex, nofollow">
    <link href="robots.txt">
</head>
<body>
<?php

require '/home/purplegr/wrwreservationdb.php';

echo '<div class="container-fluid">';

$date=$_GET['weddingDate'];
$splitdate = explode("-", $date);
$month=$splitdate[1];

$price = 0;

$setSelected = $_GET['setSelected'];

$result = 0;

if($setSelected == "Layered Arch Wedding Set") {

    try {
        $result = checkAvailability($setSelected, $date);
    } catch (Exception $e) {
    }
    if($result > 0)
    {
        startPage();
        printDateUnavailable();
    }else{
        headerImage('images/keepsake.jpg', 'Layered Arch');
        startPage();
        startForm();
        $options = array('FULL SET Rental $849', 'PICK 6 Rental $749', 'PICK 4 Rental $699');
        echo '
            <option value="" disabled selected>Select your option</option>';
        foreach($options as $package){
            echo "<option>$package</option>";

        }
        echo '</select>';
        echo '
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Full Set Rental $849
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>INCLUDES EACH OF THE FOLLOWING ITEMS</strong>
                    <ul>
                        <li>Customized welcome sign (choice of trellis half arch or smooth half arch insert up to 25 words text)</li>
                        <li>3 piece seating chart half arch set (print service for cards is available for a small additional fee)</li>
                        <li>Table numbers 1-30</li>
                        <li>Gold Card Terrarium with choice of “Gifts & Cards” sign</li>
                        <li>5 “Reserved” signs</li>
                        <li>Up to 2 Double Half Arch Small signs (“Gifts & Cards,” “Take One,” “Don\'t Mind if I Do,” “In Loving Memory”)</li>
                        <li>Up to 2 Sunset Small signs (“Please Sign Our Guestbook,” “Gifts & Cards,” “In Loving Memory”)</li>
                        <li>1 Double Half Arch Medium sign (“Cheers,” “The Bar,” “Guestbook,” or Custom Acrylic Text)</li>
                        <li>1 Double Full Arch Medium sign (“Signature Drinks,” or Custom Acrylic Text)</li>
                        <li>Unplugged Ceremony sign</li>
                        <li>Hairpin Record Player Prop</li>
                        <li>"Mr & Mrs" Custom Head Table Keepsake is a free gift in addition to the items above</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Pick 6 Rental $749
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>CHOOSE 6 OF THE FOLLOWING ITEMS</strong>
                    <ul>
                        <li>Customized welcome sign (choice of trellis half arch or smooth half arch insert up to 25 words text)</li>
                        <li>3 piece seating chart half arch set (print service for cards is available for a small additional fee)</li>
                        <li>Table numbers 1-30</li>
                        <li>Gold Card Terrarium with choice of “Gifts & Cards” sign</li>
                        <li>5 “Reserved” signs</li>
                        <li>Up to 2 Double Half Arch Small signs (“Gifts & Cards,” “Take One,” “Don\'t Mind if I Do," "In Loving Memory")</li>
                        <li>Up to 2 Sunset Small signs (“Please Sign Our Guestbook,” “Gifts & Cards,” “In Loving Memory”)</li>
                        <li>1 Double Half Arch Medium sign (“Cheers,” “The Bar,” “Guestbook,” or Custom Acrylic Text)</li>
                        <li>1 Double Full Arch Medium sign (“Signature Drinks,” or Custom Acrylic Text) </li>
                        <li>Unplugged Ceremony sign</li>
                        <li>Hairpin Record Player Prop</li>
                        <li>"Mr & Mrs" Custom Head Table Keepsake is a free gift in addition to the 6 items you choose</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Pick 4 Rental $699
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>CHOOSE 4 OF THE FOLLOWING ITEMS</strong>
                    <ul>
                        <li>Customized welcome sign (choice of trellis half arch or smooth half arch insert up to 25 words text)</li>
                        <li>3 piece seating chart half arch set (print service for cards is available for a small additional fee)</li>
                        <li>Table numbers 1-30</li>
                        <li>Gold Card Terrarium with choice of “Gifts & Cards” sign</li>
                        <li>5 “Reserved” signs</li>
                        <li>Up to 2 Double Half Arch Small signs (“Gifts & Cards,” “Take One,” “Don\'t Mind if I Do," "In Loving Memory")</li>
                        <li>Up to 2 Sunset Small signs (“Please Sign Our Guestbook,” “Gifts & Cards,” “In Loving Memory”)</li>
                        <li>1 Double Half Arch Medium sign (“Cheers,” “The Bar,” “Guestbook,” or Custom Acrylic Text)</li>
                        <li>1 Double Full Arch Medium sign (“Signature Drinks,” or Custom Acrylic Text) </li>
                        <li>Unplugged Ceremony sign</li>
                        <li>Hairpin Record Player Prop</li>
                        <li>"Mr & Mrs" Custom Head Table Keepsake is a free gift in addition to the 6 items you choose</li>
                     </ul>                
                 </div>
                </div>
              </div>
            </div>';
        endForm($options);
    }
}

elseif($setSelected == "Vintage Mirror Wedding Set")
{
    try {
        $result = checkAvailability($setSelected, $date);
    } catch (Exception $e) {
    }
    if($result > 1)
    {
        startPage();
        printDateUnavailable();
    }else{
        headerImage('images/mirror_banner.jpg', 'Vintage Mirror');
        startPage();
        startForm();
        $options = array('Platinum Package Rental $849', 'Gold Package Rental $799', 'Pick 6 Rental Package $649',
            'Pick 4 Rental Package $599');
        echo '
            <option value="" disabled selected>Select your option</option>';
        foreach($options as $package){
            echo "<option>$package</option>";
        }
        echo ' </select>
            <p>Additional Custom Mirrors</p>
            <input type="checkbox" id="custom_m_sm" name="custom_m_sm" value="small">
            <label for="c_m_small">SMALL - up to 12 words $40</label><br>
            <input type="checkbox" id="custom_m_md" name="custom_m_md" value="medium">
            <label for="c_m_small">MEDIUM - up to 24 words $60</label><br>
            <input type="checkbox" id="custom_m_lg" name="custom_m_lg" value="large">
            <label for="c_m_small">LARGE - up to 60 words $80</label><br> ';

        echo '
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Platinum Package Rental $849
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>PRICING INCLUDES DELIVERY AND TEARDOWN WITHIN A 30 MILE RADIUS OF ORRVILLE, OH.</strong>
                    <br>
                    <strong>INCLUDES ALL OF THE FOLLOWING 11 ITEMS</strong>
                    <ul>
                        <li>Welcome Sign with custom names & date & large wrought iron easel</li>
                        <li>Antique Typewriter Rental with customized message (100 words or less)</li>
                        <li>Choice of Linen Seating Chart Stringer or Large Custom Mirror for gold seal application</li>
                        <li>Table Numbers 1-30</li>
                        <li>Leather Domed Trunk with “cards” mirror with stand</li>
                        <li>“Enjoy the Moment- no photography please” mirror with stand</li>
                        <li>“Guestbook” mirror with stand</li>
                        <li>“Take One” small vanity mirror</li>
                        <li>1 Large Full Custom Mirror (50 words or less) with large wrought iron easel</li>
                        <li>1 Medium Full Custom Mirror (20 words or less)  with large wrought iron easel</li>
                        <li>1 Small Custom Mirror (10 words or less) with wrought iron easel</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Gold Package Rental $799
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>PRICING INCLUDES DELIVERY AND TEARDOWN WITH A 30 MILE RADIUS OF ORRVILLE, OH.</strong>
                    <br>
                    <strong>INCLUDES ALL THE FOLLOWING 8 ITEMS</strong>
                    <ul>
                        <li>Welcome Sign with custom names & date & large wrought iron easel</li>
                        <li>Antique Typewriter Rental with customized message (100 words or less)</li>
                        <li>Choice of Linen Seating Chart Stringer or Large Custom Mirror for gold seal application</li>
                        <li>Table Numbers 1-30</li>
                        <li>Leather Domed Trunk with “cards” mirror with stand</li>
                        <li>“Enjoy the Moment- no photography please” mirror with stand</li>
                        <li>“Guestbook” mirror with stand</li>
                        <li>“Take One” small vanity mirror</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Pick 6 Rental Package $649
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>PRICING INCLUDES DELIVERY AND TEARDOWN WITH A 30 MILE RADIUS OF ORRVILLE, OH.</strong>
                    <br>
                    <strong>INCLUDES ALL THE FOLLOWING 6 ITEMS</strong>
                    <ul>
                        <li>Welcome Sign with custom names & date & large wrought iron easel</li>
                        <li>Antique Typewriter Rental with customized message (100 words or less)</li>
                        <li>Pair of 2 Linen Stringers with wrought iron easels </li>
                        <li>Large Custom Mirror for gold seal application</li>
                        <li>Table Numbers 1-30</li>
                        <li>Leather Domed Trunk with “cards” mirror with stand</li>
                        <li>“Enjoy the Moment- no photography please” mirror with stand</li>
                        <li>“Guestbook” mirror with stand</li>
                        <li>“Take One” small vanity mirror</li>
                     </ul>                
                 </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Pick 4 Rental Package $599
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>PRICING INCLUDES DELIVERY AND TEARDOWN WITH A 30 MILE RADIUS OF ORRVILLE, OH.</strong>
                    <br>
                    <strong>INCLUDES ALL THE FOLLOWING 4 ITEMS</strong>
                    <ul>
                        <li>Welcome Sign with custom names & date & large wrought iron easel</li>
                        <li>Antique Typewriter Rental with customized message (100 words or less)</li>
                        <li>Pair of 2 Linen Stringers with wrought iron easels</li>
                        <li>Large Custom Mirror for gold seal application</li>
                        <li>Table Numbers 1-30</li>
                        <li>Leather Domed Trunk with “cards” mirror with stand</li>
                        <li>“Enjoy the Moment- no photography please” mirror with stand</li>
                        <li>“Guestbook” mirror with stand</li>
                        <li>“Take One” small vanity mirror</li>
                     </ul> 
                </div>
              </div>
            </div>
            </div>';
        endForm($options);
    }
}
elseif($setSelected == "Modern Round Wedding Set")
{
    try {
        $result = checkAvailability($setSelected, $date);
    } catch (Exception $e) {
    }
    if($result > 0)
    {
        startPage();
        printDateUnavailable();
    }else{
        headerImage('images/img-mr/mrset.jpg', 'Modern Round');
        startPage();
        startForm();
        $options = array('FULL SET Rental $799', 'PICK 6 Rental $699', 'PICK 4 Rental $599',
            'A’ la Carte Modern Round Welcome Sign Rental $275');
        echo '
            <option value="" disabled selected>Select your option</option>';
        foreach($options as $package){
            echo "<option>$package</option>";
        }
        echo '</select>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    FULL SET Rental $799
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>INCLUDES EACH OF THE FOLLOWING 10 ITEMS</strong> 
                    <ul>
                        <li>Large Custom Welcome (round center becomes a keepsake)</li>
                        <li>Large Magnetic Rectangular (“Find Your Seat”, “Cocktails”, “Let’s Party”, or customize)</li>
                        <li>1-30 free standing table numbers</li>
                        <li>Modern Locking Card Box or Vintage Industrial Typewriter Rental with custom message to guests (up to 100 words)</li>
                        <li>Set of “Reserved” signs (5)</li>
                        <li>2 Selections of Small Square Bracket Signs (“In Loving Memory”, “Gifts & Cards”, “Take One”, and/or customize)</li>
                        <li>2 Selections of Small Horizontal Bracket Signs (“Guestbook”, “Programs”, “Mr. & Mrs”. “Take One”, “Gifts and Cards”,  and/or customize)</li>
                        <li>1 Medium Table Top  (“Unplugged Ceremony”, or Magnetic Sign with “Cocktails” heading,  “In Loving Memory” heading or customize.</li>
                        <li>All Full Set Rental Clients receive 1 SMALL COMPLIMENTARY 3-D CUSTOMIZATION on a small sign in addition to their Round Welcome Sign Keepsake</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    PICK 6 Rental $699
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>CHOOSE 6 OF THE FOLLOWING ITEMS</strong>
                    <ul>
                        <li>Large Custom Welcome (round center becomes a keepsake)</li>
                        <li>Large Magnetic Rectangular (“Find Your Seat”, “Cocktails”, “Let’s Party”, or customize)</li>
                        <li>1-30 free standing table numbers</li>
                        <li>Modern Locking Card Box </li>
                        <li>Vintage Industrial Typewriter Rental with custom message to guests (up to 100 words)</li>
                        <li>Set of “Reserved” signs (5)</li>
                        <li>2 Selections of Small Square Bracket Signs (“In Loving Memory”, “Gifts & Cards”, “Take One”, and/or customize)</li>
                        <li>2 Selections of Small Horizontal Bracket Signs (“Guestbook”, “Programs”, “Mr. & Mrs”. “Take One”, “Gifts and Cards”,  and/or customize)</li>
                        <li>1 Medium Table Top  (“Unplugged Ceremony”, or Magnetic Sign with “Cocktails” heading,  “In Loving Memory” heading or customize.</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    PICK 4 Rental $599
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>4 OF THE FOLLOWING ITEMS</strong>
                    <ul>
                        <li>Large Custom Welcome (round center becomes a keepsake)</li>
                        <li>Large Magnetic Rectangular (“Find Your Seat”, “Cocktails”, “Let’s Party”, or customize)</li>
                        <li>1-30 free standing table numbers</li>
                        <li>Modern Locking Card Box</li>
                        <li>Vintage Industrial Typewriter Rental with custom message to guests (up to 100 words)</li>
                        <li>Set of “Reserved” signs (5)</li>
                        <li>1 Small Square Bracket Signs (“In Loving Memory”, “Gifts & Cards”, “Take One”, and/or customize)</li>
                        <li>1 Small Horizontal Bracket Signs (“Guestbook”, “Programs”, “Mr. & Mrs”. “Take One”, “Gifts and Cards”,  and/or customize)</li>
                        <li>1 Medium Table Top  (“Unplugged Ceremony”, or Magnetic Sign with “Cocktails” heading,  “In Loving Memory” heading or customize.</li>
                     </ul>                
                 </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    A’ la Carte Modern Round Welcome Sign Rental $275
                  </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ul>
                        <li>Includes design fee and round center keepsake. This price does not include delivery. ($500 minimum order for delivery.)</li>
                    </ul> 
                     NOTE:  Welcome Sign Customization is included in all package pricing.  Additional Customization of Magnetic Headings or entire pieces will be subject to added design and supply fees.  
                </div>
              </div>
            </div>
            </div>';
        endForm($options);
    }
}
elseif($setSelected == "Rustic Wood Wedding Set")
{
    try {
        $result = checkAvailability($setSelected, $date);
    } catch (Exception $e) {
    }
    if($result > 1)
    {
        startPage();
        printDateUnavailable();
    }else{
        headerImage('images/rustic_wood_background.jpg', 'Rustic Wood');
        startPage();
        startForm();
        $options = array('Full Package Rental $299', '“No Seating” Rental $245', '“You Pick Four” Rental $199');
        echo '
            <option value="" disabled selected>Select your option</option>';
        foreach($options as $package){
            echo "<option>$package</option>";
        }
        echo '
                <p>Set specific Add-ons</p>
                <input type="checkbox" id="runner" name="runner" value="wood_runner">
                <label for="runner">Aisle runner $99</label><br>
                            
                <input type="checkbox" id="typewriter" name="typewriter" value="wood_type">
                <label for="typewriter">Antique Typewriter $99</label><br>';

        echo '</select>
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Full Package Rental $299
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ul>
                        <li>“Welcome to Our Beginning” (approximately 32” x 18 ”with easel) Your choice of white framed, or rustic stained</li>
                        <li>“Find your Seat” (32.5” x 18.5” framed organizer with 25 clips & easel)</li>
                        <li>Table Numbers (1-25 3.5”x 3.5” with mini easels) (50 pc)</li>
                        <li>Antique Glass Jug with “Honeymoon Fund” (jug & mini- hanger 4.75”x 10”) (2pc)</li>
                        <li>“Mr. & Mrs.” Head Table Blocks (3pc)</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away” (9.75” x 16” framed memorial seat saver)</li>
                        <li>Here Comes Your Bride” ring bearer carrier (9.75 x 15” framed with cord)</li>
                        <li>“Mr. & Mrs.” Chair Hangers (with cord 9.75” x 15”) (2pc)</li>
                        <li>“Guestbook please sign” (self standing 5.5” x 20”)</li>
                        <li>“Just Married” & “Thank You” (Reversible photo-shoot prop 5.5” x 29.5”)</li>
                        <li>"Take One” (5.5” x 6”)</li>
                        <li>“Programs” (15.75” x 5.5”)</li>
                        <li>“In Loving Memory of those who are forever in our hearts” (6”x 5.5” self standing)</li>
                        <li>8 “Reserved” signs (2.75” x 10” 4 with cord hanger option) (8pc)</li>
                        <li>Antique Whitewashed Trunk with “Cards” Banner</li>
                    </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    “No Seating” Rental $245
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ul>
                        <li>“Welcome to Our Beginning” (approximately 32” x 18 ”with easel) Your choice of white framed, or rustic stained</li>
                        <li>Antique Glass Jug with “Honeymoon Fund” (jug & mini- hanger 4.75”x 10”) (2pc)</li>
                        <li>“Mr. & Mrs.” Head Table Blocks (3pc)</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away” (9.75” x 16” framed memorial seat saver)</li>
                        <li>Here Comes Your Bride” ring bearer carrier (9.75 x 15” framed with cord)</li>
                        <li>“Mr. & Mrs.” Chair Hangers (with cord 9.75” x 15”) (2pc)</li>
                        <li>“Guestbook please sign” (self standing 5.5” x 20”)</li>
                        <li>“Just Married” & “Thank You” (Reversible photo-shoot prop 5.5” x 29.5”)</li>
                        <li>"Take One” (5.5” x 6”)</li>
                        <li>“Programs” (15.75” x 5.5”)</li>
                        <li>“In Loving Memory of those who are forever in our hearts” (6”x 5.5” self standing)</li>
                        <li>8 “Reserved” signs (2.75” x 10” 4 with cord hanger option) (8pc)</li>
                        <li>Antique Whitewashed Trunk with “Cards” Banner</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    “You Pick Four” Rental $199
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>SELECT ANY 4 OF THE FOLLOWING</strong>   
                    <ul>
                        <li>“Welcome to Our Beginning” (approximately 32” x 18 ”with easel) Your choice of white framed, or rustic stained</li>
                        <li>“Find your Seat” (32.5” x 18.5” framed organizer with 25 clips & easel)</li>
                        <li>Table Numbers (1-25 3.5”x 3.5” with mini easels) (50 pc)</li>
                        <li>Antique Glass Jug with “Honeymoon Fund” (jug & mini- hanger 4.75”x 10”) (2pc)</li>
                        <li>“Mr. & Mrs.” Head Table Blocks (3pc)</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away” (9.75” x 16” framed memorial seat saver)</li>
                        <li>Here Comes Your Bride” ring bearer carrier (9.75 x 15” framed with cord)</li>
                        <li>“Mr. & Mrs.” Chair Hangers (with cord 9.75” x 15”) (2pc)</li>
                        <li>“Guestbook please sign” (self standing 5.5” x 20”)</li>
                        <li>“Just Married” & “Thank You” (Reversible photo-shoot prop 5.5” x 29.5”)</li>
                        <li>"Take One” (5.5” x 6”)</li>
                        <li>“Programs” (15.75” x 5.5”)</li>
                        <li>“In Loving Memory of those who are forever in our hearts” (6”x 5.5” self standing)</li>
                        <li>8 “Reserved” signs (2.75” x 10” 4 with cord hanger option) (8pc)</li>
                        <li>Antique Whitewashed Trunk with “Cards” Banner</li>
                     </ul>                
                 </div>
                </div>
              </div>
            </div>';

        endForm($options);
    }
}

elseif($setSelected == "Dark Walnut Wedding Set")
{
    try {
        $result = checkAvailability($setSelected, $date);
    } catch (Exception $e) {
    }
    if($result > 1)
    {
        startPage();
        printDateUnavailable();
    }else{
        headerImage('images/Donnie+Rosie+Photo-1086.jpg', 'Dark Walnut');
        startPage();
        startForm();
        $options = array('Full Package Rental $299', '“No Seating” Rental $245', '“You Pick Four” Rental $199');
        echo '
            <option value="" disabled selected>Select your option</option>';
        foreach($options as $package){
            echo "<option>$package</option>";
        }
        echo '</select>
                <p>Set specific Add-ons</p>
                <input type="checkbox" id="runner" name="runner" value="walnut_runner">
                <label for="runner">Aisle runner $99</label><br>

                <input type="checkbox" id="typewriter" name="typewriter" value="walnut_type">
                <label for="typewriter">Antique Typewriter $99</label><br>';

        echo '
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Full Package Rental $299
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ul>
                        <li>“Welcome to Our Beginning” Round (24” diameter, with easel) or Rectangular (35.5” x 21” with easel)</li>
                        <li>“Find your Seat”  (35.5” x 21” organizer with 30 clips & easel)</li>
                        <li>Table Numbers, double-sided (Numbers 1-30, 3.5” x 9”)</li>
                        <li>Antique Jug with “Honeymoon Fund” (jug & mini-hanger, 4.75” x 10”) (2pc)</li>
                        <li>“Mr. & Mrs.” Head Table Sign with small easel 7.25” x 22.5”</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away”  (10” x 10.5” memorial sign or seat saver with small easel)</li>
                        <li>“Here comes the Bride” ring bearer carrier&nbsp; (10.25” x 17.25” with cord)</li>
                        <li>“Better”&nbsp;&amp; “Together” Chair Hangers (with cord 10.25” x 17.25”) (2pc)</li>
                        <li>“Please Sign our Guestbook” (self standing 7.25” x 16”)</li>
                        <li>“Just Married” &amp; “Thank You” (reversible photo-shoot prop 7.25” x 31”)</li>
                        <li>“Take One” (7.25” x 7.25”)</li>
                        <li>“Programs” (7.25” x 16”)</li>
                        <li>“Enjoy the Moment, no photography please” 10.5” x 17” with small easel</li>
                        <li>8 Reserved signs (3.5” x 12”&nbsp; 4 with cord hanger option) (8pc)</li>
                        <li>Antique Leather and Wooden Trunk with “Cards” Banner</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    “No Seating” Rental $245
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <ul>
                        <li>“Welcome to Our Beginning” Round (24” diameter, with easel) or Rectangular (35.5” x 21” with easel)</li>
                        <li>Antique Jug with “Honeymoon Fund” (jug &amp; mini-hanger, 4.75” x 10”) (2pc)</li>
                        <li>“Mr. &amp; Mrs.” Head Table Sign with small easel 7.25” x 22.5”</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away”&nbsp; (10” x 10.5” memorial sign or seat saver with small easel)</li>
                        <li>“Here comes the Bride” ring bearer carrier&nbsp; (10.25” x 17.25” with cord)</li>
                        <li>“Better”&nbsp;&amp; “Together” Chair Hangers (with cord 10.25” x 17.25”) (2pc)</li>
                        <li>“Please Sign our Guestbook” (self standing 7.25” x 16”)</li>
                        <li>“Just Married” &amp; “Thank You” (reversible photo-shoot prop 7.25” x 31”)</li>
                        <li>“Take One” (7.25” x 7.25”)</li>
                        <li>“Programs” (7.25” x 16”)</li>
                        <li>“Enjoy the Moment, no photography please” 10.5” x 17” with small easel</li>
                        <li>8 Reserved signs (3.5” x 12”&nbsp; 4 with cord hanger option) (8pc)</li>
                        <li>Antique Leather and Wooden Trunk with “Cards” Banner</li>
                     </ul>
                  </div>
                </div>
              </div>
              
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    “You Pick Four” Rental $199
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <strong>SELECT ANY 4 OF THE FOLLOWING</strong>
                    <ul>
                        <li>“Welcome to Our Beginning” Round (24” diameter, with easel) or Rectangular (35.5” x 21” with easel)</li>
                        <li>“Find your Seat”&nbsp; (35.5” x 21” organizer with 30&nbsp;clips &amp; easel)&nbsp;</li>
                        <li>Table Numbers, double-sided (Numbers 1-30,&nbsp;3.5” x 9”)</li>
                        <li>Antique Jug with “Honeymoon Fund” (jug &amp; mini-hanger, 4.75” x 10”) (2pc)</li>
                        <li>“Mr. &amp; Mrs.” Head Table Sign with small easel 7.25” x 22.5”</li>
                        <li>“We know that you would be here today if Heaven weren’t so far away”&nbsp; (10” x 10.5” memorial sign or seat saver with small easel)</li>
                        <li>“Here comes the Bride” ring bearer carrier&nbsp; (10.25” x 17.25” with cord)</li>
                        <li>“Better”&nbsp;&amp; “Together” Chair Hangers (with cord 10.25” x 17.25”) (2pc)</li>
                        <li>“Please Sign our Guestbook” (self standing 7.25” x 16”)</li>
                        <li>“Just Married” &amp; “Thank You” (reversible photo-shoot prop 7.25” x 31”)</li>
                        <li>“Take One” (7.25” x 7.25”)</li>
                        <li>“Programs” (7.25” x 16”)</li>
                        <li>“Enjoy the Moment, no photography please” 10.5” x 17” with small easel</li>
                        <li>8 Reserved signs (3.5” x 12”&nbsp; 4 with cord hanger option) (8pc)</li>
                        <li>Antique Leather and Wooden Trunk with “Cards” Banner</li>
                     </ul>                
                 </div>
                </div>
              </div>
            </div>';

        endForm($options);
    }
}


function checkAvailability ($set, $reservationDate){
    require '/home/purplegr/wrwreservationdb.php';
    $startDate = new DateTime($reservationDate);
    $endDate = new DateTime($reservationDate);
    date_modify($startDate, '-2 days');
    date_modify($endDate, '+2 days');
    $sql = "SELECT * FROM res_info WHERE `sign_set` = '".$set."' and wed_date BETWEEN '".$startDate->format('Y-m-d')."' AND '".$endDate->format('Y-m-d')."'";

    $result = @mysqli_query($cnxn, $sql);
    $num_rows = mysqli_num_rows($result);
    return $num_rows;
}

function printDateUnavailable() {
    echo '<div class="row">
                <div class="col-3"></div>
                <div class="col-6"
                    <h4>This style not available on your date</h4>
                    <a href="form.php" type="submit" class="btn btn-primary">Start over</a>
                </div>
                <div class="col-3"></div>
             </div>';
}

function startPage() {
    echo '
            <div class="row">
                <div class="col-12 text-center">
                    <img src="images/walnutridgebg.png">
                </div>
            </div>';
}

function startForm() {
    echo '
        <form name="availabilityForm" action="extras.php" method="GET">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="select">Which package will you be choosing?</label>
                        <select class="form-control" id="select" name="packageSelected" required>';
}

function endForm($options) {
    $setSelected = $_GET['setSelected'];
    $weddingDate = $_GET['weddingDate'];
    $optionsString = serialize($options);
    echo '
                    </div>
                    <input type = "hidden" name = "set" value = "'.$setSelected.'">
                    <input type = "hidden" name = "date" value = "'.$weddingDate.'">
                    <input type = "hidden" name = "options" value = "'.htmlentities($optionsString).'">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-3"></div>
            </div>
        </form>';
}


function headerImage($imagepath, $setSelected) {
    echo'<style>
.title h1{
    margin-top: 115px;
    font-size: 130px;
    font-family: "Passions Conflict", cursive;
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
                        <a href="https://purple.greenriverdev.com/walnutridgewedding/Sprint5/walnutridge.html" target="_blank" class="navigation">Home</a>
                    </div>
                </div>
            <div class="title">
                <h1 style="color : white; text-shadow: 2px 2px 5px black;">'.$setSelected.'</h1>
            </div>
        </div>
    </div>';
}

echo '</div>';

echo '
<div id="progress">
    <div class="progress col-6 mx-auto" id="progressBar">
        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>
</div>';

?>
</body>
</html>
