<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$toernooi = $obj->SelectSpecificToernooi($_GET['id']);


if(isset($_POST['submit'])){  
  $fieldnames = ['omschrijving', 'datum'];

  $error = false;

  // loop through fieldnames and check if they are empty
  foreach ($fieldnames as $data) {
      if(empty($_POST[$data])){
          $error = true;
      }    
  }

 if (!$error) {
     $obj->updateToernooi($_POST['omschrijving'], $_POST['datum'], $_GET['id']);
 }else{
      echo 'Fieldnames required';
 }
}
//hier boven zijn functies om een toernooi te wijzigen
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
    
      <h2>Wijzig <?php echo $toernooi['omschrijving']; ?></h2> <br>
      <form  style="text-align:center" method="post">
    <label for="naam">naam</label>
    <input id="oms" type="text" name="omschrijving" value="<?php echo $toernooi['omschrijving']; ?>"> <br>
    <label for="datum">datum</label>
    <input type="date" name="datum" value="<?php echo $toernooi['datum']; ?>"> <br>
    <input type="submit" value="submit" name="submit">
</form>
<a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>
    
</body>
</html>
