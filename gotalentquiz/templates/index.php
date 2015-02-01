<?php
    include'quiz/header.php'; 
?>
    <div id="container" class="quiz">
        <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Alternar</button>
          </p>
          <div class="jumbotron">
			<h2>Ranking Geral</h2>
        <ul class="leaders">
        <table border="1" width="60%" class="table table-bordered">
		<tr>
			<th><span>POS.</span></th>
			<th><span>NOME</span></th>
			<th><span>PONTOS</span></th>
			<th><span>TEMPO TOTAL</span></th>
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
				}
				else
				{
					echo "<tr class='warning'>";
				}
				echo "<td ALIGN=MIDDLE>".$cont."</td>";
				echo "<td>".$row[0]."</td>";
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