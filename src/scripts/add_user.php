<?php // demoDoctrineDic0116bis - creaProducto.php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\User;
  if ($argc != 4) {
      echo $argv[0] . ' <username> <email> <password>' . PHP_EOL;
      exit();
  }
  $user = new User($argv[1], $argv[2], $argv[3]);

  $em = GetEntityManager();
  $em->persist($user);
  $em->flush();
?>
