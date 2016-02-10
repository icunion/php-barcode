php-barcode
===========

A basic PHP barcode generator. Supports barcodes of types:

* Code-128
* EAN-13

## Output file to browser

```
<?php
require_once('barcode.php');
$barcode = new barcode('code128', 'ABCD1234');
$barcode->output();
```

## Output file contents to string

```
<?php
require_once('barcode.php');
$barcode = new barcode('code128', 'ABCD1234');
$imagefile = $barcode->render();
```

## Parameters

* 'bar_width' : The width in pixels of each bar (Default = 1)
* 'bar_height' : The height of each bar (Default = 50)
* 'show_text' : Whether or not to show the text representation below the barcode (Default = true)
 
