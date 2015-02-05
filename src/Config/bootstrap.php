<?php
require __DIR__ . '/../../vendor/autoload.php';
use TimeCardMD\Session\Storage\Session As SessionStorage;
use TimeCardMD\Session\Manager as SessionManager;
use TimeCardMD\Model\Persistence\TimeCardDateSession;
use TimeCardMD\Model\Entity\TimeCardDate as TimeCardDateEntity;
use TimeCardMD\Model\TimeCardDate;

$config = require 'app.config.php';
date_default_timezone_set($config['date_default_timezone']);

$app = new \Slim\Slim(array(
    'templates.path' => $config['template_path'],
));

// Container
$app->container->singleton('log', function () use($config){
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler($config['log_file'], \Monolog\Logger::DEBUG));
    return $log;
});
$app->container->singleton('Session', function () {
    $obj = new SessionManager(new SessionStorage);
    return $obj;
});
$app->container->singleton('TimeCardDate', function () use($app) {
    $Persistence = new TimeCardDateSession($app->Session);
    $TimeCardDate = new TimeCardDate($Persistence);
    return $TimeCardDate;
});

// Define routes
$app->get('/', function () use ($app) {
    $app->view->setData(
        array(
            'timeCard' => $app->TimeCardDate->findAll()
        )
    );
    $app->log->info("Slim-Skeleton '/' route");
    // Render index view
    $app->render('/TimeSheet/index.php');
});

$app->post('/timecard/:year/:month/:day', function ($year, $month, $day) use ($app) {
    print_r(func_get_args());
    // Sample log message
    echo '/timecard/2014/1/10';
    $app->log->info("Slim-Skeleton 'timecard/:year/:month/:day' route");
    // Render index view
    $app->render('/TimeSheet/index.php');
});
// Run app
$app->run();