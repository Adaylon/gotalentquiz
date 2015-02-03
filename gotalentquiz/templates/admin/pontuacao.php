<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
              <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
              <div id="ajaxupdater" class="alert"></div>
          <h4>Gerenciar Ranking</h4>
		  
		 <div class="field">
					<label for="name">Quiz:</label>
					<input type="text" class="input" name="quiz" id="quiz" />
					<label for="name">Usuário:</label>
					<input type="text" class="input" name="usuario" id="usuario" />
					<label for="name">Pontos:</label>
					<input type="text" class="input" name="pontos" id="pontos" />
					<button onclick="salvar()" id="salvar" >Salvar</button>
					<br /><br />
		</div>
		  
		  <table id="quizzes" class="table table-striped">
                <thead>
                    <tr><th>Nome</th><th>ID Campuseiro</th><th>Pontos</th><th>Data</th></tr>
                </thead>
                <tbody>
				<?php 
				include "userQuizPontuacao.php";
				$p = new UserQuizPontuacao;
				$c = $p->getPontuacoes();
				while($row = mysql_fetch_array($c))
				{
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					echo "<td>".$row[3]."</td>";
					echo "</tr>";
				}
				?>
                </tbody>
            </table>
		  
          </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>
	<script type="text/javascript">
	function salvar(){
		var salvar = document.getElementById("salvar").value;
		var quiz = document.getElementById("quiz").value;
		var usuario = document.getElementById("usuario").value;
		var pontos = document.getElementById("pontos").value;
		if(quiz == "" || usuario == "" || pontos == ""){
			alert("Todos os campos são obrigatórios.");
		}else{
			location.href='../salvarPontos.php?salvar='+salvar+'&quiz='+quiz+'&usuario='+usuario+'&pontos='+pontos;
		}
	}
</script>