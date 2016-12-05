<?php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <id>' . PHP_EOL;
      exit();
  }

  $em = GetEntityManager();
  $result = $em->find('MiW16\Results\Entity\Result', $argv[1]);
  if ($result) {
    if (in_array('--json', $argv)) {
      echo json_encode($result) . PHP_EOL;
    } else {
      echo $result;
    }
  }else{
    if (in_array('--json', $argv)) {
      echo json_encode("{errors: no encontrado}") . PHP_EOL;
    } else {
      echo "no encontrado" . PHP_EOL;
    }
  }

?>
