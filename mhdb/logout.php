<?php
session_start();
// Destroying All Sessions
if(session_destroy())
{
session_unset();
// Redirecting To Home Page
header("Location: signin.html");
}
?>