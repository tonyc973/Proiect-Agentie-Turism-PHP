<?php

class HomeController
{
    public static function index()
    {
        // Load the homepage view
        require_once "app/views/home/home.php";
    }
}