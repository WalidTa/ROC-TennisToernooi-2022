<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$user = $obj->SelectSpecificSpeler($_GET['id']);
$scholen = $obj->showSchool();


if(isset($_POST['submit'])){  
  $fieldnames = ['voornaam', 'achternaam', 'scholen'];

  $error = false;

  // loop through fieldnames and check if they are empty
  foreach ($fieldnames as $data) {
      if(empty($_POST[$data])){
          $error = true;
      }    
  }

 if (!$error) {
     $obj->updateSpeler($_POST['voornaam'], $_POST['tussenvoegsel'], $_POST['achternaam'], $_POST['scholen'], $_GET['id']);
 }else{
      echo 'Fieldnames required';
 }
}
//hier boven zijn functies om een speler te wijzigen
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
    
      <form style="text-align:center" method="post">
      <div>
    <label for="voornaam"><h3>Voornaam</h3></label>
    <input type="text" name="voornaam" value="<?php echo $user['voornaam']; ?>">
    </div>
    <div>
    <label for="tussenvoegsel"><h3>Tussenvoegsel</h3></label>
    <input type="text" name="tussenvoegsel" value="<?php echo $user['tussenvoegsel']; ?>">
    </div>
    <div>
    <label for="achternaam"><h3>Achternaam</h3></label>
    <input type="text" name="achternaam" value="<?php echo $user['achternaam']; ?>">
    </div>
    <div>
    <label for="naam"><h3>School</h3></label>
    <select name="scholen">
        <?php foreach ($scholen as $school): ?>
            <option value="<?php echo $school['schoolID'];?>"><?php echo $school['naam'];?></option>
        <?php endforeach; ?>               
    </select>   
    </div>
    <input type="submit" value="submit" name="submit">
</form>
<a href="javascript:history.go(-1)">
        <button>TERUG</button>
       </a>
    
</body>
</html>
