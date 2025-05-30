<?php
require_once 'includes/db.php';

// Получаем все активные услуги
$stmt = $pdo->query('SELECT * FROM services WHERE status = "active" ORDER BY created_at DESC');
$services = $stmt->fetchAll();

// Подключаем хедер
include 'includes/header.php';
?>

<!-- Подключаем стили -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/services.css">

<main class="services-page">
    <div class="container">
        <div class="services-page__header">
            <h1 class="services-page__title">Наши услуги</h1>
            <p class="services-page__subtitle">Профессиональный ремонт и отделка помещений любой сложности</p>
        </div>

        <div class="services-page__grid">
            <?php foreach ($services as $service): ?>
                <div class="services-page__card" data-service-id="<?php echo $service['id']; ?>">
                    <?php if ($service['image']): ?>
                        <div class="services-page__card-image">
                            <img src="<?php echo htmlspecialchars($service['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($service['title']); ?>">
                        </div>
                    <?php endif; ?>

                    <div class="services-page__card-content">
                        <h3 class="services-page__card-title">
                            <?php echo htmlspecialchars($service['title']); ?>
                        </h3>

                        <p class="services-page__card-description">
                            <?php echo htmlspecialchars($service['short_description']); ?>
                        </p>

                        <div class="services-page__card-info">
                            <?php if ($service['price']): ?>
                                <div class="services-page__card-price">
                                    <i class="bx bx-ruble"></i>
                                    <?php echo number_format($service['price'], 0, ',', ' '); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($service['duration']): ?>
                                <div class="services-page__card-duration">
                                    <i class="bx bx-time"></i>
                                    <?php echo htmlspecialchars($service['duration']); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <button class="services-page__card-button" data-service-id="<?php echo $service['id']; ?>">
                            Подробнее
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Модальное окно с подробной информацией -->
    <div class="services-page__modal" id="serviceModal">
        <div class="services-page__modal-content">
            <button class="services-page__modal-close">
                <i class="bx bx-x"></i>
            </button>
            
            <div class="services-page__modal-body">
                <!-- Контент будет загружен динамически -->
            </div>
        </div>
    </div>
</main>

<?php
// Подключаем футер
include 'includes/footer.php';
?>

<script src="assets/js/main.js"></script>
<script src="assets/js/services.js"></script> 