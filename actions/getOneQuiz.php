<?php

$PATH_TO_DATA = __DIR__ . '/../data/quizzes.json';

$quizId = strval($_GET['id']);

$quizzes = json_decode(file_get_contents($PATH_TO_DATA), true);

if(!$quizId || $quizId === null) {
  echo "Error"; // TODO : better error handling, return specific HTTP status
  exit;
}

// find the quiz
$quiz = [];
foreach($quizzes as $q) {
  if( strval($q['id']) === $quizId) {
    $quiz = $q;
    break;
  }
}

if(empty($quiz)) {
  echo "Quiz not found"; // TODO : better error handling, return specific HTTP status
  exit;
}

// remove the 'answer' fields from every questions,
// we don't want to pass the answer to the front
foreach($quiz['questions'] as $k => $question) {
  unset($quiz['questions'][$k]['answer']);
}

echo json_encode($quiz);