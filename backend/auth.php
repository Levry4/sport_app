<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function checkAuth() {
    if (!isset($_SESSION['user'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Не авторизован']);
        exit();
    }
    return $_SESSION['user'];
}

function checkAdmin() {
    $user = checkAuth();
    if ($user['role'] !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Доступ запрещён']);
        exit();
    }
    return true;
}

// Аутентификация среди спортсменов
function authenticate($login, $password) {
    global $athletes;
    foreach ($athletes as $a) {
        if (isset($a['login']) && $a['login'] === $login && $a['password'] === $password) {
            return [
                'login' => $a['login'],
                'role' => $a['role'],
                'name' => $a['name'],
                'email' => $a['email']
            ];
        }
    }
    return null;
}
?>