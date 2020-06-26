<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SMSMessage extends Model
{
    //

    public static function generate_string($strength = 8) {
        $input = '123456789ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }

        return $random_string;
    }
}
