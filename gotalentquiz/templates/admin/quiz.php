<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
            <div id="intro" class="col-md-8 col-md-offset-2">
                 <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
                 <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
                <div id="ajaxupdater" class="alert"></div>
                <div><a class="btn btn-primary" href="<?php echo $root; ?>/admin/"><span class="glyphicon glyphicon-arrow-left"></span> Voltar para todos os Quizzes</a></div>
                <br />
                <div class="panel panel-default">
                    <!-- Default panel contents -->
                    <div class="panel-heading"><h3>Detalhes do Quiz:</h3></div>
                    <div class="panel-body">
                      <ul style="width:50%;" class="list-group">
                          <li class="list-group-item"><strong>Nome</strong>: <?php echo $quiz->getName(); ?></li>
                          <li class="list-group-item"><strong>Descrição</strong>: <?php echo $quiz->getDescription(); ?></li>
                          <li class="list-group-item"><strong>Categoria</strong>: <?php echo $quiz->getCategory(); ?></li>
                          <li class="list-group-item"><strong>Ativo? </strong><?php echo $quiz->isActive() ? '<span class="glyphicon glyphicon-ok">' : '<span class="glyphicon glyphicon-remove-circle">' ?></li>
                          <li class="list-group-item"><strong>Número de questões</strong>: <span class="badge"><?php
                                  echo $quiz->countQuestions(); ?></span></li>
                          <li class="list-group-item"><strong>Tempo</strong>: <span class="badge"><?php echo count($quiz->getUsers()); ?></span></li>
                      </ul>
                        <button id="editquiz" title="Edit Quiz Details" type="button" class="btn btn-primary">Editar detalhes do Quiz <span class="glyphicon glyphicon-pencil"></span></button>
                    </div>
                  <div class="panel-heading"><h3>Questões:</h3></div>
                    <!-- Table -->
                    <table id="questions" class="table table-striped table-responsive">
                          <thead>
                              <tr>
                                  <th>Questão</th><th>Ação</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php
                              foreach ($quiz->getQuestions() as $question) :?>
                              <tr class="question">
                                  <td class="question"><?php echo $question->getText(); ?></td>
                                  <td style="text-align:center;">
                                      <button data-question-id="<?php echo $question->getNum(); ?>" title="Edit
                                      Question" class="edit btn btn-default btn-primary" type="button"><span class="glyphicon glyphicon-pencil"></span></button>
                                      <a href="<?php echo $root; ?>/admin/quiz/<?php echo $quiz->getId();
                                      ?>/question/<?php echo $question->getNum(); ?>/edit/" title="Edit Answers"
                                         class="answerlink btn btn-default btn-primary"><span class="glyphicon glyphicon-list"></span></a>
                                      <button data-question-id="<?php echo $question->getNum(); ?>" data-quiz-id="<?php
                                      echo $quiz->getId(); ?>" title="Delete Question" class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                  </td>
                              </tr>
                              <?php endforeach; ?>  
                          </tbody>
                      </table>
                      <div class="panel-body">
                          <button id="addquestion" title="Add New Question" type="button" class="btn btn-primary pull-right">Add Questão <span class="glyphicon glyphicon-plus-sign"></span></button>
                      </div>
                </div>
            </div>
            </div><!-- /.row -->
        
</div><!--container-->
<!-- Modals -->
<!-- Edit Question Modal -->
    <div class="modal fade" id="qmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Editar Questão:</h4>
          </div>
            <form id="questionedit" method="post" action="">
            <div class="modal-body">
                <p>
                   <input name="questiontext" id="questioninput" type="text" class="form-control" />
                   <input name="questionid" id="questionid" type="hidden" />
                   <input type="hidden" name="_METHOD" value="PUT" />
                   <span class="helper help-block">Pergunta não pode ser vazia!.</span>
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button id="savetext" type="submit" class="btn btn-primary">Salvar</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
<!-- Add Question Modal -->
    <div class="modal fade" id="q-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add uma nova questão:</h4>
          </div>
            <form id="questionadd" method="post" action="">
            <div class="modal-body">
                <p><label for="newquestioninput">Questão:</label>
                   <input name="questiontext" id="newquestioninput" type="text" placeholder="Your question here" class="form-control" />
                   <span class="helper help-block">Pergunta não pode ser vazia!</span>
                </p>
                <h5><strong>Resposta:</strong></h5>
                <table id="newanswers" class="table table-responsive table-hover table-bordered">
                    <thead>
                        <tr><th style="text-align: center;">Resposta correta?</th><th>Resposta</th></tr>
                    </thead>
                    <tbody>
                        <tr class="answer-row">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" value="0" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="answer[]" placeholder="Answer" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr class="answer-row">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" value="1" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                    <input type="text" name="answer[]" placeholder="Answer" class="form-control">
                                    <span class="input-group-btn">
                                        <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr class="template answer-row" style="display:none;">
                            <td style="text-align: center;">
                               <input class="correct" name="correct" type="radio" /> 
                            </td>
                            <td>
                                <div class="input-group">
                                <input type="text" placeholder="Answer" name="" value="" class="form-control answerinput">
                                <span class="input-group-btn">
                                    <button class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button>
                                </span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><button id="addanswer" type="button" class="btn btn-primary pull-right">Add outra resposta <span class="glyphicon glyphicon-plus-sign"></span></button></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Salvar questão</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
    <!-- Update Quiz Modal -->
    <div class="modal fade" id="quiz-edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Editar Quiz:</h4>
          </div>
            <form id="quizedit" method="post" action="<?php echo $root . '/admin/quiz/'; ?>">
            <div class="modal-body">
                <p><label for="quizname">Nome Quiz:</label>
                   <input name="quizname" id="quizname" type="text" placeholder="Quiz Name" class="form-control" value="<?php echo $quiz->getName(); ?>" />
                   <span class="helper help-block">Por favor, forneça um nome para o quiz</span>
                </p>
                <p><label for="description">Descrição Quiz:</label>
                   <input name="description" id="description" type="text" placeholder="Quiz Description" value="<?php echo $quiz->getDescription(); ?>" class="form-control" />
                </p>
                <p><label for="category">Categoria Quiz:</label>
                   <select name="category" id="category" class="form-control" />
                     <?php foreach ($categories as $category) : ?>
                           <?php $selected = ($category->name == $quiz->getCategory()) ? 'selected' : ''; ?>
                           <option value="<?php echo $category->id; ?>" <?php echo $selected; ?>><?php echo $category->name; ?></option>
                       <?php endforeach; ?>
                   </select>
                </p>
                <h4>Ativo?</h4>
                <p><label for="quizactiveyes"> Sim: </label>
                   <input name="active" id="quizactiveyes" value="1" <?php if ($quiz->isActive()) { echo 'checked';} ?> type="radio" class="form-control radio-inline" />
                   <label for="quizactiveno"> Não: </label>
                   <input name="active" id="quizactiveno" value="0" <?php if (! $quiz->isActive()) { echo 'checked';} ?> type="radio" class="form-control radio-inline" />
                   <input type="hidden" name="_METHOD" value="PUT" />
                   <input type="hidden" name="quizid" value="<?php echo $quiz->getId(); ?>" />
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Salvar</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
<?php include 'footer.php'; ?>