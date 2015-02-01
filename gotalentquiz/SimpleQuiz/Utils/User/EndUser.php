<?php

namespace SimpleQuiz\Utils\User;

use SimpleQuiz\Utils\Base\User;

class EndUser extends User {

    private $quizzes;
	
    function __construct($email, $name, $idcampuseiro)
    {
        parent::__construct($email, $name, $idcampuseiro);
    }

    public function getQuizzes()
    {
        return $this->quizzes;
    }

    public function setQuizzes($quizzes){

        $this->quizzes = $quizzes;
    }
    
    public function getScore($quizid)
    {

    }
}
