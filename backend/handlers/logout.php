<?php
session_destroy(); // уничтожаем сессию
echo json_encode(['success' => true]);
?>