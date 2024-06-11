<?php

include 'config.php';

require_once(ROOT .'/pages/post/fonctions.php');

if(login()){
   header("Location: /pages/home.php");
   exit();
} else {
   header("Location: /pages/login.php");
   exit();
};

?>

