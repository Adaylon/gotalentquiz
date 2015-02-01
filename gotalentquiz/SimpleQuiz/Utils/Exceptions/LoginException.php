<?php


namespace SimpleQuiz\Utils\Exceptions;


class LoginException extends \Exception {

        public function __construct()
        {
            parent::__construct("Erro ao tentar autenticar. Caso problema persista, entre em cotato com o administrador.");
        }
} 