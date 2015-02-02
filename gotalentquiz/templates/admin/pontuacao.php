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
		  
		  
		  
		  <table id="quizzes" class="table table-striped">
                <thead>
                    <tr><th>Nome</th><th>ID Campuseiro</th><th>Pontos</th><th>Data</th></tr>
                </thead>
                <tbody>
                    <?php

                    ?>
                </tbody>
            </table>
		  
          </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    <?php include 'footer.php'; ?>