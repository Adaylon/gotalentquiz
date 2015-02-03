<?php
include_once "userQuizPontuacaoDAO.php";
class UserQuizPontuacao
{
	private $quiz;
	private $usuario;
	private $score;
	private $start;
	private $submitted;
	private $taken;
	
	public function setQuiz($quiz)
	{
		$this->quiz = $quiz;
	}
	public function getQuiz()
	{	
		return $this->quiz;
	}
	
	public function setUsuario($usuario)
	{
		$this->usuario = $usuario;
	}
	public function getUsuario()
	{	
		return $this->usuario;
	}
	
	public function setScore($score)
	{
		$this->score = $score;
	}
	public function getScore()
	{
		return $this->score;
	}

	public function setStart($start)
	{
		$this->start = $start;
	}
	public function getStart()
	{
		return $this->start;
	}

	public function setTaken($taken)
	{
		$this->taken = $taken;
	}
	public function getTaken()
	{
		return $this->taken;
	}
	
	public function setSubmitted($submitted)
	{
		$this->submitted = $submitted;
	}
	public function getSubmitted()
	{
		return $this->submitted;
	}
	
	public function getPontuacoes()
	{
		$c = new UserQuizPontuacaoDAO;
		$i = $c->getPontuacoes();
		return $i;
	}

	public function setPontuacoes($userQuizPontuacao)
	{
		$c = new UserQuizPontuacaoDAO;
		$i = $c->setPontuacoes($userQuizPontuacao);
		return $i;
	}
}
?>