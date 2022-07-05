<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$spelers = $obj->showSpecificSpelers($_GET['id']);
$toernooi = $obj->SelectSpecificToernooi($_GET['id']);


if(isset($_POST['submit'])){  
    $fieldnames = [ 'ronde', 'speler1', 'speler2', 'score1', 'score2', 'winnaar'];

    $error = false;

    // loop through fieldnames and check if they are empty
    foreach ($fieldnames as $data) {
        if(empty($_POST[$data])){
            $error = true;
        }    
    }
    
    if(!$error){
        $obj->createWedstrijd($_GET['id'], $_POST['ronde'], $_POST['speler1'], $_POST['speler2'], $_POST['score1'], $_POST['score2'], $_POST['winnaar']);
    } else {
        echo 'Fieldnames required';
    }
}
//hier boven zijn functies om een wedstrijd te maken, de functie op regel 8 helpt hier ook mee
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
        </div><br>
</nav>
      <form  style="text-align:center" method="post">
        <div> <h3>Selecteer de aangemelde speler</h3>
            <label>speler1</label>
            <select id="spelerif" name="speler1">
                <option disabled selected >Selecteer Speler 1</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        <div>
            <label>speler2</label>
            <select name="speler2">
                <option  disabled selected > Selecteer Speler 2</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        <div>
            <label for="ronde">score1</label>
            <input type="number" name="score1" >  
        </div>
        <div>
            <label for="ronde">score2
            <input type="number" name="score2" >  
            </label>
        </div>
        <div>
            <label for="ronde">ronde</label>
            <input type="number" name="ronde" >  
        </div>
        <div>
            <label>winnaar</label>
            <select name="winnaar">
                <option disabled selected >Selecteer De winnaar</option>
                <?php foreach ($spelers as $speler): ?>
                    <option value="<?php echo $speler['spelerID'];?>"><?php echo $speler['voornaam']." ".$speler['tussenvoegsel']." ".$speler['achternaam'] ;?></option>
                <?php endforeach; ?>              
            </select>   
        </div>
        </div>
        <h2 style="text-align: center;"> De wedstrijd wordt in <?php echo $toernooi['omschrijving'];?> gemaakt</h2>
        <div style="text-align: center">
            <input type="submit" value="bevestigen" name="submit">
        </div>
</form>
<a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>
</body>
</html>
