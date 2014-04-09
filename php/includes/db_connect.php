<?php
include_once 'psl-config.php';   // As functions.php is not included
$mysqli = new oci_connect(HOST, USER, PASSWORD, DATABASE);
?>
