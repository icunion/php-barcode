<?php
// Test file

require_once('barcode.php');
$barcode = new barcode('code128', 'ABCD1234');
$barcode->output();

