<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        throw new Exception('ID услуги не указан');
    }

    $id = (int)$_GET['id'];
    
    $stmt = $pdo->prepare('SELECT * FROM services WHERE id = ? AND status = "active"');
    $stmt->execute([$id]);
    
    $service = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$service) {
        throw new Exception('Услуга не найдена');
    }

    echo json_encode([
        'success' => true,
        'service' => $service
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 