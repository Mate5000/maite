<?php

@include 'config.php';
sleep(1.5);
session_start();
session_unset();
session_destroy();

header('location:../index.php');

?>