<?php
namespace SimpleQuiz\Utils\Base;


use SimpleQuiz\Utils\User\AdminUser;

class User {

    private $name;
    private $email;
    private $quizzes;
    private $password;
    private $id;
	private $idcampuseiro;

    function __construct($email, $name, $idcampuseiro)
    {
        $this->email = $email;
        $this->name = $name;
		$this->idcampuseiro = $idcampuseiro;
    }
	
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

	public function setIdCampuseiro($idcampuseiro)
    {
        $this->idcampuseiro = $idcampuseiro;
    }

    public function getIdCampuseiro()
    {
        return $this->idcampuseiro;
    }
	
    public function isAdmin()
    {
        return $this instanceof AdminUser;
    }

    public function getQuizzes()
    {
        return $this->quizzes;
    }

    public function getScore($quizid)
    {

    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

}
