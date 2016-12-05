<?php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <id>' . PHP_EOL;
      exit();
  }

  $em = GetEntityManager();
  $user = $em->find('MiW16\Results\Entity\Result', $argv[1]);
  if ($user) {
    if (in_array('--json', $argv)) {
      echo json_encode($user) . PHP_EOL;
    } else {
      echo $user;
    }
  }else{
    if (in_array('--json', $argv)) {
      echo json_encode("{errors: no encontrado}") . PHP_EOL;
    } else {
      echo "no encontrado" . PHP_EOL;
    }
  }

?>
