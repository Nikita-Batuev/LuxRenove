<?php
require_once 'db.php';

// Проверяем наличие ID
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID акции не указан']);
    exit;
}

try {
    // Получаем данные акции
    $stmt = $pdo->prepare('
        SELECT * FROM promotions 
        WHERE id = ? AND status = "active" 
        AND start_date <= CURDATE() 
        AND end_date >= CURDATE()
    ');
    $stmt->execute([$_GET['id']]);
    $promo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$promo) {
        http_response_code(404);
        echo json_encode(['error' => 'Акция не найдена или неактивна']);
        exit;
    }

    // Форматируем даты
    $promo['start_date'] = date('Y-m-d', strtotime($promo['start_date']));
    $promo['end_date'] = date('Y-m-d', strtotime($promo['end_date']));

    // Отправляем данные
    echo json_encode([
        'success' => true,
        'promo' => $promo
    ]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка при получении данных']);
} 