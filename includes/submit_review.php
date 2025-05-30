<?php
require_once 'db.php';

header('Content-Type: application/json');

try {
    // Проверяем метод запроса
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Неверный метод запроса');
    }

    // Получаем и проверяем данные
    $name = trim($_POST['name'] ?? '');
    $project = trim($_POST['project'] ?? '');
    $rating = (int)($_POST['rating'] ?? 0);
    $text = trim($_POST['text'] ?? '');

    // Валидация данных
    if (empty($name)) {
        throw new Exception('Пожалуйста, укажите ваше имя');
    }

    if (empty($project)) {
        throw new Exception('Пожалуйста, укажите название проекта');
    }

    if ($rating < 1 || $rating > 5) {
        throw new Exception('Пожалуйста, выберите рейтинг от 1 до 5');
    }

    if (empty($text)) {
        throw new Exception('Пожалуйста, напишите ваш отзыв');
    }

    // Обработка загруженного изображения
    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image'];
        
        // Проверяем тип файла
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Недопустимый тип файла. Разрешены только JPG, PNG и GIF');
        }
        
        // Проверяем размер файла (максимум 5MB)
        if ($file['size'] > 5 * 1024 * 1024) {
            throw new Exception('Размер файла не должен превышать 5MB');
        }
        
        // Создаем уникальное имя файла
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        
        // Создаем директорию, если она не существует
        $uploadDir = '../assets/images/reviews/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        // Перемещаем файл
        $destination = $uploadDir . $filename;
        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            throw new Exception('Ошибка при загрузке файла');
        }
        
        $image = 'assets/images/reviews/' . $filename;
    }

    // Подготавливаем и выполняем запрос
    $stmt = $pdo->prepare('
        INSERT INTO reviews (name, project, rating, text, image, status)
        VALUES (:name, :project, :rating, :text, :image, "pending")
    ');

    $stmt->execute([
        'name' => $name,
        'project' => $project,
        'rating' => $rating,
        'text' => $text,
        'image' => $image
    ]);

    // Отправляем успешный ответ
    echo json_encode([
        'success' => true,
        'message' => 'Отзыв успешно отправлен'
    ]);

} catch (Exception $e) {
    // Отправляем ответ с ошибкой
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
} 