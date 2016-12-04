<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\User;

  if ($argc != 4 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <username> <email> <password> optional --json' . PHP_EOL;
      exit();
  }

  try {
    $user = new User($argv[1], $argv[2], $argv[3]);

    $em = GetEntityManager();
    $em->persist($user);
    $em->flush();
    if (in_array('--json', $argv)) {
      echo json_encode($user) . PHP_EOL;
    } else {
      echo $user;
    }
  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

?>
