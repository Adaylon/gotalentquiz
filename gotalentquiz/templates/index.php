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
			<h1 class="principal">Quiz by Go Talent</h1>			
		  
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

			<!-- PARTE 4	 -->
			<h2>Regras</h2>
			
			<li><p class="list-group-item-text">O participante deve estar credenciado no site Quiz by Go Talent.</p></li>
			<li><p class="list-group-item-text">Serão 4 Quizzes com 25 questões cada.</p></li>
			<li><p class="list-group-item-text">O 1º Quiz será iniciado na quarta-feira dia 04/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 2º Quiz será iniciado na quinta-feira dia 05/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 3º Quiz será iniciado na sexta-feira dia 06/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 4º Quiz será iniciado no sábado dia 07/02/15 à 00:00 e será encerrado às 10:30 no palco Crossespace.</p></li>
			<li><p class="list-group-item-text">Para receber o prêmio, o participante ganhador deverá estar presente na palestra às 10:30 no palco CROSS SPACE.</p></li>
			<br /><br />

          </div>		  
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