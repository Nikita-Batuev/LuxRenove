<?php
require_once 'db.php';

// Получаем данные из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверяем наличие необходимых полей
if (!isset($data['name']) || !isset($data['phone']) || !isset($data['message'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Не все обязательные поля заполнены'
    ]);
    exit;
}

try {
    // Подготавливаем данные для вставки
    $stmt = $pdo->prepare("
        INSERT INTO contact_messages (
            name, 
            phone, 
            email, 
            message, 
            created_at
        ) VALUES (
            :name,
            :phone,
            :email,
            :message,
            NOW()
        )
    ");

    // Выполняем запрос
    $stmt->execute([
        'name' => $data['name'],
        'phone' => $data['phone'],
        'email' => $data['email'] ?? null,
        'message' => $data['message']
    ]);

    // Отправляем уведомление администратору
    $to = 'admin@luxrenove.ru';
    $subject = 'Новое сообщение с сайта';
    $message = "Имя: {$data['name']}\n";
    $message .= "Телефон: {$data['phone']}\n";
    if (!empty($data['email'])) {
        $message .= "Email: {$data['email']}\n";
    }
    $message .= "\nСообщение:\n{$data['message']}";
    $headers = 'From: noreply@luxrenove.ru' . "\r\n" .
               'Reply-To: ' . ($data['email'] ?? 'noreply@luxrenove.ru') . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    // Возвращаем успешный ответ
    echo json_encode([
        'success' => true,
        'message' => 'Сообщение успешно отправлено'
    ]);

} catch (PDOException $e) {
    // Логируем ошибку
    error_log("Error in send_contact.php: " . $e->getMessage());
    
    // Возвращаем ошибку
    echo json_encode([
        'success' => false,
        'message' => 'Произошла ошибка при отправке сообщения'
    ]);
} 