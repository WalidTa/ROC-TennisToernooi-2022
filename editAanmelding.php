<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$user = $obj->SelectSpecificAanmelding($_GET['id']);

$spelers = $obj->showSpelers();
$toernooien = $obj->showToernooi();

if(isset($_POST['submit'])){  
    $fieldnames = ['speler_ID', 'toernooi_ID'];

    $error = false;

    // loop through fieldnames and check if they are empty
    foreach ($fieldnames as $data) {
        if(empty($_POST[$data])){
            $error = true;
        }    
    }
    
    if(!$error){
        $obj->updateAanmelding($_POST['speler_ID'], $_POST['toernooi_ID'], $_GET['id']);
    } else {
        echo 'Fieldnames required';
    }
}
//hier boven zijn functies om een aanmelding te wijzigen 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>toernooi</title>
</head>
<body>
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
      <br><br>
    <form style="text-align:center;"class="edit" method="post">
        <div>
            <div>
            <label><h3>Speler</h3></label>
           
            <select name="speler_ID">
                <option value="<?php echo $user['speler_ID']; ?>"><?php echo $user['voornaam']." ".$user['tussenvoegsel']." ".$user['achternaam'] ;?></option>
                <option>----</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
         </div>
        </div>
        <div>
            <label><h3>Toernooi</h3></label>
            <select name="toernooi_ID">
                <option value="<?php echo $user['toernooi_ID']; ?>"><?php echo $user['omschrijving']." ".$user['datum'] ;?></option>
                <option>----</option>
                <?php foreach ($toernooien as $toernooi): ?>
                    <option value="<?php echo $toernooi['toernooiID'];?>"><?php echo $toernooi['omschrijving']. " ".$toernooi['datum'] ;?></option>
                <?php endforeach; ?>               
            </select>   
        </div>
        <div>
            <input type="submit" value="submit" name="submit">
        </div> <br> <br>
    </form>
    <a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>

</body>
</html>