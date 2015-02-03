<?php
include_once "conexao.php";
class UserQuizPontuacaoDAO
{
	public function getPontuacoes()
	{
		$conexao = new Conexao;
		$con = $conexao->conectarMysql();
		$query = mysql_query("select u.name,u.idcampuseiro,sum(q.score) pontos , q.date_submitted data from quiz_users q join users u on q.user_id = u.id group by u.name order by sum(q.score) desc, q.time_taken;");
		mysql_close($con);
		return $query;
	}
	public function setPontuacoes($userQuizPontuacao)
	{
		$conexao = new Conexao;
		$con = $conexao->conectarMysql();
		mysql_query("INSERT INTO `quiz_users` (`quiz_id`, `user_id`, `score`, `start_time`, `date_submitted`, `time_taken`) VALUES ('".$userQuizPontuacao->getQuiz()."', '".$userQuizPontuacao->getUsuario()."', '".$userQuizPontuacao->getScore()."', '".$userQuizPontuacao->getStart()."', '".$userQuizPontuacao->getSubmitted()."', '".$userQuizPontuacao->getTaken()."')");
		$ret = mysql_affected_rows();
		$i = false;
		if($ret > 0)
		{
			$i = true;
		}
		else
		{
			$i = false;
		}
		mysql_close($con);
		return $i;
	}
}
?>