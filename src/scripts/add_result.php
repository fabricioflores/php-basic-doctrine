<?php
  require_once __DIR__ . '/../../bootstrap.php';
  use MiW16\Results\Entity\Result;

  if ($argc != 4 && !(in_array('--json', $argv))) {
      echo $argv[0] . ' <result> <username> <date> optional --json' . PHP_EOL;
      exit();
  }

  try {
    $em = GetEntityManager();

    $user = $em->getRepository('MiW16\Results\Entity\User')->findOneBy(array('username' => $argv[2]));
    $time = new \DateTime($argv[3]);
    $result = new Result($argv[1], $user, $time);
    $em->persist($result);
    $em->flush();
    if (in_array('--json', $argv)) {
      echo json_encode($result) . PHP_EOL;
    } else {
      echo $result;
    }
  } catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
  }

?>
