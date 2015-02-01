<?php
include_once "conexao.php";
class UserQuizDAO
{
	public function getRankingFull()
	{
		$conexao = new Conexao;
		$con = $conexao->conectarMysql();
		$query = mysql_query("select u.name,sum(q.score) pontos , SUBSTRING(SEC_TO_TIME( SUM( TIME_TO_SEC( time_taken ) ) ),1,5) as tempo from quiz_users q join users u on q.user_id = u.id group by u.name order by sum(q.score) desc, q.time_taken;");
		mysql_close($con);
		return $query;
	}
}
?>