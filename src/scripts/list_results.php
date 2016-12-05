<?php   // src/scripts/list_users.php

require_once __DIR__ . '/../../bootstrap.php';
use MiW16\Results\Entity\Result;
use MiW16\Results\Entity\User;

$em = getEntityManager();

$resultsRepository = $em->getRepository('MiW16\Results\Entity\Result');
$results = $resultsRepository->findAll();

if (in_array('--json', $argv)) {
    echo json_encode($results);
} else {
  $items = 0;
  echo PHP_EOL . sprintf("  %2s %2s %30s %7s\n", 'Id', 'Result', 'User', 'Time');
  foreach ($results as $result) {
      echo sprintf(
          '- %2d: %2d %30s %7s',
          $result->getId(),
          $result->getResult(),
          $result->getUserUsername(),
          $result->getTime()->format('Y-m-d H:i:s')
      ),
      PHP_EOL;
      $items++;
  }

  echo "\nTotal: $items users.\n\n";
}
