<?php
checkAuth(); // только для авторизованных
echo json_encode(['success' => true, 'data' => $athletes]);
?>