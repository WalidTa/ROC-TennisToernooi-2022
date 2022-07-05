<?php
include_once 'database.php';
//hier boven wordt de connectie gemaakt naar database.php 

$obj = new database();

$users = $obj->deleteAanmelding($_GET['id']);

?>