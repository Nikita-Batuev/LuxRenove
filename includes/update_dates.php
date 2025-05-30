<?php
require_once 'db.php';

try {
    // Обновляем даты для всех акций
    $stmt = $pdo->prepare("
        UPDATE promotions 
        SET start_date = CURDATE(),
            end_date = DATE_ADD(CURDATE(), INTERVAL 30 DAY),
            status = 'active'
    ");
    
    $stmt->execute();
    
    echo "Даты акций успешно обновлены!\n";
    
    // Проверяем результат
    $stmt = $pdo->query("SELECT * FROM promotions");
    $promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($promotions as $promo) {
        echo "Акция ID: " . $promo['id'] . "\n";
        echo "Название: " . $promo['title'] . "\n";
        echo "Дата начала: " . $promo['start_date'] . "\n";
        echo "Дата окончания: " . $promo['end_date'] . "\n";
        echo "Статус: " . $promo['status'] . "\n";
        echo "-------------------\n";
    }

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?> 