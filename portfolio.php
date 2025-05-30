<?php
require_once 'includes/db.php';

// Получаем все категории
$stmt = $pdo->query('SELECT DISTINCT category FROM portfolio WHERE status = "active" ORDER BY category');
$categories = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Получаем выбранную категорию
$selectedCategory = isset($_GET['category']) ? $_GET['category'] : '';

// Формируем SQL запрос
$sql = 'SELECT * FROM portfolio WHERE status = "active"';
if ($selectedCategory) {
    $sql .= ' AND category = ?';
}
$sql .= ' ORDER BY created_at DESC';

$stmt = $pdo->prepare($sql);
if ($selectedCategory) {
    $stmt->execute([$selectedCategory]);
} else {
    $stmt->execute();
}
$projects = $stmt->fetchAll();

// Подключаем хедер
include 'includes/header.php';
?>

<!-- Подключаем стили -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/portfolio.css">

<main class="portfolio-page">
    <div class="container">
        <div class="portfolio-page__header">
            <h1 class="portfolio-page__title">Наши работы</h1>
            <p class="portfolio-page__subtitle">Лучшие проекты, реализованные нашей компанией</p>
        </div>

        <!-- Фильтры -->
        <div class="portfolio-page__filters">
            <button class="portfolio-page__filter-button <?php echo !$selectedCategory ? 'active' : ''; ?>" 
                    data-category="">
                Все проекты
            </button>
            <?php foreach ($categories as $category): ?>
                <button class="portfolio-page__filter-button <?php echo $selectedCategory === $category ? 'active' : ''; ?>" 
                        data-category="<?php echo htmlspecialchars($category); ?>">
                    <?php echo htmlspecialchars($category); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Сетка проектов -->
        <div class="portfolio-page__grid">
            <?php foreach ($projects as $project): ?>
                <div class="portfolio-page__card" data-category="<?php echo htmlspecialchars($project['category']); ?>">
                    <div class="portfolio-page__card-image">
                        <img src="<?php echo htmlspecialchars($project['main_image']); ?>" 
                             alt="<?php echo htmlspecialchars($project['title']); ?>"
                             loading="lazy">
                        <div class="portfolio-page__card-overlay">
                            <button class="portfolio-page__card-button" data-project-id="<?php echo $project['id']; ?>">
                                Подробнее
                            </button>
                        </div>
                    </div>
                    <div class="portfolio-page__card-content">
                        <h3 class="portfolio-page__card-title">
                            <?php echo htmlspecialchars($project['title']); ?>
                        </h3>
                        <div class="portfolio-page__card-info">
                            <?php if ($project['area']): ?>
                                <div class="portfolio-page__card-area">
                                    <i class="bx bx-ruler"></i>
                                    <?php echo number_format($project['area'], 1, ',', ' '); ?> м²
                                </div>
                            <?php endif; ?>
                            <?php if ($project['duration']): ?>
                                <div class="portfolio-page__card-duration">
                                    <i class="bx bx-time"></i>
                                    <?php echo htmlspecialchars($project['duration']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <p class="portfolio-page__card-description">
                            <?php echo htmlspecialchars($project['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Модальное окно с подробной информацией -->
    <div class="portfolio-page__modal" id="projectModal">
        <div class="portfolio-page__modal-content">
            <button class="portfolio-page__modal-close">
                <i class="bx bx-x"></i>
            </button>
            
            <div class="portfolio-page__modal-body">
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
<script src="assets/js/portfolio.js"></script> 