<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($name && $email && $password) {
        // Simulate registration success
        $_SESSION['user'] = [
            'name' => $name,
            'email' => $email
        ];
        header('Location: /');
        exit;
    }

    $error = 'All fields are required.';
}

echo $twig->render('auth/signup.twig', [
    'title' => 'Sign Up | Ticket Dashboard',
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null
]);
