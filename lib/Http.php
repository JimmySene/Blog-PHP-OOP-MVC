<?php

class Http 
{
    public static function redirect(string $path) : void
    {
        header('Location: '.$path);
        exit();
    }
}