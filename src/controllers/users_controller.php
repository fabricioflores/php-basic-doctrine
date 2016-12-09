<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\User;

  function indexUsers(){
    $entityManager = getEntityManager();
    if (($_SERVER['REQUEST_METHOD'] === 'GET')) {
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
      $contenido .= '<div><a href="/">Regresar</a></div>';
      $contenido .= '<div><a class="btn btn-primary" href="/users/new">Nuevo Usuario</a></div>';
    }else{
      try {
        $user = new User($_POST['username'], $_POST['email'], $_POST['password']);
        $entityManager->persist($user);
        $entityManager->flush();
        $contenido = '<div class="bg-success">Usuario creado satisfactoriamente. <a href="users">Ir a la lista</a></div>';
      } catch (Exception $e) {
        $contenido = '<div class="bg-danger">'. $e->getMessage() .'</div>';
        $contenido .= '<a href="users/new">Intentar de nuevo</a>';
      }
    }
    require 'plantilla.php';
  }

  function newUser(){
    $contenido = '<h3>Nuevo Usuario</h3>';
    $contenido .= <<< __MARCA_FIN
<form method="post" action="/users" class="col-xs-4">
  <div class="form-group">
    <label for="username">username</label>
    <input class="form-control" type="text" id="username" name="username"/>
  </div>
  <div class="form-group">
    <label for="email">email</label>
    <input class="form-control" type="email" id="email" name="email"/>
  </div>
  <div class="form-group">
    <label for="password">password</label>
    <input class="form-control" type="password" id="password" name="password"/>
  </div>
  <input type="submit" value="Enviar" class="btn btn-success"/>
</form>
__MARCA_FIN;
  require 'plantilla.php';
  }
?>
