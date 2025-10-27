<?php
// public/index.php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

$uri = strtok($_SERVER['REQUEST_URI'], '?');

$routes = [
    '/' => 'layout.twig',
    '/home' => 'layout.twig',
    '/auth/login' => 'auth/login.twig',
    '/auth/signup' => 'auth/signup.twig',
    '/dashboard' => 'dashboard.twig', 
    '/logout' => 'logout.twig' ,
   '/tickets' => 'ticket.twig' 
];

$template = $routes[$uri] ?? null;

if (!$template) {
    http_response_code(404);
    echo $twig->render('404.twig', ['title' => 'Page not found']);
    exit;
}

echo $twig->render($template, [
    'title' => 'Ticket Dashboard'
]);
