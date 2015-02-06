<?php include 'header.php'; ?>
<div id="container" class="quiz">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <?php if ($requireauth) : ?>
                    <h2>Participante: <span><?php echo $user->getName();  ?></span></h2>
                <?php else: ?>
                    <h2>Resultados:</h2>
                <?php endif; ?>
                 <p><a href="http://gotalent.com.br/quiz">Voltar para a página principal e acompanhar o ranking</a></p>
            <?php
            $x = 1;
            $numquestions = $quiz->countQuestions();
            ?>
            </div>
            <div class="col-md-3">   
                
            </div>
        </div>
    </div><!--container-->
<?php include 'footer.php'; ?>