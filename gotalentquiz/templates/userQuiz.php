<?php
include_once "userQuizDAO.php";
class UserQuiz
{
	private $nome;
	private $pontos;
	private $tempo;
	
	public function setNome($nome)
	{
		$this->nome = $nome;
	}
	public function getNome()
	{	
		return $this->nome;
	}
	
	public function setPontos($pontos)
	{
		$this->pontos = $pontos;
	}
	public function getPontos()
	{	
		return $this->pontos;
	}
	
	public function setTempo($tempo)
	{
		$this->tempo = $tempo;
	}
	public function getTempo()
	{	
		return $this->tempo;
	}
	
	public function getRankingFull()
	{
		$c = new UserQuizDAO;
		$i = $c->getRankingFull();
		return $i;
	}
}
?>