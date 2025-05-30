<?php
require_once 'includes/db.php';

// Отладочная информация
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Получаем все акции для отладки
    $stmt = $pdo->query('SELECT * FROM promotions ORDER BY created_at DESC');
    $promotions = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Отладочная информация
    echo "<!-- Количество найденных акций: " . count($promotions) . " -->";
    if (count($promotions) > 0) {
        echo "<!-- Данные акций: -->";
        foreach ($promotions as $promo) {
            echo "<!-- Акция ID: " . $promo['id'] . " -->";
            echo "<!-- Название: " . $promo['title'] . " -->";
            echo "<!-- Статус: " . $promo['status'] . " -->";
            echo "<!-- Дата начала: " . $promo['start_date'] . " -->";
            echo "<!-- Дата окончания: " . $promo['end_date'] . " -->";
        }
    }

} catch (PDOException $e) {
    echo "<!-- Ошибка базы данных: " . $e->getMessage() . " -->";
}

// Подключаем хедер
include 'includes/header.php';
?>

<!-- Подключаем стили -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/promotions.css">

<main class="promotions-page">
    <div class="container">
        <div class="promotions-page__header">
            <h1 class="promotions-page__title">Акции и скидки</h1>
            <p class="promotions-page__subtitle">Специальные предложения для наших клиентов</p>
        </div>

        <div class="promotions-page__content">
            <?php if (count($promotions) > 0): ?>
                <?php foreach ($promotions as $promo): ?>
                    <div class="promotions-page__card">
                        <div class="promotions-page__card-image">
                            <img src="<?php echo htmlspecialchars($promo['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($promo['title']); ?>"
                                 loading="lazy">
                            <div class="promotions-page__card-discount">
                                <?php echo htmlspecialchars($promo['discount_value']); ?>
                            </div>
                        </div>
                        <div class="promotions-page__card-content">
                            <h2 class="promotions-page__card-title">
                                <?php echo htmlspecialchars($promo['title']); ?>
                            </h2>
                            <p class="promotions-page__card-description">
                                <?php echo htmlspecialchars($promo['description']); ?>
                            </p>
                            <div class="promotions-page__card-dates">
                                <span>Действует до: <?php echo date('d.m.Y', strtotime($promo['end_date'])); ?></span>
                            </div>
                            <div class="promotions-page__card-conditions">
                                <h3>Условия акции:</h3>
                                <p><?php echo nl2br(htmlspecialchars($promo['conditions'])); ?></p>
                            </div>
                            <button class="promotions-page__card-button" 
                                    onclick="showPromoDetails(<?php echo $promo['id']; ?>)">
                                Подробнее
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="promotions-page__no-data">
                    <p>В данный момент нет активных акций</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<!-- Модальное окно для деталей акции -->
<div class="promotions-page__modal" id="promoModal">
    <div class="promotions-page__modal-content">
        <button class="promotions-page__modal-close" onclick="closeModal()">
            <i class="bx bx-x"></i>
        </button>
        <div class="promotions-page__modal-body">
            <!-- Контент будет загружен динамически -->
        </div>
    </div>
</div>

<?php
// Подключаем футер
include 'includes/footer.php';
?>

<script src="assets/js/main.js"></script>
<script src="assets/js/promotions.js"></script> 