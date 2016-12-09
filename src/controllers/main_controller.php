<?php
  function index(){
    $contenido = '<h3>Gestión de usuarios y resultados</h3>';
    $contenido .= '<div><a href="/users">Usuarios</a></div>';
    $contenido .= '<div><a href="/results">Resultados</a></div>';
    require 'plantilla.php';
  }
?>
