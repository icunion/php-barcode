<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of barcode
 *
 * @author dja101
 */
class barcode {
    
    private $barcode = null;
    
    public function __construct($type, $text)
    {
        switch (strtolower($type))
        {
            case 'code128':
            case 'code128b':
                require_once('code128.php');
                $this->barcode = new code128($text);
                break;
            case 'ean13':
                require_once('ean13.php');
                $this->barcode = new ean13($text);
                break;
            default:
                throw new Exception("Unspported barcode type " . $type);
                break;
        }
    }
    
    public function render($bar_width = 1, $bar_height = 50, $show_text = true)
    {
        // Create image, allocate colours and fill white
        $img_width = (strlen($this->barcode->bars) * $bar_width) + 20;
        $img_height = $bar_height + 20 + (($show_text) ? 10 : 0);
        $image = imagecreate($img_width, $img_height);
        $black = imagecolorallocate($image, 0, 0, 0);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $white);

        // Set start position to 10 and draw bars
        $x = 10;
        for ($i=0; $i<strlen($this->barcode->bars); $i++)
        {
            $heightAdj = (($show_text) ? 10 : 0) + 10 + ((method_exists($this->barcode, 'elongateBar') && $this->barcode->elongateBar($i)) ? -5 : 0);
            if (substr($this->barcode->bars, $i, 1) == '1')
            {
                imageline($image, $x, 10, $x, $img_height - $heightAdj, $black);
            }
            $x += $bar_width;
        }

        // Place text representation under barcode when show_text is true
        if ($show_text)
        {
            $text_width = imagefontwidth(4) * strlen($this->barcode->text);
            imagestring($image, 4, ($img_width - $text_width) / 2, $img_height - 17, $this->barcode->text, $black);
        }
        
        // Start output buffering and output image
        ob_start();
        imagepng($image);
        
        // Get contents of output buffer and clear it
        $imagefile = ob_get_contents();
        ob_end_clean();
        
        // Destroy the temporary image and return the imagefile contents
        imagedestroy($image);
        return $imagefile;
    }
    
    public function output($bar_width = 1, $bar_height = 50, $show_text = true)
    {
        header ('Content-type: image/png');
        echo $this->render($bar_width, $bar_height, $show_text);
    }
}
