<?php
require_once(__DIR__ . '/../helpers/_getOneQuiz.php');

$PATH_TO_DATA = __DIR__ . '/../data/results.json';

$resultId = strval($_GET['id']);

$allResults = json_decode(file_get_contents($PATH_TO_DATA), true);

if(!$resultId || $resultId === null) {
  echo "Error"; // TODO : better error handling, return specific HTTP status
  exit;
}

// find the result
$result = [];
foreach($allResults as $r) {
  if( strval($r['id']) === $resultId) {
    $result = $r;
    break;
  }
}

if(empty($result)) {
  echo "Result not found"; // TODO : better error handling, return specific HTTP status
  exit;
}

// get the corresponding quiz to compare answers
$quiz = _getOneQuiz($result['quizId'], true);
if($quiz === null) {
  echo "Error!"; exit;
}
// construct a compared version of the answers
$comparedResult = [];
$goodAnswerCounter = 0;
$comparedResult['id'] = $result['id'];
$comparedResult['username'] = $result['username'];
$comparedResult['quizId'] = $result['quizId'];
$comparedResult['answers'] = []; // to be filled below

foreach($result['answers'] as $ans) {
  $questionNumber = $ans['question'];
  $questionText = "";
  $userAnswerNumber = $ans['choice'];
  $userAnswerText = "";
  $goodAnswerNumber = null;
  $goodAnswerText = "";

  foreach($quiz['questions'] as $quest) {
    if($quest['number'] == $questionNumber) {
      $goodAnswerNumber = $quest['answer'];
      $questionText = $quest['text'];
      foreach($quest['choices'] as $choice) {
        if($choice['id'] == $userAnswerNumber) {
          $userAnswerText = $choice['text'];
        }
        if($choice['id'] == $goodAnswerNumber) {
          $goodAnswerText = $choice['text'];
        }
      }

      if($userAnswerNumber == $goodAnswerNumber) {
        $goodAnswerCounter += 1;
      }

      $comparedResult['answers'][] = [
        "questionNumber"    => $questionNumber,
        "questionText"      => $questionText,
        "userAnswerNumber"  => $userAnswerNumber,
        "userAnswerText"    => $userAnswerText,
        "goodAnswerNumber" => $goodAnswerNumber,
        "goodAnswerText"   => $goodAnswerText
      ];
      break;
    }
  }
}

$comparedResult['goodAnswerCounter'] = $goodAnswerCounter;


echo json_encode($comparedResult);