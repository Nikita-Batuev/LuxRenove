<?php
require_once 'includes/db.php';

// Получаем контактную информацию
$stmt = $pdo->query("
    SELECT * FROM contact_info 
    WHERE status = 'active' 
    ORDER BY sort_order ASC
");
$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Группируем контакты по типу
$grouped_contacts = [];
foreach ($contacts as $contact) {
    $grouped_contacts[$contact['type']][] = $contact;
}

// Подключаем хедер
include 'includes/header.php';
?>

<!-- Подключаем стили -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/contacts.css">

<main class="contacts-page">
    <div class="container">
        <div class="contacts-page__header">
            <h1 class="contacts-page__title">Контакты</h1>
            <p class="contacts-page__subtitle">Свяжитесь с нами любым удобным способом</p>
        </div>

        <div class="contacts-page__content">
            <div class="contacts-page__info">
                <?php if (!empty($grouped_contacts['address'])): ?>
                    <div class="contacts-page__section">
                        <h2 class="contacts-page__section-title">Адреса</h2>
                        <div class="contacts-page__cards">
                            <?php foreach ($grouped_contacts['address'] as $address): ?>
                                <div class="contacts-page__card">
                                    <i class="bx <?php echo $address['icon']; ?>"></i>
                                    <h3><?php echo htmlspecialchars($address['title']); ?></h3>
                                    <p><?php echo nl2br(htmlspecialchars($address['value'])); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($grouped_contacts['phone']) || !empty($grouped_contacts['messenger'])): ?>
                    <div class="contacts-page__section">
                        <h2 class="contacts-page__section-title">Телефоны и мессенджеры</h2>
                        <div class="contacts-page__cards">
                            <?php if (!empty($grouped_contacts['phone'])): ?>
                                <?php foreach ($grouped_contacts['phone'] as $phone): ?>
                                    <div class="contacts-page__card">
                                        <i class="bx <?php echo $phone['icon']; ?>"></i>
                                        <h3><?php echo htmlspecialchars($phone['title']); ?></h3>
                                        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone['value']); ?>">
                                            <?php echo htmlspecialchars($phone['value']); ?>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <?php if (!empty($grouped_contacts['messenger'])): ?>
                                <?php foreach ($grouped_contacts['messenger'] as $messenger): ?>
                                    <div class="contacts-page__card">
                                        <i class="bx <?php echo $messenger['icon']; ?>"></i>
                                        <h3><?php echo htmlspecialchars($messenger['title']); ?></h3>
                                        <?php if ($messenger['icon'] === 'bxl-whatsapp'): ?>
                                            <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $messenger['value']); ?>" target="_blank">
                                                <?php echo htmlspecialchars($messenger['value']); ?>
                                            </a>
                                        <?php else: ?>
                                            <a href="https://t.me/<?php echo ltrim($messenger['value'], '@'); ?>" target="_blank">
                                                <?php echo htmlspecialchars($messenger['value']); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($grouped_contacts['email'])): ?>
                    <div class="contacts-page__section">
                        <h2 class="contacts-page__section-title">Email</h2>
                        <div class="contacts-page__cards">
                            <?php foreach ($grouped_contacts['email'] as $email): ?>
                                <div class="contacts-page__card">
                                    <i class="bx <?php echo $email['icon']; ?>"></i>
                                    <h3><?php echo htmlspecialchars($email['title']); ?></h3>
                                    <a href="mailto:<?php echo htmlspecialchars($email['value']); ?>">
                                        <?php echo htmlspecialchars($email['value']); ?>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($grouped_contacts['schedule'])): ?>
                    <div class="contacts-page__section">
                        <h2 class="contacts-page__section-title">Режим работы</h2>
                        <div class="contacts-page__cards">
                            <?php foreach ($grouped_contacts['schedule'] as $schedule): ?>
                                <div class="contacts-page__card">
                                    <i class="bx <?php echo $schedule['icon']; ?>"></i>
                                    <h3><?php echo htmlspecialchars($schedule['title']); ?></h3>
                                    <p><?php echo nl2br(htmlspecialchars($schedule['value'])); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (!empty($grouped_contacts['social'])): ?>
                    <div class="contacts-page__section">
                        <h2 class="contacts-page__section-title">Социальные сети</h2>
                        <div class="contacts-page__social">
                            <?php foreach ($grouped_contacts['social'] as $social): ?>
                                <a href="<?php echo htmlspecialchars($social['value']); ?>" 
                                   class="contacts-page__social-link" 
                                   target="_blank">
                                    <i class="bx <?php echo $social['icon']; ?>"></i>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contacts-page__form-container">
                <div class="contacts-page__form-wrapper">
                    <h2 class="contacts-page__form-title">Остались вопросы?</h2>
                    <p class="contacts-page__form-subtitle">Заполните форму, и мы свяжемся с вами</p>
                    
                    <form id="contactForm" class="contacts-page__form">
                        <div class="contacts-page__form-group">
                            <label for="name">Ваше имя *</label>
                            <input type="text" id="name" name="name" required>
                        </div>

                        <div class="contacts-page__form-group">
                            <label for="phone">Телефон *</label>
                            <input type="tel" id="phone" name="phone" required>
                        </div>

                        <div class="contacts-page__form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email">
                        </div>

                        <div class="contacts-page__form-group">
                            <label for="message">Сообщение *</label>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>

                        <button type="submit" class="contacts-page__submit">
                            Отправить сообщение
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="contacts-page__map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2244.772477431928!2d37.618423!3d55.755819!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNTXCsDQ1JzIwLjkiTiAzN8KwMzcnMDYuMyJF!5e0!3m2!1sru!2sru!4v1620000000000!5m2!1sru!2sru" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy">
            </iframe>
        </div>
    </div>
</main>

<?php
// Подключаем футер
include 'includes/footer.php';
?>

<script src="assets/js/main.js"></script>
<script src="assets/js/contacts.js"></script> 