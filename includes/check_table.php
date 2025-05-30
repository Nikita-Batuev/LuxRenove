<?php
require_once 'db.php';

try {
    // Проверяем структуру таблицы
    $stmt = $pdo->query("DESCRIBE promotions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Структура таблицы promotions:\n";
    foreach ($columns as $column) {
        echo "Поле: " . $column['Field'] . "\n";
        echo "Тип: " . $column['Type'] . "\n";
        echo "Null: " . $column['Null'] . "\n";
        echo "Key: " . $column['Key'] . "\n";
        echo "Default: " . $column['Default'] . "\n";
        echo "Extra: " . $column['Extra'] . "\n\n";
    }

    // Проверяем данные в таблице
    $stmt = $pdo->query("SELECT * FROM promotions");
    $promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Данные в таблице:\n";
    foreach ($promotions as $promo) {
        echo "ID: " . $promo['id'] . "\n";
        echo "Название: " . $promo['title'] . "\n";
        echo "Статус: " . $promo['status'] . "\n";
        echo "Дата начала: " . $promo['start_date'] . "\n";
        echo "Дата окончания: " . $promo['end_date'] . "\n";
        echo "-------------------\n";
    }

} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?> 