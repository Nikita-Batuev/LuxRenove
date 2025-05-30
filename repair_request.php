<?php
require_once 'includes/db.php';
include 'includes/header.php';
?>

<!-- Подключаем стили -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/repair-request.css">

<main class="repair-request-page">
    <div class="container">
        <div class="repair-request-page__header">
            <h1 class="repair-request-page__title">Заявка на ремонт</h1>
            <p class="repair-request-page__subtitle">Оставьте заявку, и мы свяжемся с вами для обсуждения деталей</p>
        </div>

        <div class="repair-request-page__content">
            <form id="repairRequestForm" class="repair-request-page__form">
                <div class="repair-request-page__form-group">
                    <label for="name">Ваше имя *</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="phone">Телефон *</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>

                <div class="repair-request-page__form-group">
                    <label for="address">Адрес объекта *</label>
                    <input type="text" id="address" name="address" required>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="square_meters">Площадь помещения (м²) *</label>
                    <input type="number" id="square_meters" name="square_meters" min="1" step="0.01" required>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="repair_type">Тип ремонта *</label>
                    <select id="repair_type" name="repair_type" required>
                        <option value="">Выберите тип ремонта</option>
                        <option value="cosmetic">Косметический ремонт</option>
                        <option value="capital">Капитальный ремонт</option>
                        <option value="designer">Дизайнерский ремонт</option>
                    </select>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="description">Описание работ</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>

                <div class="repair-request-page__form-group">
                    <label for="budget">Бюджет (₽)</label>
                    <input type="number" id="budget" name="budget" min="0" step="1000">
                </div>

                <div class="repair-request-page__form-group">
                    <label for="preferred_date">Желаемая дата начала работ</label>
                    <input type="date" id="preferred_date" name="preferred_date">
                </div>

                <div class="repair-request-page__form-footer">
                    <button type="submit" class="repair-request-page__submit">
                        Отправить заявку
                    </button>
                </div>
            </form>

            <div class="repair-request-page__info">
                <div class="repair-request-page__info-card">
                    <i class="bx bx-time"></i>
                    <h3>Сроки рассмотрения</h3>
                    <p>Мы рассмотрим вашу заявку в течение 24 часов и свяжемся с вами для уточнения деталей</p>
                </div>

                <div class="repair-request-page__info-card">
                    <i class="bx bx-calculator"></i>
                    <h3>Бесплатный расчет</h3>
                    <p>После рассмотрения заявки мы предоставим вам бесплатный расчет стоимости работ</p>
                </div>

                <div class="repair-request-page__info-card">
                    <i class="bx bx-check-shield"></i>
                    <h3>Гарантия качества</h3>
                    <p>Мы гарантируем качественное выполнение всех работ в соответствии с договором</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script src="assets/js/main.js"></script>
<script src="assets/js/repair-request.js"></script> 