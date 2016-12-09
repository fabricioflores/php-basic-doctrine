<?php
  require_once __DIR__ . '/../bootstrap.php';
  use MiW16\Results\Entity\User;

  function inicioAction(){
    $entityManager = getEntityManager();
    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');
    $users = $userRepository->findAll();
    $contenido = '<h3>Usuarios</h3>';
    $contenido .= <<< ___MARCA_FIN
     <h2 align='center'>Tabla de Usuarios</h2>
     <table border='1' align='center' summary=''>
     <tr>
         <th>ID</th><th>username</th><th>correo</th><th>Enabled?</th>
     </tr>
___MARCA_FIN;

    foreach ($users as $user) {
      $contenido .= <<< _______MARCA_FIN
          <tr>
               <td align='center'>{$user->getId()}</td>
               <td>{$user->getUsername()}</td>
               <td>{$user->getEmail()}</td>
               <td>{$user->getEnabled()}</td>
           </tr>
_______MARCA_FIN;
    }
    require 'plantilla.php';
  }
?>
