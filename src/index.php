<?php // demoRouting/src/index.php

require_once __DIR__ . '/../vendor/autoload.php';
require_once 'controllers/main_controller.php';
require_once 'controllers/users_controller.php';
require_once 'controllers/results_controller.php';

use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

// look inside *this* directory
$locator = new FileLocator(array(__DIR__));
$loader  = new YamlFileLoader($locator);
$routes  = $loader->load('rutas.yml');

$context = new RequestContext(filter_input(INPUT_SERVER, 'REQUEST_URI'));

$matcher = new UrlMatcher($routes, $context);

$path_info = filter_input(INPUT_SERVER, 'PATH_INFO') ?? '/';

try {
  $parameters = $matcher->match($path_info);
  $accion = $parameters['_controller'];
  $accion();
} catch (ResourceNotFoundException $e) {
    echo 'Caught exception: The resource could not be found' . PHP_EOL;
} catch (MethodNotAllowedException $e) {
    echo 'Caught exception: the resource was found but the request method is not allowed'. PHP_EOL;
}
