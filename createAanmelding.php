<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$spelers = $obj->showSpelers();

$toernooi = $obj->SelectSpecificToernooi($_GET['id']);

if(isset($_POST['submit'])){  
    $fieldnames = ['speler_ID'];

    $error = false;

    // loop through fieldnames and check if they are empty
    foreach ($fieldnames as $data) {
        if(empty($_POST[$data])){
            $error = true;
        }    
    }
    
    if(!$error){
        $obj->createAanmelding($_GET['id'], $_POST['speler_ID']);
    } else {
        echo 'Fieldnames required';
    }
}
// hier boven is een functie om een aanmelding aan te maken de functie op regel 9 helpt hier ook mee
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>
<body>
<main>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-item nav-link active" href="index.html">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="spelers.php">spelers</a>
            <a class="nav-item nav-link" href="school.php">scholen</a>
            <a class="nav-item nav-link" href="toernooi.php">toernooien</a>
          </div>
        </div>
</nav>
<form style="text-align:center" method="post">
        <div style="text-align: center;">
            <h2><label>Speler Naam</label></h2>
            <select name="speler_ID">
            <option disabled selected >Selecteer een Speler </option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div><br>
        <h2 style="text-align: center;"> De aanmelding wordt in <?php echo $toernooi['omschrijving'];?> gemaakt</h2>
        <div style="text-align: center">
            <input type="submit" value="bevestigen" name="submit">
        </div>
    </form>

    <a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>

</body>
</html>