<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\Result;

  function indexResults(){
    $entityManager = getEntityManager();
    if (($_SERVER['REQUEST_METHOD'] === 'GET')) {
      $resultsRepository = $entityManager->getRepository('MiW16\Results\Entity\Result');
      $results = $resultsRepository->findAll();
      $contenido = '<h3>Resultados</h3>';
      $contenido .= <<< ___MARCA_FIN
       <h4 align='center'>Tabla de Resultados</h4>
       <table class="table table-hover">
       <tr>
           <th>ID</th><th>resultado</th><th>usuario</th><th>fecha</th>
       </tr>
___MARCA_FIN;

      foreach ($results as $result) {
        $contenido .= <<< _______MARCA_FIN
            <tr>
                 <td>{$result->getId()}</td>
                 <td>{$result->getResult()}</td>
                 <td>{$result->getUserUsername()}</td>
                 <td>{$result->getTime()->format('Y-m-d H:i:s')}</td>
             </tr>
_______MARCA_FIN;
      }
      $contenido .= '<div><a href="/">Regresar</a></div>';
      $contenido .= '<div><a class="btn btn-primary" href="/results/new">Nuevo Resultado</a></div>';
    }else{
      try {
        $user = $entityManager->getRepository('MiW16\Results\Entity\User')->findOneBy(array('username' => $_POST['user']));
        $time = new \DateTime($_POST['date']);
        $result = new Result($_POST['result'], $user, $time);
        $entityManager->persist($result);
        $entityManager->flush();
        $contenido = '<div class="bg-success">Resultado creado satisfactoriamente. <a href="results">Ir a la lista</a></div>';
      } catch (Exception $e) {
        $contenido = '<div class="bg-danger">'. $e->getMessage() .'</div>';
        $contenido .= '<a href="results/new">Intentar de nuevo</a>';
      }
    }
    require 'plantilla.php';
  }

  function newResult(){
    $contenido = '<h3>Nuevo Resultado</h3>';
    $contenido .= <<< __MARCA_FIN
<form method="post" action="/results" class="col-xs-4">
  <div class="form-group">
    <label for="result">result</label>
    <input class="form-control" type="number" id="result" name="result"/>
  </div>
  <div class="form-group">
    <label for="user">user</label>
    <input class="form-control" type="text" id="user" name="user"/>
  </div>
  <div class="form-group">
    <label for="date">date</label>
    <input class="form-control" type="date" id="date" name="date"/>
  </div>
  <input type="submit" value="Enviar" class="btn btn-success"/>
</form>
__MARCA_FIN;
  require 'plantilla.php';
  }
?>
