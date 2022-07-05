<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->deleteWedstrijd($_GET['id']);

?>