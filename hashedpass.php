<?php
// The plain text password
$plainTextPassword = 'kali';

// Hash the password
$hashedPassword = password_hash($plainTextPassword, PASSWORD_DEFAULT);

echo $hashedPassword;
