<?php // demoDoctrineDic0116bis - creaProducto.php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <username>' . PHP_EOL;
      exit();
  }

  try {
    $em = GetEntityManager();
    $user = $em->getRepository('MiW16\Results\Entity\User')->findOneBy(array('username' => $argv[1]));
    if (in_array('--json', $argv)) {
      echo json_encode($user) . PHP_EOL;
    } else {
      echo $user;
    }

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

?>
