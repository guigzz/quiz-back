<?php

$PATH_TO_DATA = __DIR__ . '/../data/quizzes.json';

$quizzes = json_decode(file_get_contents($PATH_TO_DATA), true);
$data = [];

foreach($quizzes as $quiz) {
  $data[] = [
    "id"      => $quiz['id'],
    "title"   => $quiz['title'],
    "length"  => count($quiz['questions']) //the number of questions in this quiz
  ];
}

echo json_encode($data);