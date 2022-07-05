<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->showWedstrijd($_GET['id']);
$beheer = $obj->SelectSpecificToernooi($_GET['id']);
// functies om de juiste wedstrijden en het toernooi te selecteren
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
      <br>
      
      <h2> Beheer wedstrijden van <?php echo $beheer['omschrijving'];?></h2>
      <table class="table table-striped" id="overzicht">
           <thead class="thead">
               <tr>
                   <th scope="col">wedstrijd ID</th>
                   <th scope="col">ronde</th>
                   <th scope="col">speler1</th>
                   <th scope="col">speler2</th>
                   <th scope="col">score1</th>
                   <th scope="col">score2</th>
                   <th scope="col">winnaar</th>
                   <th scope="col">Update</th>
                   <th scope="col">Delete</th>
               </tr>
           </thead>
           <tbody></tbody>
               <?php foreach ($users as $user): ?>
               <tr>
                   <td><?php echo $user['wedstrijdID'];?></td>
                   <td><?php echo $user['ronde'];?></td>
                   <td><?php echo $user['speler1'];?></td>
                   <td><?php echo $user['speler2'];?></td>
                   <td><?php echo $user['score1'];?></td>
                   <td><?php echo $user['score2'];?></td>
                   <td><?php echo $user['winnaar'];?></td>

                   <td class="Edit">
                       <a class="btn btn-primary mr-2 btn-sm" href="editWedstrijd.php?id=<?php echo $user['wedstrijdID']; ?>">Update</a>
                   </td>      
                   <td class="Delete">
                       <a class="btn btn-danger mr-2 btn-sm" href="deleteWedstrijd.php?id=<?php echo $user['wedstrijdID']; ?>">Delete</a>
                   </td> 
               </tr>

               <?php endforeach; ?>               
                    <td class="table-warning">
                        <a class="btn btn-success mr-2 btn-sm" href="createWedstrijd.php?id=<?php echo $beheer['toernooiID']; ?>">Create</a>
                    </td>
           </tbody>
       </table>
       <a href="toernooi.php">
        <button>TERUG</button>
       </a>

   </main>
</body>
</html>