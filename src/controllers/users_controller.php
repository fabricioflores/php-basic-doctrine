<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\User;

  function indexUsers(){
    $entityManager = getEntityManager();
    $userRepository = $entityManager->getRepository('MiW16\Results\Entity\User');
    $users = $userRepository->findAll();
    $contenido = '<h3>Usuarios</h3>';
    $contenido .= <<< ___MARCA_FIN
     <h4 align='center'>Tabla de Usuarios</h4>
     <table class="table table-hover">
     <tr>
         <th>ID</th><th>username</th><th>correo</th><th>Enabled?</th>
     </tr>
___MARCA_FIN;

    foreach ($users as $user) {
      $contenido .= <<< _______MARCA_FIN
          <tr>
               <td>{$user->getId()}</td>
               <td>{$user->getUsername()}</td>
               <td>{$user->getEmail()}</td>
               <td>{$user->getEnabled()}</td>
           </tr>
_______MARCA_FIN;
    }
    $contenido .= '<a href="/">Regresar</a>';
    require 'plantilla.php';
  }
?>
