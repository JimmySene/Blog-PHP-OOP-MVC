<?php

function render(string $path, array $vars)
{
    extract($vars);
    ob_start();
    require('templates/'.$path.'.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
}

function redirect(string $path) : void
{
    header('Location: '.$path);
    exit();
}