<?php
// page1.php

session_start();

echo 'Welcome to page #1';
$parameter= $_GET['parameter'];

$_SESSION['favcolor'] = $parameter;
$_SESSION['animal']   = 'cat';
$_SESSION['time']     = time();

// Works if session cookie was accepted
echo '<br /><a href="demo2.php">page 2</a>';

// Or pass along the session id, if needed
echo '<br /><a href="demo2.php?' . SID . '">page 2</a>';
?>