<?php

$username = strval($_GET['username']);

/**
 * Get all results
 */
$PATH_TO_DATA = __DIR__ . '/../data/detailed_results.json';
if(!file_exists($PATH_TO_DATA)) {
  echo json_encode([]);
  exit;
}
$allResults = json_decode(file_get_contents($PATH_TO_DATA), true);

// find all results of this user
// and form a list of main infos about each result
$returnArray = [];

foreach($allResults as $result) {
  if($result['username'] === $username) {
    // check if we already have this quiz id saved here
    $where = -1;
    foreach($returnArray as $key => $ret) {
      if($ret['quizId'] === $result['quizId']) {
        $where = $key;
        break;
      }
    }
    if($where >= 0) { // add the result info to the already existing list of results for this quiz
      $returnArray[$where]["results"][] = [
        "id" => $result['id'], 
        "score" => $result['goodAnswerCounter'] . '/' . count($result['answers'])
      ];
    }
    else { // first result for this quizId, create a category
      $returnArray[] = [
        "results"  => [[
          "id" => $result['id'], 
          "score" => $result['goodAnswerCounter'] . '/' . count($result['answers'])
        ]], // an array of results info
        "quizId"    => $result['quizId'],
        "quizTitle" => $quizTitles[$result['quizId']]
      ];
    }
  }
}

echo json_encode($returnArray);
