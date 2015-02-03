<?php include 'header.php'; ?>
<div id="container" class="quiz">
        <div class="row">
            <div class="col-md-5 col-md-offset-2">
                <?php if ($requireauth) : ?>
                    <h2>Resultados: <span><?php echo $user->getName();  ?></span></h2>
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
                <h2>Ranking</h2>
                <ul class="leaders">
                    <?php
                    $leaders = $quiz->getLeaders(30);
                    $counter = 1;
                    foreach ($leaders as $leader) :
                        $name = '';
                        //if current user, bolden the username
                        if ($leader['name'] == $user->getName()) :
                            $name = '<strong class="currentuser">' . $leader['name'] . '</strong>';
                        else:
                            $name = $leader['name'];
                        endif;
                        $percentage = round(( (int) $leader['score'] / (int) $numquestions ) * 100);
                        echo '<li>' . $name. ': ' .  $percentage . '%</li>';
                        
                        $counter++;
                        
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div><!--container-->
<?php include 'footer.php'; ?>