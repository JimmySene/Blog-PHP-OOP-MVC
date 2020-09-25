<?php
require_once('lib/database.php');

class Model
{
    protected $pdo;

    function __construct()
    {
        $this->pdo = getPdo();
    }
}