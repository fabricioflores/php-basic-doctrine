<?php // demoDoctrineDic0116bis - creaProducto.php
  require_once __DIR__ . '/../../bootstrap.php';

  if ($argc != 2 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <id>' . PHP_EOL;
      exit();
  }

  try {
    $em = GetEntityManager();
    $result = $em->find('MiW16\Results\Entity\Result', $argv[1]);
    if ($result) {
      echo "nuevo resultado (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $resultado = $currentInput != "" ? $currentInput : $result->getResult();

      echo "nuevo id de usuario (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $userId = $currentInput != "" ? $currentInput : $result->getUser()->getId();

      echo "nueva fecha (enter para no modificar): ";
      $handle = fopen ("php://stdin","r");
      $currentInput = trim(fgets($handle));
      $date = $currentInput;

      $user = $em->find('MiW16\Results\Entity\User', $userId);

      $result->setResult($resultado);
      $result->setUser($user);
      $time = $result->getTime();
      if ($date != "") {
        $time = new \DateTime($date);
      }
      $result->setTime($time);
      $em->flush();

      if (in_array('--json', $argv)) {
        echo json_encode($result) . PHP_EOL;
      } else {
        echo $result;
      }

    }else{
      echo "Resultado no encontrado" . PHP_EOL;
    }

  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

?>
