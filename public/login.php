<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

session_start();

$loader = new FilesystemLoader(__DIR__ . '/../templates');
$twig = new Environment($loader);

echo $twig->render('auth/login.twig', ['title' => 'Login']);
{
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Dummy login (replace with DB check)
    if ($email === 'demo@example.com' && $password === 'password') {
        $_SESSION['user'] = [
            'name' => 'Demo User',
            'email' => $email
        ];
        header('Location: /');
        exit;
    }

    $error = 'Invalid email or password.';
}

echo $twig->render('auth/login.twig', [
    'title' => 'Login | Ticket Dashboard',
    'error' => $error ?? null,
    'user' => $_SESSION['user'] ?? null
]);
