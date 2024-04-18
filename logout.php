<?php

session_start();

/**
 * Ending the session by unsetting and destroying the session variables.
 */
session_unset();
session_destroy();

// After logout, user is redirected to login page.
header('location:login.php');
