<?php

class code128 {
    
    public $bars = '';
    public $text = '';
    
    public function __construct($text)
    {
        $this->text = $text;
        $this->bars = $this->encode();
    }

    private $code = [
        ' ' => ['pattern' => '11011001100', 'value' => '0'],
        '!' => ['pattern' => '11001101100', 'value' => '1'],
        '"' => ['pattern' => '11001100110', 'value' => '2'],
        '#' => ['pattern' => '10010011000', 'value' => '3'],
        '$' => ['pattern' => '10010001100', 'value' => '4'],
        '%' => ['pattern' => '10001001100', 'value' => '5'],
        '&' => ['pattern' => '10011001000', 'value' => '6'],
        '\'' => ['pattern' => '10011000100', 'value' => '7'],
        '(' => ['pattern' => '10001100100', 'value' => '8'],
        ')' => ['pattern' => '11001001000', 'value' => '9'],
        '*' => ['pattern' => '11001000100', 'value' => '10'],
        '+' => ['pattern' => '11000100100', 'value' => '11'],
        ',' => ['pattern' => '10110011100', 'value' => '12'],
        '-' => ['pattern' => '10011011100', 'value' => '13'],
        '.' => ['pattern' => '10011001110', 'value' => '14'],
        '/' => ['pattern' => '10111001100', 'value' => '15'],
        '0' => ['pattern' => '10011101100', 'value' => '16'],
        '1' => ['pattern' => '10011100110', 'value' => '17'],
        '2' => ['pattern' => '11001110010', 'value' => '18'],
        '3' => ['pattern' => '11001011100', 'value' => '19'],
        '4' => ['pattern' => '11001001110', 'value' => '20'],
        '5' => ['pattern' => '11011100100', 'value' => '21'],
        '6' => ['pattern' => '11001110100', 'value' => '22'],
        '7' => ['pattern' => '11101101110', 'value' => '23'],
        '8' => ['pattern' => '11101001100', 'value' => '24'],
        '9' => ['pattern' => '11100101100', 'value' => '25'],
        ':' => ['pattern' => '11100100110', 'value' => '26'],
        ';' => ['pattern' => '11101100100', 'value' => '27'],
        '<' => ['pattern' => '11100110100', 'value' => '28'],
        '=' => ['pattern' => '11100110010', 'value' => '29'],
        '>' => ['pattern' => '11011011000', 'value' => '30'],
        '?' => ['pattern' => '11011000110', 'value' => '31'],
        '@' => ['pattern' => '11000110110', 'value' => '32'],
        'A' => ['pattern' => '10100011000', 'value' => '33'],
        'B' => ['pattern' => '10001011000', 'value' => '34'],
        'C' => ['pattern' => '10001000110', 'value' => '35'],
        'D' => ['pattern' => '10110001000', 'value' => '36'],
        'E' => ['pattern' => '10001101000', 'value' => '37'],
        'F' => ['pattern' => '10001100010', 'value' => '38'],
        'G' => ['pattern' => '11010001000', 'value' => '39'],
        'H' => ['pattern' => '11000101000', 'value' => '40'],
        'I' => ['pattern' => '11000100010', 'value' => '41'],
        'J' => ['pattern' => '10110111000', 'value' => '42'],
        'K' => ['pattern' => '10110001110', 'value' => '43'],
        'L' => ['pattern' => '10001101110', 'value' => '44'],
        'M' => ['pattern' => '10111011000', 'value' => '45'],
        'N' => ['pattern' => '10111000110', 'value' => '46'],
        'O' => ['pattern' => '10001110110', 'value' => '47'],
        'P' => ['pattern' => '11101110110', 'value' => '48'],
        'Q' => ['pattern' => '11010001110', 'value' => '49'],
        'R' => ['pattern' => '11000101110', 'value' => '50'],
        'S' => ['pattern' => '11011101000', 'value' => '51'],
        'T' => ['pattern' => '11011100010', 'value' => '52'],
        'U' => ['pattern' => '11011101110', 'value' => '53'],
        'V' => ['pattern' => '11101011000', 'value' => '54'],
        'W' => ['pattern' => '11101000110', 'value' => '55'],
        'X' => ['pattern' => '11100010110', 'value' => '56'],
        'Y' => ['pattern' => '11101101000', 'value' => '57'],
        'Z' => ['pattern' => '11101100010', 'value' => '58'],
        '[' => ['pattern' => '11100011010', 'value' => '59'],
        '\\' => ['pattern' => '11101111010', 'value' => '60'],
        ']' => ['pattern' => '11001000010', 'value' => '61'],
        '^' => ['pattern' => '11110001010', 'value' => '62'],
        '_' => ['pattern' => '10100110000', 'value' => '63'],
        '`' => ['pattern' => '10100001100', 'value' => '64'],
        'a' => ['pattern' => '10010110000', 'value' => '65'],
        'b' => ['pattern' => '10010000110', 'value' => '66'],
        'c' => ['pattern' => '10000101100', 'value' => '67'],
        'd' => ['pattern' => '10000100110', 'value' => '68'],
        'e' => ['pattern' => '10110010000', 'value' => '69'],
        'f' => ['pattern' => '10110000100', 'value' => '70'],
        'g' => ['pattern' => '10011010000', 'value' => '71'],
        'h' => ['pattern' => '10011000010', 'value' => '72'],
        'i' => ['pattern' => '10000110100', 'value' => '73'],
        'j' => ['pattern' => '10000110010', 'value' => '74'],
        'k' => ['pattern' => '11000010010', 'value' => '75'],
        'l' => ['pattern' => '11001010000', 'value' => '76'],
        'm' => ['pattern' => '11110111010', 'value' => '77'],
        'n' => ['pattern' => '11000010100', 'value' => '78'],
        'o' => ['pattern' => '10001111010', 'value' => '79'],
        'p' => ['pattern' => '10100111100', 'value' => '80'],
        'q' => ['pattern' => '10010111100', 'value' => '81'],
        'r' => ['pattern' => '10010011110', 'value' => '82'],
        's' => ['pattern' => '10111100100', 'value' => '83'],
        't' => ['pattern' => '10011110100', 'value' => '84'],
        'u' => ['pattern' => '10011110010', 'value' => '85'],
        'v' => ['pattern' => '11110100100', 'value' => '86'],
        'w' => ['pattern' => '11110010100', 'value' => '87'],
        'x' => ['pattern' => '11110010010', 'value' => '88'],
        'y' => ['pattern' => '11011011110', 'value' => '89'],
        'z' => ['pattern' => '11011110110', 'value' => '90'],
        '{' => ['pattern' => '11110110110', 'value' => '91'],
        '|' => ['pattern' => '10101111000', 'value' => '92'],
        '}' => ['pattern' => '10100011110', 'value' => '93'],
        '~' => ['pattern' => '10001011110', 'value' => '94'],
        'DEL' => ['pattern' => '10111101000', 'value' => '95'],
        'FNC 3' => ['pattern' => '10111100010', 'value' => '96'],
        'FNC 2' => ['pattern' => '11110101000', 'value' => '97'],
        'Shift A' => ['pattern' => '11110100010', 'value' => '98'],
        'Code C' => ['pattern' => '10111011110', 'value' => '99'],
        'FNC 4' => ['pattern' => '10111101110', 'value' => '100'],
        'Code A' => ['pattern' => '11101011110', 'value' => '101'],
        'FNC 1' => ['pattern' => '11110101110', 'value' => '102'],
        'START CODE A' => ['pattern' => '11010000100', 'value' => '103'],
        'START CODE B' => ['pattern' => '11010010000', 'value' => '104'],
        'START CODE C' => ['pattern' => '11010011100', 'value' => '105'],
        'STOP' => ['pattern' => '1100011101011', 'value' => '106'],
        'REVERSE STOP' => ['pattern' => '11010111000', 'value' => '—'],
    ];

    private function encode() {
        // Append Start Code B
        $barcode = $this->code['START CODE B']['pattern'];

        // Loop through text encoding barcode and calculating checksum
        $sum = 104;
        for ($i = 0; $i < strlen($this->text); $i++) {
            $barcode .= $this->code[substr($this->text, $i, 1)]['pattern'];
            $sum += (($this->code[substr($this->text, $i, 1)]['value']) * ($i + 1));
        }
        
        // Sum modulo 103 gives checksum
        $checksum = $sum % 103;

        // Locate the pattern for the checksum and append
        foreach ($this->code as $value) {
            if ($value['value'] == $checksum) {
                $barcode .= $value['pattern'];
                break;
            }
        }

        // Append Stop Code
        $barcode .= $this->code['STOP']['pattern'];
        return $barcode;
    }
}
