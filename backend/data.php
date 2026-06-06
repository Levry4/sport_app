<?php
$storageFile = __DIR__ . '/storage.json';

// Загрузка данных из файла
function loadData() {
    global $storageFile;
    if (file_exists($storageFile)) {
        $content = file_get_contents($storageFile);
        $data = json_decode($content, true);
        if ($data && isset($data['athletes'])) {
            return $data;
        }
    }
    // Начальные данные (добавлены поля login, password, role)
    return [
        'athletes' => [
            [
                'id' => 1, 
                'name' => 'Иван Петров', 
                'email' => 'ivan@example.com',
                'login' => 'ivan@example.com',
                'password' => '123',
                'role' => 'admin',
                'age' => 25, 
                'sport_type' => 'Футбол', 
                'rank' => 'КМС', 
                'team' => 'Спартак', 
                'trainings_count' => 45, 
                'bookings' => []
            ],
            [
                'id' => 2, 
                'name' => 'Мария Сидорова', 
                'email' => 'maria@example.com',
                'login' => 'maria@example.com',
                'password' => '123',
                'role' => 'coach',
                'age' => 22, 
                'sport_type' => 'Теннис', 
                'rank' => '1 разряд', 
                'team' => 'Динамо', 
                'trainings_count' => 38, 
                'bookings' => []
            ],
            [
                'id' => 3, 
                'name' => 'Алексей Смирнов', 
                'email' => 'alex@example.com',
                'login' => 'alex@example.com',
                'password' => '123',
                'role' => 'user',
                'age' => 30, 
                'sport_type' => 'Плавание', 
                'rank' => 'МС', 
                'team' => 'Локомотив', 
                'trainings_count' => 62, 
                'bookings' => []
            ],
        ],
        'nextId' => 4,
        'users' => [] // больше не нужны, используем спортсменов
    ];
}

// Сохранение данных в файл
function saveData($data) {
    global $storageFile;
    file_put_contents($storageFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Загружаем данные
$db = loadData();
$athletes = &$db['athletes'];
$nextId = $db['nextId'];

function saveAthletes($newAthletes) {
    global $db, $nextId;
    $db['athletes'] = $newAthletes;
    $db['nextId'] = $nextId;
    saveData($db);
}

function getNextId() { global $nextId; return $nextId; }
function incrementNextId() { global $nextId, $db; $nextId++; $db['nextId'] = $nextId; saveData($db); }
?>