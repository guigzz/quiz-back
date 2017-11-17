<?php

$RESULT_LOCATION = __DIR__ . '/../data/results.json';

$requestContent = file_get_contents('php://input');
$userResults = json_decode($requestContent, true);
$userResults["id"] = time();

$allResults = file_exists($RESULT_LOCATION) ? json_decode(file_get_contents($RESULT_LOCATION), true) : [];

$allResults[] = $userResults;

file_put_contents($RESULT_LOCATION, json_encode($allResults));

echo json_encode(["resultId" => $userResults["id"]]);
exit;