<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/hangman.php";


    session_start();

    if (empty($_SESSION['hang'])) {
      $_SESSION['hang'] = array();
    }

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        $message = "message works";
        return $app['twig']->render('homeView.html.twig', array('hang' => Hang::getAll(), "message"=>$message));
    });

    $app->post("/guess", function() use ($app) {
        $guess = $_POST['userGuess'];
        Hang::submitGuess($guess);
        return $app->redirect("/");
    });

    $app->post("/new", function() use ($app) {
        $hang = new Hang("test", false, array("work","please"), "help", array("_","_","_","_"), 6, 0);
        $hang->save();
        return $app->redirect('/');
    });

    $app->post("/delete", function() use ($app) {
        Hang::deleteAll();
        return $app['twig']->render('test.html.twig');
    });


    return $app;
?>
