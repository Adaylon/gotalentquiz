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
			<h3>A Go Talent está de olho em você!</h3>
			<h3>Para nós, seu talento vale mais que 1 milhão de Macbooks!</h3>
			<img src='<?=$root?>/images/obs.jpg'/><br />
			<h1>O ranking só será disponibilizado no dia 07/02/2015</h1>		

			<!-- PARTE 4	 -->
			<h2>Regras</h2>
			
			<li><p class="list-group-item-text">O participante deve estar credenciado no site Quiz by Go Talent.</p></li>
			<li><p class="list-group-item-text">O regulamento poderá sofrer alterações para garantir o máximo de transparência na competição e para que todos tenham chance de ganhar.</p></li>
			<li><p class="list-group-item-text">Serão 4 Quizzes Oficiais com 25 questões cada e provas extras.</p></li>
			<li><p class="list-group-item-text">O 1º Quiz será iniciado na quarta-feira dia 04/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 2º Quiz será iniciado na quinta-feira dia 05/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 3º Quiz será iniciado na sexta-feira dia 06/02/15 à 00:00 e será encerrado às 23:59.</p></li>
			<li><p class="list-group-item-text">O 4º Quiz será iniciado no sábado dia 07/02/15 à 00:00 e será encerrado às 10:30 no palco CROSS SPACE.</p></li>
			<li><p class="list-group-item-text">Para receber o prêmio, o participante ganhador deverá estar presente na palestra às 10:30 no palco CROSS SPACE.</p></li>
			<li><p class="list-group-item-text">Fique atento no nosso Twitter: PortalGoTalent para provas relâmpagos com pontos extras para o Quiz.</p></li>
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
<?php include 'quiz/footer.php'; ?>
<script type="text/javascript">
<!--
alert("ATENÇÃO!!!\n\nNÃO UTILIZE CADASTRO FAKE NO QUIZ!\n\nPARA SER O GANHADOR DO MACBOOK AIR NO FINAL DA COMPETIÇÃO, UTILIZE UM E-MAIL VÁLIDO E SUA ID DE CAMPUSEIRO QUE ENCONTRA-SE NO SEU CRACHÁ PARA PARTICIPAR.\nNA ENTREGA DO PRÊMIO, EM CASO DE INFORMAÇÕES INVÁLIDAS, VOCÊ ESTARÁ ELIMINADO DA COMPETIÇÃO E O PRÓXIMO NO RANKING COM INFORMAÇÕES VÁLIDAS SERÁ O GANHADOR!\n\nPROCURE A EQUIPE DA GO TALENT PARA REGURALIZAR SEU CADASTRO, CASO VOCÊ ESTEJA JOGANDO COM USUÁRIO FAKE.\n\nDivirta-se e fique atento no nosso Twitter: PortalGoTalent, pois na reta final terão provas relâmpagos com pontos extras para melhorar sua colocação no ranking geral do Quiz!");
//-->
</script>