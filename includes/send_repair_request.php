<?php
require_once 'db.php';

// Проверяем метод запроса
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Метод не поддерживается']);
    exit;
}

// Получаем данные из запроса
$data = json_decode(file_get_contents('php://input'), true);

// Проверяем обязательные поля
$required_fields = ['name', 'phone', 'address', 'square_meters', 'repair_type'];
foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Пожалуйста, заполните все обязательные поля']);
        exit;
    }
}

try {
    // Подготавливаем данные
    $name = htmlspecialchars($data['name']);
    $phone = htmlspecialchars($data['phone']);
    $email = !empty($data['email']) ? htmlspecialchars($data['email']) : null;
    $address = htmlspecialchars($data['address']);
    $square_meters = floatval($data['square_meters']);
    $repair_type = htmlspecialchars($data['repair_type']);
    $description = !empty($data['description']) ? htmlspecialchars($data['description']) : null;
    $budget = !empty($data['budget']) ? floatval($data['budget']) : null;
    $preferred_date = !empty($data['preferred_date']) ? $data['preferred_date'] : null;

    // Вставляем данные в базу
    $stmt = $pdo->prepare("
        INSERT INTO repair_requests (
            name, phone, email, address, square_meters, 
            repair_type, description, budget, preferred_date
        ) VALUES (
            :name, :phone, :email, :address, :square_meters,
            :repair_type, :description, :budget, :preferred_date
        )
    ");

    $stmt->execute([
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'address' => $address,
        'square_meters' => $square_meters,
        'repair_type' => $repair_type,
        'description' => $description,
        'budget' => $budget,
        'preferred_date' => $preferred_date
    ]);

    // Отправляем уведомление на email
    $to = 'info@luxrenove.ru';
    $subject = 'Новая заявка на ремонт';
    
    $message = "Новая заявка на ремонт:\n\n";
    $message .= "Имя: $name\n";
    $message .= "Телефон: $phone\n";
    if ($email) $message .= "Email: $email\n";
    $message .= "Адрес: $address\n";
    $message .= "Площадь: $square_meters м²\n";
    $message .= "Тип ремонта: $repair_type\n";
    if ($description) $message .= "Описание: $description\n";
    if ($budget) $message .= "Бюджет: $budget ₽\n";
    if ($preferred_date) $message .= "Желаемая дата: $preferred_date\n";

    $headers = 'From: noreply@luxrenove.ru' . "\r\n" .
               'Reply-To: ' . ($email ? $email : $to) . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    // Возвращаем успешный ответ
    echo json_encode(['success' => true, 'message' => 'Заявка успешно отправлена']);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Ошибка при сохранении заявки']);
}
?> 