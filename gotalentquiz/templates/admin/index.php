<?php
include'header.php';
?>
<div id="container" class="quiz">
      <div class="row">
          <div id="intro" class="col-md-8 col-md-offset-2">
              <?php if (isset($flash['success'])) { echo '<div id="updater" class="alert alert-success">'.$flash["success"].'</div>'; } ?>
              <?php if (isset($flash['error'])) { echo '<div id="updater" class="alert alert-danger">'.$flash["error"].'</div>'; } ?>
              <div id="ajaxupdater" class="alert"></div>
          <h4>Bem vindo Quizmaster!</h4>
          <p>Seja cuidadoso; com grandes poderes vem a grande responsabilidade</p>
          <h4>Quizzes - <a href="ranking/">Gerenciar Pontuação Geral</a></h4>
          <?php if (count($quizzes) > 0): ?>
            <table id="quizzes" class="table table-striped">
                <thead>
                    <tr><th>Nome</th><th>Descrição</th><th>Categoria</th><th>Ativo</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($quizzes as $quiz) :
                            $activeSpan = $quiz->active == 1 ? 'glyphicon-ok-circle' : 'glyphicon-remove-circle';
                            echo '<tr class="quiz"><td><strong><a href="'. $root .'/admin/quiz/'. $quiz->id .'">' . $quiz->name. '</a></strong></td><td>'.$quiz->description.'</td><td>'.$quiz->category.'</td><td><span class="glyphicon '.$activeSpan.'"></span></td><td><a href="'. $root .'/admin/quiz/'. $quiz->id .'" data-quiz-id="'.$quiz->id.'" title="Edit Questions" class="edit btn btn-default btn-primary"><span class="glyphicon glyphicon-pencil"></span></a> <button data-quiz-id="'.$quiz->id.'" title="Delete Quiz" class="remove btn btn-default btn-danger" type="button"><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                        endforeach;
                    ?>
                </tbody>
            </table>
          <?php else: ?>
          <p>Não existem testes no momento. Por que não criar um agora?</p>
          <p>Basta clicar no botão "Adicionar" abaixo...</p>
          <?php endif; ?>
            <p>
                <button id="addquiz" title="Add New Quiz" type="button" class="btn btn-primary pull-right">Add <span class="glyphicon glyphicon-plus-sign"></span></button>
            </p>
        </div>
      </div><!-- /.row -->
        
    </div><!--container-->
    
    <!-- Add Quiz Modal -->
    <div class="modal fade" id="quiz-add-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add um novo Quiz:</h4>
          </div>
            <form id="quizadd" method="post" action="<?php echo $root . '/admin/quiz/'; ?>">
            <div class="modal-body">
                <p><label for="quizname">Nome Quiz:</label>
                   <input name="quizname" id="quizname" type="text" placeholder="Quiz Name" class="form-control" />
                   <span class="helper help-block">Por favor, forneça um nome para o quiz</span>
                </p>
                <p><label for="description">Descrição Quiz:</label>
                   <input name="description" id="description" type="text" placeholder="Quiz Description" class="form-control" />
                </p>
                <p><label for="category">Categoria Quiz:</label>
                   <select name="category" id="category" class="form-control">
                       <?php foreach ($categories as $category) : ?>
                            <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
                       <?php endforeach; ?>
                   </select>
                </p>
                <h4>Ativo?</h4>
                <p><label for="quizactiveyes"> Sim: </label>
                   <input name="active" id="quizactiveyes" value="1" type="radio" class="form-control radio-inline" />
                   <label for="quizactiveno"> Não: </label>
                   <input name="active" id="quizactiveno" value="0" type="radio" class="form-control radio-inline" />
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-success">Criar Quiz</button>
            </div>
            </form>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <?php include 'footer.php'; ?>