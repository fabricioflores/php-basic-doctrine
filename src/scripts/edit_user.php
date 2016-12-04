<?php // demoDoctrineDic0116bis - creaProducto.php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <username>' . PHP_EOL;
      exit();
  }

  try {
    $em = GetEntityManager();
    $user = $em->getRepository('MiW16\Results\Entity\User')->findOneBy(array('username' => $argv[1]));
    if ($user) {
      echo "nuevo nombre de usuario (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $username = $currentInput != "" ? $currentInput : $user->getUsername();

      echo "nuevo correo (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $email = $currentInput != "" ? $currentInput : $user->getEmail();

      echo "nueva contraseña (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $password = $currentInput;

      $user->setUsername($username);
      $user->setEmail($email);
      if ($password != "") {
        $user->setPassword($password);
      }
      $em->flush();

      if (in_array('--json', $argv)) {
        echo json_encode($user) . PHP_EOL;
      } else {
        echo $user;
      }

    }else{
      echo "Usuario no encontrado";
      exit();
    }

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

?>
