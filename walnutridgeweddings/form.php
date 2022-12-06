<?php
session_start();
$_SESSION['progress'] = 'one';

$currentDate = date("Y-m-d");

echo '
<head>
    <meta charset="UTF-8">
    <title>Availability Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="formstyles.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link href="robots.txt">
    <meta name="robots" content="noindex, nofollow">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12 text-center">
            <img src="images/walnutridgebg.png" alt="Walnut Ridge Logo">
        </div>
    </div>
    <form name="availabilityForm" action="packages.php" method="GET">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <div class="form-group">
                    <label for="date">Wedding Date</label>
                    <input type="date" class="form-control" id="date" name="weddingDate" required min="'.$currentDate.'">
                </div>
                <div class="form-group mx-auto">
                    <label for="select">Which Rental option are you most interested in?</label>
                        <div class="container text-center">
                          <div class="row h-50">
                            <div class="col">
                              <a href=""><button style="object-fit: cover; width: 60%; height: 100%; text-shadow: 1px 1px 2px black;" name="setSelected" value="Layered Arch Wedding Set" id="btn" class="btn btn form-buttons">Layered Arch Wedding Set</button></a>
                            </div>
                          </div>
                          
                          <div class="row h-50">
                            <div class="col">
                              <a href=""><button style="object-fit: cover; width: 60%; height: 100%; text-shadow: 1px 1px 2px black;" name="setSelected" value="Vintage Mirror Wedding Set" id="btn2" class="btn btn form-buttons">Vintage Mirror Wedding Set</button></a>
                            </div>
                          </div>
                          
                          <div class="row h-50">
                            <div class="col">
                              <a href=""><button style="object-fit: cover; width: 60%; height: 100%; text-shadow: 1px 1px 2px black;;" name="setSelected" value="Modern Round Wedding Set" id="btn3" class="btn btn form-buttons">Modern Round Wedding Set</button></a>
                            </div>
                          </div>
                          
                          <div class="row h-50">
                            <div class="col">
                              <a href=""><button style="object-fit: cover; width: 60%; height: 100%; text-shadow: 1px 1px 2px black;" name="setSelected" value="Rustic Wood Wedding Set" id="btn4" class="btn btn form-buttons">Rustic Wood Wedding Set</button></a>
                            </div>
                          </div>
                          
                          <div class="row h-50">
                            <div class="col">
                              <a href=""><button style="object-fit: contain; width: 60%; height: 100%; text-shadow: 1px 1px 2px black;" name="setSelected" value="Dark Walnut Wedding Set" id="btn5" class="btn btn form-buttons">Dark Walnut Wedding Set</button></a>
                            </div>
                          </div>
                        </div> 
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </form>
</div>
</body>';
