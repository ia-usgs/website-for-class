<?php
//I made this file to convert a password and have it put into the database as a starting method

// The plain text password
$plainTextPassword = 'kali';

// Hash the password
$hashedPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);

echo $hashedPassword;
