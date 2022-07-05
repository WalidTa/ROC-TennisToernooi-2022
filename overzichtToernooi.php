<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->showOverzichtToernooi($_GET['id']);
$users2 = $obj->showOverzichtToernooi2($_GET['id']);
$users3 = $obj->showOverzichtToernooi3($_GET['id']);

$toernooi = $obj->SelectSpecificToernooi($_GET['id']);
// hier boven zijn functies om de juiste wedstrijden te selecteren, 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
  * {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
/* een style voor deze tabels specifiek */
</style>
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
      <div>
        <h3>toernooi overzicht</h3> <h3 style="text-align:right; margin-right:60px;"><?php echo $toernooi['datum']." --- ".$toernooi['omschrijving']; ?></h3>
    </div>
    <div class="row">
  <div class="column">
    <h2>ronde 1</h2>
    <table id="overzicht-ronde1">
           <thead class="thead">
               <tr>
                   <th scope="col">spelers</th>
                   <th scope="col">score</th>
                   <th scope="col">ronde</th>
               </tr>
           </thead>
      </div> <?php foreach ($users as $user): ?>
      <div class="column">
           <tbody></tbody>   
               <tr> <!-- hier onder zijn de if statements die ik heb gebruikt voor de naam highlights, dit volgt nog twee keer -->
               <td 
              
               <?php if( $user['score1'] > $user['score2'] ) { 
                echo '<span style="color:#FFD700;">'; 
                echo $user['speler1'];} echo'<br>'; 
                if( $user['score2'] > $user['score1'] ) {
                  echo $user['speler1']; 
                  echo '<span style="color:#FFD700;"> <br>'; 
                  echo $user['winnaar'];} else { 
                    echo '<span style="color:black;">';  
                    echo  $user['speler2']; }?></td>

                   <td><?php echo $user['score1']." <br> ".$user['score2'];?></td>
                   <td><?php echo $user['ronde'];?></td>
               </tr>
               <?php endforeach; ?> 

           </tbody>
        </table>
        </div>
        <div class="column">
    <h2>ronde 2 en meer</h2>
    <table id="overzicht-ronde2">
           <thead class="thead">
               <tr>
                   <th scope="col">spelers</th>
                   <th scope="col">score</th>
                   <th scope="col">ronde</th>
               </tr>
           </thead>
      </div> <?php foreach ($users2 as $user): ?>
      <div class="column">
           <tbody></tbody> 
               <tr>
               <td 
               
               <?php if( $user['score1'] > $user['score2'] ) { 
                echo '<span style="color:#FFD700;">'; 
                echo $user['speler1'];} echo'<br>'; 
                if( $user['score2'] > $user['score1'] ) {
                  echo $user['speler1']; 
                  echo '<span style="color:#FFD700;"> <br>'; 
                  echo $user['winnaar'];} else { 
                    echo '<span style="color:black;">';  
                    echo $user['speler2']; }?></td>

                   <td><?php echo $user['score1']." <br> ".$user['score2'];?></td>
                   <td><?php echo $user['ronde'];?></td>
               </tr>
               <?php endforeach; ?> 

           </tbody>
        </table>
        </div>
        <div class="column">
        <h2>finale</h2>
        <table id="overzicht-ronde1">
           <thead class="thead">
               <tr>
                   <th scope="col">spelers</th>
                   <th scope="col">score</th>
                   <th scope="col">ronde</th>
               </tr>
           </thead>
      </div> <?php foreach ($users3 as $user): ?>
      <div class="column">
           <tbody></tbody> 
               <tr>
                   <td 
                   
                   <?php if( $user['score1'] > $user['score2'] ) { 
                    echo '<span style="color:#FFD700;">'; 
                    echo $user['speler1'];} 
                    echo'<br>'; if( $user['score2'] > $user['score1'] ) {
                      echo $user['speler1']; 
                      echo '<span style="color:#FFD700;"> <br>'; 
                      echo $user['winnaar'];} else {
                        echo '<span style="color:black;">';  
                        echo  $user['speler2']; }?></td>

                   <td><?php echo $user['score1']." <br> ".$user['score2'];?></td>
                   <td><?php echo $user['ronde'];?></td>
               </tr>
               <div><h5>De winnaar van het toernooi is: <?php echo $user['winnaar'];?> !!! </h5></div>
               <?php endforeach; ?> 
           </tbody>
        </table>
        </div>
</div>
<a href="toernooi.php">
        <button>TERUG</button>
       </a>
   </main>
</body>
</html>