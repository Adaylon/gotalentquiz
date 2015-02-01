<?php


namespace SimpleQuiz\Utils\Exceptions;


class RegisterException extends \Exception {

    public function __construct()
    {
        parent::__construct("Já existe um usuário com essas informações. Por favor, tente novamente.");
    }
} 