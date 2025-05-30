<?php
$host = 'localhost';
$username = 'root';
$password = '';

try {
    // Подключаемся к MySQL без выбора базы данных
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Создаем базу данных, если она не существует
    $pdo->exec("CREATE DATABASE IF NOT EXISTS luxrenove");
    $pdo->exec("USE luxrenove");

    // Создаем таблицу promotions, если она не существует
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS promotions (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            discount_value VARCHAR(50) NOT NULL,
            start_date DATE NOT NULL,
            end_date DATE NOT NULL,
            image VARCHAR(255),
            conditions TEXT,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            status ENUM('active', 'inactive') DEFAULT 'active'
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");

    // Проверяем, есть ли данные в таблице
    $stmt = $pdo->query("SELECT COUNT(*) FROM promotions");
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // Добавляем тестовые данные
        $pdo->exec("
            INSERT INTO promotions (title, description, discount_value, start_date, end_date, image, conditions) VALUES
            ('Ремонт под ключ со скидкой 20%', 
            'Полный комплекс ремонтных работ с максимальной скидкой. Включает все этапы от черновой отделки до финишного декора.',
            '20%',
            '2024-03-01',
            '2024-04-30',
            'assets/images/promotions/remont-sale.jpg',
            'Акция действует при заказе ремонта от 50м². Скидка не распространяется на материалы.'),

            ('Бесплатный дизайн-проект', 
            'При заказе ремонта под ключ дизайн-проект в подарок! Создадим уникальный интерьер специально для вас.',
            '100%',
            '2024-03-01',
            '2024-05-31',
            'assets/images/promotions/design-free.jpg',
            'Акция действует при заказе ремонта от 100м². Дизайн-проект включает 3D-визуализацию и подбор материалов.')
        ");
    }

    echo "База данных успешно инициализирована!";
} catch(PDOException $e) {
    die("Ошибка: " . $e->getMessage());
}
?> 