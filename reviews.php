<?php
require_once 'includes/db.php';

// Получаем параметры сортировки и фильтрации
$sort = $_GET['sort'] ?? 'date_desc';
$rating = isset($_GET['rating']) ? (int)$_GET['rating'] : null;

// Формируем SQL запрос
$sql = 'SELECT * FROM reviews WHERE status = "approved"';
$params = [];

if ($rating !== null && $rating > 0) {
    $sql .= ' AND rating = :rating';
    $params['rating'] = $rating;
}

switch ($sort) {
    case 'rating_desc':
        $sql .= ' ORDER BY rating DESC, created_at DESC';
        break;
    case 'rating_asc':
        $sql .= ' ORDER BY rating ASC, created_at DESC';
        break;
    case 'date_asc':
        $sql .= ' ORDER BY created_at ASC';
        break;
    default: // date_desc
        $sql .= ' ORDER BY created_at DESC';
}

// Получаем отзывы
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$reviews = $stmt->fetchAll();

// Получаем средний рейтинг
$stmt = $pdo->query('SELECT AVG(rating) as avg_rating, COUNT(*) as total FROM reviews WHERE status = "approved"');
$stats = $stmt->fetch();
$avgRating = round($stats['avg_rating'], 1);
$totalReviews = $stats['total'];

// Подключаем хедер
include 'includes/header.php';
?>

<!-- Подключаем стили для страницы отзывов -->
<link rel="stylesheet" href="assets/css/main.css">

<link rel="stylesheet" href="assets/css/reviews.css">

<main class="reviews-page">
    <div class="container">
        <div class="reviews-page__header">
            <h1 class="reviews-page__title">Отзывы наших клиентов</h1>
            
            <div class="reviews-page__stats">
                <div class="reviews-page__rating">
                    <div class="reviews-page__rating-value"><?php echo $avgRating; ?></div>
                    <div class="reviews-page__stars">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bx bxs-star <?php echo $i <= $avgRating ? 'active' : ''; ?>"></i>
                        <?php endfor; ?>
                    </div>
                    <div class="reviews-page__rating-count">
                        <?php echo $totalReviews; ?> отзывов
                    </div>
                </div>
            </div>
        </div>

        <div class="reviews-page__filters">
            <div class="reviews-page__sort">
                <label for="sort">Сортировать по:</label>
                <select id="sort" name="sort">
                    <option value="date_desc" <?php echo $sort === 'date_desc' ? 'selected' : ''; ?>>Сначала новые</option>
                    <option value="date_asc" <?php echo $sort === 'date_asc' ? 'selected' : ''; ?>>Сначала старые</option>
                    <option value="rating_desc" <?php echo $sort === 'rating_desc' ? 'selected' : ''; ?>>По убыванию рейтинга</option>
                    <option value="rating_asc" <?php echo $sort === 'rating_asc' ? 'selected' : ''; ?>>По возрастанию рейтинга</option>
                </select>
            </div>

            <div class="reviews-page__rating-filter">
                <label>Фильтр по рейтингу:</label>
                <div class="reviews-page__rating-buttons">
                    <a href="?<?php echo http_build_query(array_merge($_GET, ['rating' => 'all'])); ?>" 
                       class="<?php echo $rating === null ? 'active' : ''; ?>">
                        Все
                    </a>
                    <?php for ($i = 5; $i >= 1; $i--): ?>
                        <a href="?<?php echo http_build_query(array_merge($_GET, ['rating' => $i])); ?>" 
                           class="<?php echo $rating === $i ? 'active' : ''; ?>">
                            <?php echo $i; ?> <i class="bx bxs-star"></i>
                        </a>
                    <?php endfor; ?>
                </div>
            </div>
        </div>

        <div class="reviews-page__grid">
            <?php foreach ($reviews as $review): ?>
                <div class="reviews-page__card">
                    <div class="reviews-page__card-header">
                        <div class="reviews-page__card-rating">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="bx bxs-star <?php echo $i <= $review['rating'] ? 'active' : ''; ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <div class="reviews-page__card-date">
                            <?php echo date('d.m.Y', strtotime($review['created_at'])); ?>
                        </div>
                    </div>
                    
                    <div class="reviews-page__card-text">
                        <?php echo nl2br(htmlspecialchars($review['text'])); ?>
                    </div>
                    
                    <div class="reviews-page__card-author">
                        <?php if ($review['image']): ?>
                            <img src="<?php echo htmlspecialchars($review['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($review['name']); ?>" 
                                 class="reviews-page__card-image">
                        <?php endif; ?>
                        
                        <div class="reviews-page__card-info">
                            <div class="reviews-page__card-name">
                                <?php echo htmlspecialchars($review['name']); ?>
                            </div>
                            <div class="reviews-page__card-project">
                                <?php echo htmlspecialchars($review['project']); ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="reviews-page__form-wrapper">
            <h2 class="reviews-page__form-title">Оставить отзыв</h2>
            
            <form class="reviews-page__form" method="post" enctype="multipart/form-data">
                <div class="reviews-page__form-group">
                    <label for="name">Ваше имя *</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="reviews-page__form-group">
                    <label for="project">Название проекта *</label>
                    <input type="text" id="project" name="project" required>
                </div>
                
                <div class="reviews-page__form-group">
                    <label>Ваша оценка *</label>
                    <div class="reviews-page__rating-input">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" id="rating<?php echo $i; ?>" name="rating" value="<?php echo $i; ?>" required>
                            <label for="rating<?php echo $i; ?>"><i class="bx bxs-star"></i></label>
                        <?php endfor; ?>
                    </div>
                </div>
                
                <div class="reviews-page__form-group">
                    <label for="text">Ваш отзыв *</label>
                    <textarea id="text" name="text" required></textarea>
                </div>
                
                <div class="reviews-page__form-group">
                    <label for="image">Фото (необязательно)</label>
                    <input type="file" id="image" name="image" accept="image/*">
                </div>
                
                <button type="submit" class="reviews-page__submit">
                    Отправить отзыв
                </button>
            </form>
        </div>
    </div>
</main>

<?php
// Подключаем футер
include 'includes/footer.php';
?>

<script src="assets/js/reviews.js"></script> 