<?php

class ean13 {
    public $bars = '';
    public $text = '';
    
    public function __construct($text)
    {
        $this->text = $text;
        $this->bars = $this->encode();
    }
    
    private $groups = [
        '0' => 'LLLLLLRRRRRR',
        '1' => 'LLGLGGRRRRRR',
        '2' => 'LLGGLGRRRRRR',
        '3' => 'LLGGGLRRRRRR',
        '4' => 'LGLLGGRRRRRR',
        '5' => 'LGGLLGRRRRRR',
        '6' => 'LGGGLLRRRRRR',
        '7' => 'LGLGLGRRRRRR',
        '8' => 'LGLGGLRRRRRR',
        '9' => 'LGGLGLRRRRRR',
    ];
    
    private $code = [
        '0' => ['L' => '0001101', 'G' => '0100111', 'R' => '1110010'],
        '1' => ['L' => '0011001', 'G' => '0110011', 'R' => '1100110'],
        '2' => ['L' => '0010011', 'G' => '0011011', 'R' => '1101100'],
        '3' => ['L' => '0111101', 'G' => '0100001', 'R' => '1000010'],
        '4' => ['L' => '0100011', 'G' => '0011101', 'R' => '1011100'],
        '5' => ['L' => '0110001', 'G' => '0111001', 'R' => '1001110'],
        '6' => ['L' => '0101111', 'G' => '0000101', 'R' => '1010000'],
        '7' => ['L' => '0111011', 'G' => '0010001', 'R' => '1000100'],
        '8' => ['L' => '0110111', 'G' => '0001001', 'R' => '1001000'],
        '9' => ['L' => '0001011', 'G' => '0010111', 'R' => '1110100'],
    ];
    
    private function encode()
    {
        // Check input is valid
        if (!is_numeric($this->text) || (strlen($this->text) != 12 && strlen($this->text) != 13))
        {
            throw new Exception("Barcode must be 13 numberic digits (if check digit included)");
        }
        
        // Determine the parity groups based on first digit
        $groups = $this->groups[substr($this->text, 0, 1)];
        
        // Calculate check digit
        $weights = [1, 3, 1, 3, 1, 3, 1, 3, 1, 3, 1, 3];
        $digits = str_split(substr($this->text, 0, 12));
        $sum = array_sum(array_map(function($weight, $digit) { return $weight * $digit; }, $weights, $digits));
        $checkdigit = (10 - ($sum % 10)) % 10;
        $this->text = substr($this->text, 0, 12) . $checkdigit;

        // Loop through text encoding barcode
        $barcode = '101';
        for ($i = 1; $i < 13; $i++) {
            $barcode .= ($this->code[substr($this->text, $i, 1)][substr($groups, $i - 1, 1)] . (($i == 6) ? '01010' : ''));
        }
        $barcode .= '101';
        return $barcode;
    }
    
    public function elongateBar($i)
    {
        return ($i <= 2 || ($i >= 45 && $i <= 49) || ($i >= 92));
    }
}
