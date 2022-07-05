<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->showToernooi();

$currentdate = date("Y-m-d");
//een simpele functie om de toernooien te selecteren
// ik define $currentdate ook die ik gebruik om de aanmeldingen te sluiten
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
      </nav><br>
      <h2>Overzicht van de toernooien <br> beheer de wedstrijden en de aanmeldingen bij het bij behorende toernooi</h2><br>
       <table class="table table-dark" id="overzicht">
           <thead class="thead-warning">
               <tr> 
                <!-- hier volgt de table waar je de meeste dingen kan en moet doen. hier vind je het beheer van de aanmeldingen en de wedstrijden 
                ook kan je de uitslag zien van een gesloten toernooi, wanneer het toernooi is geweest wordt de aanmelding automatisch gesloten
                en kan je de uitslag bekijken. als het toernooi nog niet is geweest kan iedereen zich nog aanmelden, 
                maar kan je nog niet de uitslag bekijken. -->
               <th scope="col">toernooiID</th>
                   <th scope="col">omschrijving</th>
                   <th scope="col">datum</th>
                   <th scope="col">uitslag</th>
                   <th scope="col">wedstrijden</th>
                   <th scope="col">aanmeldingen</th>
                   <th scope="col">Update</th>
                   <th scope="col">Delete</th>
               </tr>
           </thead>
           <tbody></tbody>
               <?php foreach ($users as $user): ?>
               <tr>
                   <td><?php echo $user['toernooiID'];?></td>
                   <td><?php echo $user['omschrijving'];?></td>
                   <td><?php echo $user['datum'];?></td>
                   <td class="overzicht">
                       <a class="btn btn-success mr-2 btn-sm <?php if($user['datum'] >= $currentdate) { echo 'disabled';} ?> " href="overzichtToernooi.php?id=<?php echo $user['toernooiID']; ?>">De uitslag </a>
                   </td>    
                   <td class="beheren"> <!-- de onderstaande if statement kijkt of het toernooi is gesloten, als het toernooi een dag eerder wat het nu is kan je niet meer aanmelden en wedstrijden beheren -->
                       <a class="btn btn-warning mr-2 btn-sm" href="wedstrijd.php?id=<?php echo $user['toernooiID']; ?>">Wedstrijden</a>
                   </td> 
                   <td class="overzichtA">
                       <a class="btn btn-primary mr-2 btn-sm <?php if($user['datum'] < $currentdate) { echo 'disabled';} ?>" href="aanmelden.php?id=<?php echo $user['toernooiID']; ?>"> Aanmeldingen</a>
                   </td>    
                   <td class="Edit">
                       <a class="btn btn-primary mr-2 btn-sm" href="editToernooi.php?id=<?php echo $user['toernooiID']; ?>">Update</a>
                   </td>      
                   <td class="Delete">
                       <a class="btn btn-danger mr-2 btn-sm" href="deleteToernooi.php?id=<?php echo $user['toernooiID']; ?>">Delete</a>
                   </td> 
               </tr>

               <?php endforeach; ?>               
                    <td class="Create">
                        <a class="btn btn-success mr-2 btn-sm" href="createToernooi.php?id=">Create</a>
                    </td>
                    
           </tbody>
       </table>
       <p>de aanmelding word vanzelf gesloten wanneer het toernooi voorbij is, als je de aanmeldingen eerder wil sluiten moet je de datum van het toernooi wijzigen </p>
    
</body>
</html>
