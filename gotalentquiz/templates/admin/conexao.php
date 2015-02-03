<?php
//declaração da classe
class Conexao
{
	//declaração do método da classe
	public function conectarMysql()
	{
		//conectando no mysql
		$con = mysql_connect("localhost","admin","123456");
		//seleciona o banco de dados
		mysql_select_db("gotalentquiz");
		//retorna o objeto da conexão
		return $con;
	}
}
?>