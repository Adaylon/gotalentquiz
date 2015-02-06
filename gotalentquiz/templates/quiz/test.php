<?php include 'header.php'; ?>
<div id="container" class="quiz">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        <?php 
            if (! $session->get('last') ) : 
                $num = rand(1,25);
                $i = 0;
                $j = 0;
                $arrayNums = array();

                if($session->get('randQ') != null)
                {
                    $arrayNums = $session->get('randQ');
                    while($i == 0){
                        $j = 0;
                        $num = rand(1,25);
                        foreach ($arrayNums as $numQ) 
                        {
                            if($numQ == $num)
                            {
                                $j++;
                            }
                        } 
                        if($j > 0)
                        {
                            $i = 0;
                        }  
                        else
                        {
                            $i = 1;
                            array_push($arrayNums, $num);
                            $session->set('randQ', $arrayNums);
                        }
                    }
                }
                else{
                    array_push($arrayNums, $num);
                    $session->set('randQ', $arrayNums);
                }

                $question = $quiz->getQuestion($num);
                $answers = $quiz->getAnswers($num);
            ?>
            <?php if ($requireauth) : ?>
                <h4>Participante: <strong><?php echo $user->getName(); ?></strong></h4>
            <?php endif; ?>
            <h2>Questão <?php echo count($_SESSION['randQ']); ?>:</h2>
            <p><?php echo $question->getText(); ?></p>
            <form id="questionBox" method="post" action="<?php echo $root; ?>/quiz/process">
                <ul>
                <?php 
                $shuffledAnswers = shuffle_assoc($answers);

                $acount = 0;
                foreach ($shuffledAnswers as $answer) 
                {
                    echo '<li><input type="radio" id="answer' . $acount . '" value="' . $answer . '" name="answers" />' .PHP_EOL;
                    echo '<label for="answer' . $acount . '">' . $answer . '</label></li>' . PHP_EOL;
                    $acount++;
                }
                ?>
                </ul>
            <p>
                <input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />
                <input type="hidden" name="num" value="<?php echo $num; ?>" />
                <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                <input type="submit" id="submit" class="btn btn-primary" onclick="esconde_botao()" name="submit" value="Enviar" />
            </p>
        </form>
        <?php
            /**
             * @todo extract following into helper function
             */
        else :
            $timeportions = explode(':', $timetaken);
            $mins = $timeportions[0] == '00' ? '' : ltrim($timeportions[0],'0') . ' mins ';
            $secs = $timeportions[1] . ' secs' ;
            $percentage = round(( (int) $session->get('score') / (int) $quiz->countQuestions() ) * 100);
            echo '<div id="finalscore">';
            //$user = $requireauth ? $user : "";
            echo '<h2 id="score">' . $user->getName() . ' respondeu ' . $session->get('score') . ' correta(s) de ' .
                $quiz->countQuestions() . ' possíveis. </h2>' . PHP_EOL;
            echo '<h2 class="userscore">' .  $percentage . '%</h2>' . PHP_EOL;
            echo '<h3 id="time">Tempo: ' . $mins.$secs . '</h3>' . PHP_EOL;

            echo '<p id="compare"><a href="'. $root . '/quiz/' . $quiz->getId() . '/results">Continuar!</a></p>';
            echo '</div>';
        endif;
        ?>
        </div>
    </div>
</div><!--container-->
<?php include 'footer.php'; ?>
<script type="text/javascript">
<!--
function esconde_botao()
{
 submit.style.display = "none";
}
//-->
</script>