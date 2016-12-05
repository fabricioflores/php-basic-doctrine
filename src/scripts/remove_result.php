<?php // demoDoctrineDic0116bis - creaProducto.php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <id>' . PHP_EOL;
      exit();
  }

  $em = GetEntityManager();
  $result = $em->find('MiW16\Results\Entity\Result', $argv[1]);
  if ($result) {
    $em->remove($result);
    $em->flush();
    if (in_array('--json', $argv)) {
      echo "Eliminado: " . json_encode($result) . PHP_EOL;
    } else {
      echo "Eliminado: " . $result;
    }
  }else{
    echo "Usuario no encontrado" . PHP_EOL;
  }
?>
