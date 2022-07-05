<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->showAanmelding($_GET['id']);
// deze functies is er om de goeie aanmeldigen te laten zien
$beheer = $obj->SelectSpecificToernooi($_GET['id']);
// deze functie is er om 1: bij het createn de toernooi id mee te nemen 
// en 2: om op de pagina de naam van het toernooi te printen 

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
      <h2> De aanmeldingen van <?php echo $beheer['omschrijving']; ?></h2>
      <h3 style="text-align:left;"> DE AANMELDINGEN SLUITEN OP <?php echo $beheer ['datum']; ?></h3>
      <br>
      <table class="table table-striped" id="overzicht">
           <thead class="thead">
               <tr>
                   <th scope="col">aanmeldingsID</th>
                   <th scope="col">speler</th>
                   <th scope="col">school</th>
                   <th scope="col">datum van toernooi</th>
                   <th scope="col">Update</th>
                   <th scope="col">Delete</th>
               </tr>
           </thead>
           <tbody></tbody>
               <?php foreach ($users as $user): ?>
               <tr>
                   <td><?php echo $user['aanmeldingID'];?></td>
                   <td><?php echo $user['voornaam']." ".$user['tussenvoegsel']." ".$user['achternaam'];?></td>
                   <td><?php echo $user['naam'];?></td>
                   <td><?php echo $user['datum'];?></td>
                   <td class="Edit">
                       <a class="btn btn-primary mr-2 btn-sm" href="editAanmelding.php?id=<?php echo $user['aanmeldingID']; ?>">Update</a>
                   </td>      
                   <td class="Delete">
                       <a class="btn btn-danger mr-2 btn-sm" href="deleteAanmelding.php?id=<?php echo $user['aanmeldingID']; ?>">Delete</a>
                   </td> 
               </tr>

               <?php endforeach; ?>               
                    <td class="Create">
                        <a class="btn btn-success mr-2 btn-sm" href="createAanmelding.php?id=<?php echo $beheer['toernooiID']; ?>">Create</a>
                    </td>
           </tbody>
       </table>

       <a href="toernooi.php">
        <button>TERUG</button>
       </a>

   </main>
</body>
</html>