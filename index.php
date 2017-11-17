<?php

/**
 * This is the only entry point of this minimalistic back-end,
 * so there is no need for specific apache configuration.
 * 
 * This file act as a URL parameters parser,
 * and will call the appropriate files that will perform needed actions
 * (extract, format, return and save data)
 * 
 * Requests will be of type : http://mysite.com/?data=<name-of-data>
 */

header("Access-Control-Allow-Origin: *");

switch($_SERVER['REQUEST_METHOD']) {

  /***************************************
   * GET requests
   **************************************/
  case 'GET':
    switch($_GET['data']) {

      case 'list-quizzes': // Get the full list of quizzes (id and title only)
        require_once(__DIR__ . '/actions/getListOfQuizzes.php');
        break;

      case 'quiz': // Get one full quiz without the 'answer' field
        require_once(__DIR__ . '/actions/getOneQuiz.php');
        break;
      
      default: break;
    }
    break;


  /***************************************
   * POST requests
   **************************************/
  case 'POST' : 
    // TODO
    break;
  default: break;
}
