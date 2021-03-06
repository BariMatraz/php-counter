<?php

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers
$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  $file = file("count.txt");
  $count = implode("", $file);
  $count++;
  if ($count < 450) $count = 450;
  $myfile = fopen("count.txt","w");
  fputs($myfile,$count);
  fclose($myfile);
  return $app['twig']->render('index.twig', array('count' => $count));
});

$app->run();
