<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->showSpelers();
//simpele functies om de spelers te selecteren
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
      <h2> Spelers </h2>
       <table class="table table-striped" id="overzicht">
           <thead class="thead">
               <tr>
                   <th scope="col">ID</th>
                   <th scope="col">Voornaam</th>
                   <th scope="col">Tussenvoegsel</th>
                   <th scope="col">Achternaam</th>
                   <th scope="col">School</th>
                   <th scope="col">Update</th>
                   <th scope="col">Delete</th>
               </tr>
           </thead>
           <tbody></tbody>
               <?php foreach ($users as $user): ?>
               <tr>
                   <td><?php echo $user['spelerID'];?></td>
                   <td><?php echo $user['voornaam'];?></td>
                   <td><?php echo $user['tussenvoegsel'];?></td>
                   <td><?php echo $user['achternaam'];?></td>
                   <td><?php echo $user['schoolnaam'];?></td>
                   <td class="Edit">
                       <a class="btn btn-primary mr-2 btn-sm" href="editSpelers.php?id=<?php echo $user['spelerID']; ?>">Update</a>
                   </td>      
                   <td class="Delete">
                       <a class="btn btn-danger mr-2 btn-sm" href="deleteSpeler.php?id=<?php echo $user['spelerID']; ?>">Delete</a>
                   </td> 
               </tr>

               <?php endforeach; ?>               
                    <td class="Create">
                        <a class="btn btn-success mr-2 btn-sm" href="createSpeler.php?id=">Create</a>
                    </td>   

           </tbody>
       </table>
         

   </main>
</body>
</html>