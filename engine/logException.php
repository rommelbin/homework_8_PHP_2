<?php


namespace app\engine;


class logException
{
    public static function logError($error)
    {
            $error .= PHP_EOL;
            $file = fopen('../logs/Error.txt', 'a');
            fwrite($file, $error);
            fclose($file);
    }
}