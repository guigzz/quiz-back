<?php

function _getOneQuiz($quizId, $withAnswsers = false) {
  $quizId = strval($quizId);
  $PATH_TO_DATA = __DIR__ . '/../data/quizzes.json';
  
  $quizzes = json_decode(file_get_contents($PATH_TO_DATA), true);
  
  if(!$quizId || $quizId === null) {
    return null;
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
    return null;
  }
  
  if(!$withAnswsers) {
    // remove the 'answer' fields from every questions,
    // we don't want to pass the answer to the front
    foreach($quiz['questions'] as $k => $question) {
      unset($quiz['questions'][$k]['answer']);
    }
  }
  
  return $quiz;
}