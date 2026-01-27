<?php
session_start();
session_destroy();
header("Location: T4LIFE.php");
exit();
?>