php-barcode
===========

A basic PHP barcode generator. Supports barcodes of types:

* Code-128
* EAN-13

## Usage

To output the file straight to the browser

```
<?php
require_once('barcode.php');
$barcode = new barcode('code128', 'ABCD1234');
$barcode->output();
...


```
<?php
require_once('barcode.php');
$barcode = new barcode('code128', 'ABCD1234');
$imagefile = $barcode->render();
...