<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();
$user = $obj->SelectSpecificWedstrijd($_GET['id']);

$spelers = $obj->showSpelers();
$toernooien = $obj->showToernooi();

if(isset($_POST['submit'])){  
    $obj->updateWedstrijd($_GET['id'], $_POST['toernooi_ID'], $_POST['ronde'], $_POST['speler1ID'], $_POST['speler2ID'], $_POST['score1'], $_POST['score2'], $_POST['winnaarID']);
 
}
// hier boven zijn functies om een wedstrijd te wijzigen
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>edit wedstrijd</title>
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
    

      <form  style="text-align:center" method="post">
      <div>
            <label><h3>speler 1</h3></label>
            <select name="speler1ID">
                <option value="<?php echo $user[0]['speler1ID']; ?>"><?php echo $user[0]['speler1'];?></option>
                <option>----</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        <div>
            <label><h3>speler 2</h3></label>
            <select name="speler2ID">
                <option value="<?php echo $user[0]['speler2ID']; ?>"><?php echo $user[0]['speler2'];?></option>
                <option>----</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        <div>
            <label><h3>winnaar</h3></label>
            <select name="winnaarID">
                <option value="<?php echo $user[0]['winnaarID']; ?>"><?php echo $user[0]['winnaar'];?></option>
                <option>----</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        <div>
            <label><h3>toernooi</h3></label>
            <select name="toernooi_ID">
                <option value="<?php echo $user[0]['toernooi_ID']; ?>"><?php echo $user[0]['omschrijving']." ".$user[0]['datum'] ;?></option>
                <option>----</option>
                <?php foreach ($toernooien as $toernooi): ?>
                    <option value="<?php echo $toernooi['toernooiID'];?>"><?php echo $toernooi['omschrijving']. " ".$toernooi['datum'] ;?></option>
                <?php endforeach; ?>               
            </select>   
        </div>
        <label for="ronde"><h3>ronde</h3></label>
        <input type="number" name="ronde" value="<?php echo $user[0]['ronde']; ?>"> <br>
        <label for="score1"><h3>score 1</h3></label>
        <input type="number" name="score1" value="<?php echo $user[0]['score1']; ?>"><br>
        <label for="score2"><h3>score 2</h3></label>
        <input type="number" name="score2" value="<?php echo $user[0]['score2']; ?>"><br>
        <div>
            <input type="submit" value="submit" name="submit">
        </div>
</form>
<a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>
</body>
</html>
