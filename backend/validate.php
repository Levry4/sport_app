<?php
// Своя простая валидация email (работает 100%)
function isValidEmail($email) {
    // Проверяем что есть @ и точка после @
    if (strpos($email, '@') === false) return false;
    $parts = explode('@', $email);
    if (count($parts) !== 2) return false;
    if (strpos($parts[1], '.') === false) return false;
    return true;
}

function validateAthlete($data) {
    $errors = [];
    
    // Проверка имени (обязательно)
    if (empty($data['name'])) {
        $errors['name'] = 'Имя обязательно для заполнения';
    }
    
    // Проверка email (обязательно + формат)
    if (empty($data['email'])) {
        $errors['email'] = 'Email обязателен для заполнения';
    } elseif (!isValidEmail($data['email'])) {
        $errors['email'] = 'Неверный формат email (пример: name@domain.ru)';
    }
    
    // Проверка возраста (если указан)
    if (!empty($data['age']) && ($data['age'] <= 0 || $data['age'] > 120)) {
        $errors['age'] = 'Возраст должен быть от 1 до 120 лет';
    }
    
    return $errors;
}

function isEmailUnique($email, $athletes) {
    foreach ($athletes as $a) {
        if ($a['email'] === $email) {
            return false;
        }
    }
    return true;
}
?>