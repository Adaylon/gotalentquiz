<?php
    include'header.php';
    $numquestions = $quiz->countQuestions();
    $leadersToShow = 10;
?>
    <div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-6 col-md-offset-3">
              <?php if (isset($error)) { echo '<div id="updater" class="alert alert-danger">'.$error
                  .'</div>'; } ?>
          <h2><?php echo $quiz->getName(); ?></h2>
          <h4><?php echo $quiz->getDescription(); ?></h4>
		  <p>Depois de ter iniciado o teste, você deve responder a todas as perguntas. Se você tentar voltar à questão anterior, sua pontuação será zerada e você voltará para o início.</p>
          <p>Para cada pergunta, escolha uma resposta e clique em <strong>"Enviar resposta"</strong>. Você vai então para a pergunta seguinte. </p>
          <p>Este questionário tem <strong> <?php echo $numquestions; ?> </strong> perguntas. </p>
          <p>Você terá a sua pontuação no final do quiz.</p>
          <div id="leaders-score">
                <h4>Top <?php echo $leadersToShow; ?> Placar desse Quiz</h4>
                <div class="row">
                    <ul class="leaders col-md-6">
                        <?php
                        $leaders = $quiz->getLeaders($leadersToShow);
                        $counter = 1;
                        foreach ($leaders as $leader) :

                            echo '<li><strong>' . $leader["name"] . '</strong>: ' .  $leader["score"] . '/' . $numquestions . '</li>';

                            //Use modulus to create new sub-list if required.
                            if ($counter % (round($leadersToShow/2)) == 0) :  
                                echo '</ul>' . PHP_EOL . '<ul class="leaders col-md-6">' . PHP_EOL;
                            endif;

                            $counter++;

                        endforeach;
                        ?>
                    </ul>
                </div>
            </div><!-- leaders-score-->
              <div>
                  <form id="questionBox" method="post" action="<?php echo $root; ?>/quiz/process">
                      <p>
                          <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                          <input type="submit" id="submitstart" name="starter" class="btn btn-lg btn-success"
                          value="Iniciar Quiz" />
                      </p>
                  </form>
              </div>
          </div>
		
      </div><!-- /.row -->
        
    </div><!--container-->
<?php include 'footer.php'; ?>
<script type="text/javascript">
<!--
alert("Atenção Campuseiro, estamos chegando ao final da nossa competição. \n Você achou que seria fácil ganhar o Macbook Air né? \n Agora a dificuldade das questões aumentam e as opções são randômicas.\n Divirta-se e fique atento no nosso Twitter: PortalGoTalent que na reta final terão provas relâmpagos com pontos extras para o Quiz!");
//-->
</script>