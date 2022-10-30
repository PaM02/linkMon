<?php

  session_start();
  session_destroy();
  // Redirection du visiteur vers la page du minichat
  header('Location:index.html');
  
?>