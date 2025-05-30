<?php
require_once 'config.php';

// Проверяем наличие ID проекта
if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID проекта не указан']);
    exit;
}

$projectId = (int)$_GET['id'];

try {
    // Получаем основную информацию о проекте
    $stmt = $pdo->prepare("
        SELECT p.*, GROUP_CONCAT(pi.image_path ORDER BY pi.sort_order) as images
        FROM portfolio p
        LEFT JOIN portfolio_images pi ON p.id = pi.portfolio_id
        WHERE p.id = ? AND p.status = 'active'
        GROUP BY p.id
    ");
    $stmt->execute([$projectId]);
    $project = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$project) {
        http_response_code(404);
        echo json_encode(['error' => 'Проект не найден']);
        exit;
    }

    // Преобразуем строку с изображениями в массив
    $project['images'] = $project['images'] ? explode(',', $project['images']) : [];

    // Форматируем данные
    $project['area'] = number_format($project['area'], 0, '.', ' ');
    $project['created_at'] = date('d.m.Y', strtotime($project['created_at']));

    // Отправляем данные
    header('Content-Type: application/json');
    echo json_encode($project);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Ошибка при получении данных проекта']);
} 