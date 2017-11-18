<?php
require_once(__DIR__ . '/../helpers/_getOneQuiz.php');


$quizId = strval($_GET['id']);
$quiz = _getOneQuiz($quizId);

if($quiz === null) {
  echo "Error";
  exit;
}

echo json_encode($quiz);