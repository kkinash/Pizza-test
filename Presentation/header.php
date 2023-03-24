<?php
//Presentation/header.php
declare(strict_types=1);
session_start();

// $_SESSION['actual_link'] = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// print($_SESSION['actual_link']);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Design/css/pico.css">
    <title>Pizza!</title>
</head>
<table>
    <?php
    /* DEBUG VARIABLES
    foreach ($_SESSION as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
    }
    ?>
    </table>
    <table>
    <?php
    foreach ($_POST as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
    }
    ?>
    </table>
    */