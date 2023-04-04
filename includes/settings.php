<?php
//Define custom constants to use with project
const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'cle2';


//Custom error handler, so every error will throw a custom ErrorException
set_error_handler(function ($severity, $message, $file, $line) {
    throw new ErrorException($message, $severity, $severity, $file, $line);
});

const register = 'C:\xampp\htdocs\php\cle2\test\login_register\register.php';
