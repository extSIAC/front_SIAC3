<?php
session_start();
session_destroy();
header('Location: ./../../../../../extraescolares_itpachuca/sistema/vista/login.php');
?>