<?php

$PATH_TO_DATA = __DIR__ . '/../data/results.json';

if(!file_exists($PATH_TO_DATA)) {
  echo json_encode(["result" => false]);
  exit;
}

$username = strval($_GET['username']);

$allResults = json_decode(file_get_contents($PATH_TO_DATA), true);

//search for a result associated with the username
foreach($allResults as $result) {
  if($result['username'] === $username) {
    // found one
    echo json_encode(["result" => true]);
    exit;
  }
}

// not found any
echo json_encode(["result" => false]);
exit;