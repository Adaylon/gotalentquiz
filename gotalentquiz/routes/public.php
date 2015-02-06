<?php
$app->get('/', function () use ($app) {
    $simple = $app->simple;
    $quizzes = $simple->getQuizzes();
    $categories = $simple->getCategories();

    $session = $app->session;

    $app->render('index.php', array('quizzes' => $quizzes, 'categories' => $categories, 'session' => $session));
});

$app->get('/requirements/', function () use ($app) {
    
    $installer = $app->installer;
    $requirements = $installer->getRequirements();
    $simple = $app->simple;
    $categories = $simple->getCategories();
    
    $app->render('requirements.php', array( 'categories' => $categories,'requirements' => $requirements));
    
});

$app->get('/login/', function () use ($app) {

    $flash = $app->view()->getData('flash');
    $errors = isset($flash['errors']) ? $flash['errors'] : false;

    $simple = $app->simple;
    $quizzes = $simple->getQuizzes();
    $categories = $simple->getCategories();

    $session = $app->session;
    if ($session->get('user'))
    {
        $app->redirect($app->request->getRootUri() . '/');
    }

    $app->render('login.php', array('quizzes' => $quizzes, 'categories' => $categories, 'session' => $session,
                                    'errors' => $errors));
});

$app->post('/login/', function () use ($app) {

    $simple = $app->simple;
    $session = $app->session;
    $errors = array();

    $email = trim($app->request()->post('email'));
    $password = trim($app->request()->post('password'));

    //need to check for 'emptiness' of inputs and display message instead of querying db
    if ((! empty($email)) && (! empty($password) ) )
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['loginerror'] = "O endereço de e-mail inválido. Por favor, tente novamente.";
        }
        else
        {
            //pull details for this registered email
            if ($authsql = \ORM::for_table('users')->select_many('id','pass','name','level')->where('email',
                $email)->find_one())
            {
                //verify the password against hash
                if (! password_verify($password, $authsql->pass))
                {
                    $errors['loginerror'] = "O e-mail ou senha não coincidem com aqueles em nosso sistema. Por favor, tente novamente.";
                }
                else
                {
                    if ($authsql->level == 1)
                    {
                        //we have an admin user
                        $user = new \SimpleQuiz\Utils\User\AdminUser($email, $authsql->name, null);
                    }
                    else
                    {
                        //registered user
                        $user = new \SimpleQuiz\Utils\User\EndUser($email, $authsql->name, null);
                    }

                    $user->setId($authsql->id);

                    $session->set('user', $user);
                    $session->regenerate();
                }
            }
            else
            {
                $errors['loginerror'] = "O e-mail ou senha não coincidem com aqueles em nosso sistema. Por favor, tente novamente.";
            }
        }
    }
    else
    {
        $errors['loginerror'] = "Por favor, verifique o seu endereço de e-mail e senha e tente novamente.";
    }

    if (count($errors) > 0)
    {
        $app->flash('errors', $errors);
        $session->remove('user');
        $app->redirect($app->request->getRootUri() . '/login/');
    }

    $simple::redirect($app, $session);
});

$app->post('/register/', function () use ($app) {

    $simple = $app->simple;
    $session = $app->session;
    $errors = array();

    $username = trim($app->request()->post('username'));
    $email = trim($app->request()->post('email'));
	$idcampuseiro = trim($app->request()->post('idcampuseiro'));
    $password = trim($app->request()->post('regpassword'));
    $confpassword = trim($app->request()->post('regpasswordconf'));

    //need to check for 'emptiness' of inputs and display message instead of querying db
    if ((! empty($email)) && (! empty($password) ) && ($password == $confpassword) )
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['registererror'] = "O endereço de e-mail inválido. Por favor, tente novamente.";
        }
        else
        {
            $user = new \SimpleQuiz\Utils\User\EndUser($email, $username, $idcampuseiro);
            $user->setPassword(password_hash($password,1));

            try
            {
                $user = $simple->registerUser($user);
                $session->set('user', $user);
                $session->regenerate();

                $headers = "MIME-Version: 1.1\r\n";
                $headers .= "Content-type: text/html; charset=utf-8\r\n";
                $headers .= "From:  contato@gotalent.besaba.com\r\n"; // remetente
                $headers .= "Return-Path: ".$email." \r\n"; // return-path
                $envio = mail($email, 'Usuário registrado no Go Talent Quiz', 'Acesse: http://www.gotalent.com.br/quiz/ <br /><br /> Login: '.$email.'<br /> Usuário: '.$username.'<br /> Senha: '.$password, $headers);
            }
            catch (\SimpleQuiz\Utils\Exceptions\RegisterException $e)
            {
                $errors['registererror'] = $e->getMessage();
            }
        }
    }
    else
    {
        $errors['registererror'] = "Houve um erro com seu nome de usuário ou senha. Por favor, tente novamente.";
    }

    if (count($errors) > 0)
    {
        $app->flash('errors', $errors);
        $session->remove('user');
        $app->redirect($app->request->getRootUri() . '/login/');
    }

    $simple::redirect($app, $session);
});

$app->get('/categories/', function () use ($app) {
    $simple = $app->simple;
    $quizzes = $simple->getQuizzes(true);
    $categories = $simple->getCategories();

    $session = $app->session;

    $app->render('index.php', array('quizzes' => $quizzes, 'categories' => $categories, 'session' => $session));
});

$app->get('/categories/:id', function ($id) use ($app) {
    $simple = $app->simple;
    $category = $simple->getCategory($id);
    $quizzes = $simple->getCategoryQuizzes($id);
    $categories = $simple->getCategories();

    $session = $app->session;
    if( $category )
    {
        $app->render('category.php', array('category' => $category, 'quizzes' => $quizzes, 'categories' => $categories, 'session' => $session));
    }
    else
    {
        $quizzes = $simple->getQuizzes(true);
        $app->render('index.php', array('quizzes' => $quizzes, 'categories' => $categories, 'session' => $session));
    }
})->conditions(array('id' => '\d+'));

$app->get('/quiz/:id/', function ($id) use ($app) {
    
    $flash = $app->view()->getData('flash'); 
    $error = null;

    if (isset($flash['usererror'])) {
        $error = $flash['usererror'];
    }
    if (isset($flash['quizerror'])) {
        $error = $flash['quizerror'];
    }
    
    $quiz = $app->quiz;

    $session = $app->session;
    
    $simple = $app->simple;
    $categories = $simple->getCategories();

    if ($quiz->setId($id)) {
        /**
         * @todo remove all session shite below and store in db
         */
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('quizid', $id);
        $session->set('score', 0);
        $session->set('correct', array());
        $session->set('wrong', array());
        $session->set('finished', 'no');
        $session->set('num', 0);
        $session->set('last', null);
        $session->set('timetaken', null);
        $session->set('starttime', null);

        $app->render('quiz/quiz.php', array('quiz' => $quiz, 'categories' => $categories, 'session' => $session, 'error' => $error));
    } else {
        $app->flashnow('quizerror','Ocorreu um erro . Por favor, retorne ao menu principal tente novamente');
        $app->render('quiz/error.php', array( 'categories' => $categories,'session' => $session));
    }
})->conditions(array('id' => '\d+'));

$app->post('/quiz/process/', $authenticate($app), function () use ($app) {

    $simple = $app->simple;
    $id = $app->request()->post('quizid');
    $starter = $app->request()->post('starter');

    if (! ctype_digit($id)) {
        $app->redirect($app->request->getRootUri().'/');
    }

    $session = $app->session;

    if (isset($starter)) //beginning of the quiz
    {
        if ($simple->quizUserExists($id, $session->get('user')->getId()))
        {
            $app->flash('quizerror', "Você já participou desse quiz!");
            $app->redirect($app->request->getRootUri() . '/quiz/' . $id);
        }
        $session->set('score', 0);
        $session->set('correct', array());
        $session->set('wrong', array());
        $session->set('finished', 'no');
        $session->set('num', 0);
        $session->set('starttime', date('Y-m-d H:i:s'));
        $session->set('randQ',array());

        $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
    }
    else
    { //quiz logic

        /**
         * @todo check if serialised quiz exists in session before instantiating new
         */
        //    if ($session->get('quiz'))
        //    {
        //        $quiz = unserialize($session->get('quiz'));
        //    }
        //    else{
        //        $quiz = $app->quiz;
        //    }
        $quiz = $app->quiz;

        $simple = $app->simple;
        $categories = $simple->getCategories();

        if ($quiz->setId($id))
        {

            $quiz->populateUsers();

            $num = $app->request()->post('num');
            $answers = $app->request()->post('answers');

            $nonce = $app->request()->post('nonce');

            //check for a valid nonce to prevent cached submissions e.g (back button)
            if ($session->get('nonce') != $nonce)
            {
                $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
            }

            $quiz->populateQuestions();
            $quiz->populateUsers();
            $session->set('num', (int) $num);

            $numquestions = $quiz->countQuestions();
            $quizanswers = $quiz->getAnswers($num);

            if ($answers == $quizanswers[0])
            { //first answer in array is correct one
                $score = $session->get('score');
                $score++;
                $session->set('score', $score);
                $_SESSION['correct'][ $num ] = array($answers);
            } else
            {
                $_SESSION['wrong'][ $num ] = array($answers);
            }
            if (count($_SESSION['randQ']) < $numquestions)
            {
                $_SESSION['num']++;
            } else
            {
                $_SESSION['last'] = true;
                $_SESSION['finished'] = 'yes';
            }
            $app->redirect($app->request->getRootUri() . '/quiz/' . $id . '/test');
        } else
        {
            $app->flashnow('quizerror', 'There has been an error. Please return to the main quiz menu and try again');
            $app->render('quiz/error.php', array('categories' => $categories, 'session' => $session));
        }
    }
});

$app->get('/quiz/:id/test/', $authenticate($app), function ($id) use ($app) {

    $session = $app->session;
    
    $simple = $app->simple;
    $categories = $simple->getCategories();

    if ( $session->get('quizid') !== $id) {
        $app->flashnow('quizerror','Ocorreu um erro . Por favor, retorne ao menu principal e tente novamente');
        $app->render('quiz/error.php', array( 'categories' => $categories,'session' => $session));
        $app->stop();
    }
    
    $quiz = $app->quiz;
    /**
     * @todo implement serialize() on quiz object and store in session
     */
    if ($quiz->setId($id)) {
        $quiz->populateQuestions()->populateUsers();

        $timetaken = '';
        
        $nonce = md5(uniqid());
        $session->set('nonce', $nonce);

        $num = $session->get('num') ? $session->get('num') : 1;

        if (isset($_SESSION['last']) && $_SESSION['last'] == true) {
            
            $session->set('nonce', null);
            
            //first two vars formatted for insertion into database as datetime fields
            $starttime = $session->get('starttime');
            $endtime = date('Y-m-d H:i:s');

            //store $timetaken in session
            if (!isset($_SESSION['timetaken'])) {
                $end = time();
                $start = strtotime($starttime);
                $time = $end - $start;
                $timetaken = date("i:s", $time); //formatted as minutes:seconds
                $_SESSION['timetaken'] = $timetaken;
                if (SimpleQuiz\Utils\Base\Config::$requireauth) {
                    $quiz->addQuizTaker($session->get('user'), $session->get('score'), $starttime, $endtime,
                        $timetaken);
                }
            } else {
                $timetaken = $_SESSION['timetaken'];
            }
        }

        $app->render('quiz/test.php', array('quiz' => $quiz, 'num' => $num, 'nonce' => $nonce, 'timetaken' => $timetaken, 'categories' => $categories, 'session' => $session));
    } else {
        $app->flashnow('quizerror','O teste que você selecionou não existe. Volte ao menu principal para tentar novamente.');
        $app->render('quiz/error.php', array( 'categories' => $categories,'session' => $session));
        $app->stop();
    }
})->conditions(array('id' => '\d+'));

$app->get('/quiz/:id/results/', function ($id) use ($app) {

    $quiz = $app->quiz;

    $session = $app->session;
    
    $simple = $app->simple;
    $categories = $simple->getCategories();
    
    if ($session->get('finished') != 'yes') {
        $app->redirect($app->request->getRootUri().'/');
    }

    if ($session->get('quizid') !== $id) {
        $app->flashnow('quizerror','Ocorreu um erro . Por favor, retorne ao menu principal e tente novamente.');
        $app->render('quiz/error.php', array('quiz' => $quiz, 'categories' => $categories, 'session' => $session));
        $app->stop();
    }

    if ($quiz->setId($id)) {
        $quiz->populateQuestions();
        $quiz->populateUsers();
        $session->set('last', null);

        $app->render('quiz/results.php', array('quiz' => $quiz, 'categories' => $categories, 'session' => $session));
    } else {
        $app->flashnow('quizerror','O teste que você selecionou não existe. Volte ao menu principal para tentar novamente.');
        $app->render('quiz/error.php', array('quiz' => $quiz, 'categories' => $categories, 'session' => $session));
        $app->stop();
    }
})->conditions(array('id' => '\d+'));