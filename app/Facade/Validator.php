<?php


namespace Facade;

class Validator
{

    public static function isEmpty(...$variables): bool
    {
        foreach ($variables as $variable){
            if(!isset($variable) || $variable === ""){
                return true;
            }else{
                return false;
            }
        }
        return false;
    }

    public static function validFileSize($file): bool
    {
        $minimumFileSize = 10240;
        $maximumFileSize = 5242880;
        if($file["size"] <= $maximumFileSize && $file["size"] >= $minimumFileSize){
            return true;
        }
        return false;
    }

    public static function validFileMimeType($file){
        $allowedMimeType = array("image/jpeg", "image/png");
        if(in_array($file["type"], $allowedMimeType)){
            return true;
        }
        return false;
    }
}