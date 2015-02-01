<?php
    include'quiz/header.php'; 
?>
    <div class="container quiz">
        <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Alternar</button>
          </p>
          <div class="jumbotron">
			<h1 class="principal">Iron Geek by Go Talent</h1>
			
			<!-- PARTE 1 -->
			<h2>Programação do dia</h2>
			<p> &bull; Nível Fácil : Programar uma versão de Olá Mundo em  HTML5, trocando o nome por Olá Lua e 
			incluir um foguete decolando - Submeter para avaliação até ao final do dia 
			em algum e-mail especificado;</p> 
			<p> &bull; Nível Médio - Decifrar código encriptados - Qr Code escondidos em algum material 
			publicitário nos palcos, no Qr Code metade de um texto sobre inovação e o endereço de 
			e-mail para submeter o texto e uma dica para atividade extra;</p>
			<p> &bull; Nível Difícil : Programar um app para se orientar com base nas estrelas e conseguir o maior número 
			de downloads - Subir o app em algum repositório e enviar o link para 
			acompanharmos o número de downloads;</p>
			<p> &bull; Nível Extra : Encontrar o Qr Code escondido em uma postagem no blog da GoTalent - O 
			Qr Code contêm a segunda parte do texto sobre inovação e o endereço de e-mail para 
			submeter o texto completo.</p>
			
			
		  
			<!-- PARTE 2 -->
			<h2>E no final o que eu ganho com isso?</h2>
			<table class="table table-bordered">
			<tr>
				<th style="text-align:center" width="80">#</th>
				<th><span>PRÊMIO</span></th>
			</tr>
			<tbody>
			<tr>
				<td ALIGN=MIDDLE>1º</td>
				<td><img height='21px' src='<?=$root?>/images/macbookair.png' style='float:right'/>  Mac Book Air</td>				
			</tr>
			<tr>
				<td ALIGN=MIDDLE>2º</td>
				<td><img height='21px' src='<?=$root?>/images/iphone.png' style='float:right'/> Iphone 6</td>				
			</tr>
			<tr>
				<td ALIGN=MIDDLE>3º</td>
				<td><img height='21px' src='<?=$root?>/images/laugh.png' style='float:right'/> O direito de dizer que quase ganhou</td>				
			</tr>
			</tbody>
			</table>
			
			
			
			<!-- PARTE 3 -->
			<h2>Quem está mais perto de ganhar</h2>
			<ul class="leaders">
			<table class="table table-bordered">
			<tr>
				<th style="text-align:center" width="80">#</th>
				<th><span>NOME</span></th>
				<th ALIGN=MIDDLE width="200"><span>PONTOS</span></th>
				<th ALIGN=MIDDLE width="200"><span>TEMPO TOTAL</span></th>
			</tr>
			<tbody>
				<?php 
				include "userQuiz.php";
				$p = new UserQuiz;
				$c = $p->getRankingFull();
				$cont = 1;
				while($row = mysql_fetch_array($c))
				{
					if($cont == 1)
					{
						echo "<tr class='sucess'>";
						$coroa = "<img height='21px' src='" . $root . "/images/crown.png' style='float:right' />";
					}
					else
					{
						echo "<tr class='nowin'>";
						$coroa = "";
					}
					echo "<td ALIGN=MIDDLE>".$cont."º</td>";
					echo "<td>".$coroa. " " . $row[0]."</td>";
					echo "<td ALIGN=MIDDLE >".$row[1]."</td>";
					echo "<td ALIGN=MIDDLE >".$row[2]."</td>";
					echo "</tr>";
					$cont++;
				}
				?>
			</tbody>
			</table>
			</ul>
          </div>
		  
					  
			<!-- PARTE 4 -->
			<h2>Regras</h2>
			<p>Nível de Provas e Pontos:<br>
			Fácil: 30<br>
			Médio: 60<br>
			Difícil: 90<br>
			Extra: 20</p><br>
			<p>Regra pra passar pra próxima fase:<br>
			Atingir 80 pontos</p>
			<br><br><br>
			
		  
        </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="sidebar-nav">
              <h4>Quizzes Recentes</h4>
              <div class="list-group">
              <?php foreach ($quizzes as $quiz) : 
                    echo '<a href="'.$root . '/quiz/' . $quiz->id .'" class="list-group-item">';
                    echo '<h4 class="list-group-item-heading">'. $quiz->name . '</h4>';
                    echo '<p class="list-group-item-text">'. $quiz->description . '</p>';
                    echo '</a>';
                endforeach;
                ?>
              </div>
          </div><!--/.sidebar-nav -->
        </div><!--/span-->
      </div><!--/row-->
        
    </div><!--container-->
<?php include 'quiz/footer.php';