<?php
// Подключаем файлы
require_once 'data.php';
require_once 'auth.php';
require_once 'validate.php';

// CORS
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Сессия
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Получаем параметры
$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// ===== РОУТИНГ =====

// Вход
if ($action === 'login' && $method === 'POST') {
    require_once 'handlers/login.php';
    exit();
}

// Выход
if ($action === 'logout' && $method === 'POST') {
    require_once 'handlers/logout.php';
    exit();
}

// Проверка сессии
if ($action === 'check' && $method === 'GET') {
    require_once 'handlers/check.php';
    exit();
}

// Получить всех спортсменов
if ($action === 'athletes' && $method === 'GET') {
    require_once 'handlers/get_all.php';
    exit();
}

// Получить одного спортсмена
if ($action === 'athlete' && $method === 'GET') {
    require_once 'handlers/get_one.php';
    exit();
}

// Создать спортсмена
if ($action === 'create' && $method === 'POST') {
    require_once 'handlers/create.php';
    exit();
}

// Добавить тренировку
if ($action === 'add_training' && $method === 'GET') {
    require_once 'handlers/add_training.php';
    exit();
}

// Если ничего не подошло
http_response_code(404);
echo json_encode(['error' => 'Не найдено']);
?>