<?php
require_once(__DIR__ . '/../helpers/_getOneQuiz.php');
require_once(__DIR__ . '/../helpers/_getDetailedResult.php');

$RESULT_LOCATION = __DIR__ . '/../data/results.json';
$DETAILED_RESULT_LOCATION = __DIR__ . '/../data/detailed_results.json';

/**
 * get user data
 */
$requestContent = file_get_contents('php://input');
$userResults = json_decode($requestContent, true);
$userResults["id"] = time();

/**
 * get all results and add the raw user results
 */
$allResults = file_exists($RESULT_LOCATION) ? json_decode(file_get_contents($RESULT_LOCATION), true) : [];
$allResults[] = $userResults;
file_put_contents($RESULT_LOCATION, json_encode($allResults));

/**
 * get the detailed results and add the detailed result associated with the user data
 */
$allDetailedResults = file_exists($DETAILED_RESULT_LOCATION) ? json_decode(file_get_contents($DETAILED_RESULT_LOCATION), true) : [];
$allDetailedResults[] = _getDetailedResult($userResults, _getOneQuiz($userResults['quizId'], true));
file_put_contents($DETAILED_RESULT_LOCATION, json_encode($allDetailedResults));

echo json_encode(["resultId" => $userResults["id"]]);
exit;