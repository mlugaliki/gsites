<?php
session_start();
if (!isset($_SESSION['phone'])|| !isset($_SESSION['name']) || !isset($_SESSION['service'])) {
    session_unset();
    //die("Hehehe ".isset($_SESSION['phone']));
    header('Refresh: 1; url=../index.html');
}