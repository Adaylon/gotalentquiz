<?php
//incluindo a referencia do arquivo produto
include "userQuizPontuacao.php";
//instância da classe Risco
$p = new userQuizPontuacao;
if(isset($_GET["quiz"]) && isset($_GET["usuario"]) && isset($_GET["pontos"]))
{
	$quiz = $_GET["quiz"];
	$usuario = $_GET["usuario"];
	$pontos= $_GET["pontos"];
	$p->setQuiz($quiz);
	$p->setUsuario($usuario);
	$p->setScore($pontos);
	$i = 0;
	$i = $p->setPontuacoes($p);
	if($i>0)
	{	
		echo "alert('sucesso');";
	}
	else
	{
		echo "alert('erro');";
	}
}
?>