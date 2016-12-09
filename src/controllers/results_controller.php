<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\Result;

  function indexResults(){
    $entityManager = getEntityManager();
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
    $contenido .= '<a href="/">Regresar</a>';
    require 'plantilla.php';
  }
?>
