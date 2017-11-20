<?php

function _getDetailedResult($result, $quiz) {
  // construct a compared version of the answers
  $comparedResult = [];
  $goodAnswerCounter = 0;
  $comparedResult['id'] = $result['id'];
  $comparedResult['username'] = $result['username'];
  $comparedResult['quizId'] = $result['quizId'];
  $comparedResult['quizTitle'] = $quiz['title'];
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

  return $comparedResult;
}

