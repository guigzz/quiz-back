<?php

$resultId = strval($_GET['id']);

$PATH_TO_DATA = __DIR__ . '/../data/detailed_results.json';

$allDetailedResults = json_decode(file_get_contents($PATH_TO_DATA), true);

if(!$resultId || $resultId === null) {
  echo "Error"; // TODO : better error handling, return specific HTTP status
  exit;
}

// find the result
$result = [];
foreach($allDetailedResults as $r) {
  if( strval($r['id']) === $resultId) {
    $result = $r;
    break;
  }
}

if(empty($result)) {
  echo "Result not found"; // TODO : better error handling, return specific HTTP status
  exit;
}

echo json_encode($result); exit;