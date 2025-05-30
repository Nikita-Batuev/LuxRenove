<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LuxRenove - Ремонт квартир и коттеджей</title>
    <meta name="description" content="Профессиональный ремонт квартир и коттеджей от компании LuxRenove">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/reviews.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>
    <section class="banner">
        <div class="banner__video-wrapper">
            <video class="banner__video" autoplay muted loop playsinline>
                <source src="assets/images/banner.mp4" type="video/mp4">
            </video>
            <div class="banner__fallback"></div>
        </div>
        <div class="banner__overlay"></div>

        <div class="banner__slider">
            <!-- Слайд 1: Главный -->
            <div class="banner__slide banner__slide--main active">
                <div class="container">
                    <div class="banner__content">
                        <div class="banner__badge">Премиум ремонт</div>
                        <h1 class="banner__title">LuxRenove</h1>
                        <p class="banner__subtitle">Создаем пространства, в которых хочется жить</p>
                        <div class="banner__stats">
                            <div class="banner__stat">
                                <span class="banner__stat-number">500+</span>
                                <span class="banner__stat-text">Проектов</span>
                            </div>
                            <div class="banner__stat">
                                <span class="banner__stat-number">10</span>
                                <span class="banner__stat-text">Лет опыта</span>
                            </div>
                            <div class="banner__stat">
                                <span class="banner__stat-number">100%</span>
                                <span class="banner__stat-text">Гарантия</span>
                            </div>
                        </div>
                        <div class="banner__buttons">
                            <a href="request.php" class="banner__button">
                                <span>Начать проект</span>
                                <i class='bx bx-right-arrow-alt'></i>
                            </a>
                            <a href="#portfolio" class="banner__button banner__button--outline">
                                <span>Наши работы</span>
                                <i class='bx bx-images'></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Слайд 2: Топовые акции -->
            <div class="banner__slide banner__slide--promo">
                <div class="container">
                    <div class="banner__promo">
                        <h2 class="banner__section-title">Топовые акции</h2>
                        <div class="banner__promo-grid">
                            <div class="banner__promo-card">
                                <div class="banner__promo-content">
                                    <div class="banner__promo-badge">Хит сезона</div>
                                    <div class="banner__promo-discount">-40%</div>
                                    <h3>Ремонт под ключ</h3>
                                    <ul class="banner__promo-list">
                                        <li><i class='bx bx-check'></i> Бесплатный дизайн-проект</li>
                                        <li><i class='bx bx-check'></i> Премиум материалы</li>
                                        <li><i class='bx bx-check'></i> Гарантия 5 лет</li>
                                    </ul>
                                    <div class="banner__promo-price">
                                        <span class="banner__promo-old">от 5 000 ₽/м²</span>
                                        <span class="banner__promo-new">от 3 000 ₽/м²</span>
                                    </div>
                                    <div class="banner__promo-period">До 31.12.2024</div>
                                </div>
                            </div>
                            <div class="banner__promo-card">
                                <div class="banner__promo-content">
                                    <div class="banner__promo-badge">Популярно</div>
                                    <div class="banner__promo-discount">-30%</div>
                                    <h3>Кухня мечты</h3>
                                    <ul class="banner__promo-list">
                                        <li><i class='bx bx-check'></i> Дизайн-проект кухни</li>
                                        <li><i class='bx bx-check'></i> Встроенная техника</li>
                                        <li><i class='bx bx-check'></i> Монтаж и подключение</li>
                                    </ul>
                                    <div class="banner__promo-price">
                                        <span class="banner__promo-old">от 350 000 ₽</span>
                                        <span class="banner__promo-new">от 245 000 ₽</span>
                                    </div>
                                    <div class="banner__promo-period">До 31.12.2024</div>
                                </div>
                            </div>
                            <div class="banner__promo-card">
                                <div class="banner__promo-content">
                                    <div class="banner__promo-badge">Новинка</div>
                                    <div class="banner__promo-discount">-25%</div>
                                    <h3>Умный дом</h3>
                                    <ul class="banner__promo-list">
                                        <li><i class='bx bx-check'></i> Управление освещением</li>
                                        <li><i class='bx bx-check'></i> Климат-контроль</li>
                                        <li><i class='bx bx-check'></i> Безопасность</li>
                                    </ul>
                                    <div class="banner__promo-price">
                                        <span class="banner__promo-old">от 200 000 ₽</span>
                                        <span class="banner__promo-new">от 150 000 ₽</span>
                                    </div>
                                    <div class="banner__promo-period">До 31.12.2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Слайд 3: События -->
            <div class="banner__slide banner__slide--events">
                <div class="container">
                    <div class="banner__events">
                        <h2 class="banner__section-title">Ближайшие события</h2>
                        <div class="banner__events-grid">
                            <div class="banner__event-card">
                                <div class="banner__event-date">
                                    <span class="banner__event-day">15</span>
                                    <span class="banner__event-month">Мар</span>
                                </div>
                                <div class="banner__event-content">
                                    <h3>День открытых дверей</h3>
                                    <p>Посетите наш шоурум и получите бесплатную консультацию</p>
                                    <div class="banner__event-details">
                                        <span><i class='bx bx-time'></i> 12:00 - 20:00</span>
                                        <span><i class='bx bx-map'></i> ул. Примерная, 123</span>
                                    </div>
                                    <a href="#" class="banner__event-button">Записаться</a>
                                </div>
                            </div>
                            <div class="banner__event-card">
                                <div class="banner__event-date">
                                    <span class="banner__event-day">20</span>
                                    <span class="banner__event-month">Мар</span>
                                </div>
                                <div class="banner__event-content">
                                    <h3>Мастер-класс по дизайну</h3>
                                    <p>Узнайте секреты создания идеального интерьера</p>
                                    <div class="banner__event-details">
                                        <span><i class='bx bx-time'></i> 15:00 - 18:00</span>
                                        <span><i class='bx bx-map'></i> ул. Примерная, 123</span>
                                    </div>
                                    <a href="#" class="banner__event-button">Записаться</a>
                                </div>
                            </div>
                            <div class="banner__event-card">
                                <div class="banner__event-date">
                                    <span class="banner__event-day">25</span>
                                    <span class="banner__event-month">Мар</span>
                                </div>
                                <div class="banner__event-content">
                                    <h3>Презентация новой коллекции</h3>
                                    <p>Эксклюзивный показ новых материалов и технологий</p>
                                    <div class="banner__event-details">
                                        <span><i class='bx bx-time'></i> 14:00 - 19:00</span>
                                        <span><i class='bx bx-map'></i> ул. Примерная, 123</span>
                                    </div>
                                    <a href="#" class="banner__event-button">Записаться</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Слайд 4: История компании -->
            <div class="banner__slide banner__slide--history">
                <div class="container">
                    <div class="banner__history">
                        <h2 class="banner__section-title">Наша история</h2>
                        <div class="banner__history-timeline">
                            <div class="banner__history-year">2014</div>
                            <div class="banner__history-content">
                                <h3>Основание компании</h3>
                                <p>Создание команды профессионалов и первые проекты</p>
                            </div>
                            <div class="banner__history-milestone">
                                <span>50+</span>
                                <small>Проектов</small>
                            </div>
                        </div>
                        <div class="banner__history-timeline">
                            <div class="banner__history-year">2017</div>
                            <div class="banner__history-content">
                                <h3>Расширение</h3>
                                <p>Открытие собственного шоурума и студии дизайна</p>
                            </div>
                            <div class="banner__history-milestone">
                                <span>200+</span>
                                <small>Проектов</small>
                            </div>
                        </div>
                        <div class="banner__history-timeline">
                            <div class="banner__history-year">2020</div>
                            <div class="banner__history-content">
                                <h3>Инновации</h3>
                                <p>Внедрение умных технологий и экологичных решений</p>
                            </div>
                            <div class="banner__history-milestone">
                                <span>350+</span>
                                <small>Проектов</small>
                            </div>
                        </div>
                        <div class="banner__history-timeline">
                            <div class="banner__history-year">2024</div>
                            <div class="banner__history-content">
                                <h3>Лидер рынка</h3>
                                <p>Становление лидером в сфере премиум-ремонта</p>
                            </div>
                            <div class="banner__history-milestone">
                                <span>500+</span>
                                <small>Проектов</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Новая навигация слайдера -->
        <div class="banner__controls">
            <div class="banner__dots">
                <button class="banner__dot active" data-slide="1">
                    <span class="banner__dot-number">01</span>
                    <span class="banner__dot-title">Главная</span>
                </button>
                <button class="banner__dot" data-slide="2">
                    <span class="banner__dot-number">02</span>
                    <span class="banner__dot-title">Проекты</span>
                </button>
                <button class="banner__dot" data-slide="3">
                    <span class="banner__dot-number">03</span>
                    <span class="banner__dot-title">Команда</span>
                </button>
                <button class="banner__dot" data-slide="4">
                    <span class="banner__dot-number">04</span>
                    <span class="banner__dot-title">Акции</span>
                </button>
            </div>
            
            <div class="banner__arrows">
                <button class="banner__arrow banner__arrow--prev">
                    <i class='bx bx-chevron-left'></i>
                </button>
                <button class="banner__arrow banner__arrow--next">
                    <i class='bx bx-chevron-right'></i>
                </button>
            </div>
        </div>

        <div class="banner__progress">
            <div class="banner__progress-bar"></div>
        </div>
    </section>

    <section class="promo" id="promo">
        <div class="container">
            <div class="promo__header">
                <h2 class="promo__title">Акции и скидки</h2>
                <p class="promo__subtitle">Специальные предложения для вашего комфорта</p>
            </div>
            
            <div class="promo__grid">
                <div class="promo__card">
                    <div class="promo__card-content">
                        <span class="promo__discount">-30%</span>
                        <h3 class="promo__card-title">Ремонт кухни</h3>
                        <p class="promo__card-text">При заказе ремонта кухни под ключ</p>
                        <div class="promo__card-footer">
                            <span class="promo__period">До 31.12.2024</span>
                            <a href="#request" class="promo__button">Подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="promo__card">
                    <div class="promo__card-content">
                        <span class="promo__discount">-20%</span>
                        <h3 class="promo__card-title">Дизайн-проект</h3>
                        <p class="promo__card-text">При заказе ремонта с дизайн-проектом</p>
                        <div class="promo__card-footer">
                            <span class="promo__period">До 31.12.2024</span>
                            <a href="#request" class="promo__button">Подробнее</a>
                        </div>
                    </div>
                </div>

                <div class="promo__card">
                    <div class="promo__card-content">
                        <span class="promo__discount">-15%</span>
                        <h3 class="promo__card-title">Ремонт ванной</h3>
                        <p class="promo__card-text">При заказе ремонта ванной комнаты</p>
                        <div class="promo__card-footer">
                            <span class="promo__period">До 31.12.2024</span>
                            <a href="#request" class="promo__button">Подробнее</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about__parallax">
            <div class="about__parallax-layer" data-speed="0.2"></div>
            <div class="about__parallax-layer" data-speed="0.4"></div>
            <div class="about__parallax-layer" data-speed="0.6"></div>
        </div>
        
        <div class="container">
            <div class="about__content">
                <div class="about__left">
                    <div class="about__sticky">
                        <div class="about__title-wrapper">
                            <span class="about__number">01</span>
                            <h2 class="about__title">О компании</h2>
                        </div>
                        
                        <div class="about__text-block">
                            <p class="about__text">Мы не просто делаем ремонт. Мы создаем пространства, которые вдохновляют и меняют жизнь.</p>
                            <div class="about__highlight">
                                <div class="about__highlight-circle"></div>
                                <span class="about__highlight-text">10 лет</span>
                                <span class="about__highlight-label">создаем совершенство</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="about__right">
                    <div class="about__gallery">
                        <div class="about__gallery-item about__gallery-item--large">
                            <div class="about__gallery-content">
                                <img src="assets/images/about-1.jpg" alt="Наши работы">
                                <div class="about__gallery-overlay">
                                    <span class="about__gallery-text">Дизайн</span>
                                </div>
                            </div>
                        </div>
                        <div class="about__gallery-item">
                            <div class="about__gallery-content">
                                <img src="assets/images/about-2.jpg" alt="Наша команда">
                                <div class="about__gallery-overlay">
                                    <span class="about__gallery-text">Команда</span>
                                </div>
                            </div>
                        </div>
                        <div class="about__gallery-item">
                            <div class="about__gallery-content">
                                <img src="assets/images/about-3.jpg" alt="Наш процесс">
                                <div class="about__gallery-overlay">
                                    <span class="about__gallery-text">Процесс</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="about__features">
                        <div class="about__feature">
                            <div class="about__feature-content">
                                <div class="about__feature-line"></div>
                                <h3 class="about__feature-title">Индивидуальный подход</h3>
                                <p class="about__feature-text">Каждый проект уникален, как и ваши желания</p>
                            </div>
                        </div>
                        <div class="about__feature">
                            <div class="about__feature-content">
                                <div class="about__feature-line"></div>
                                <h3 class="about__feature-title">Современные решения</h3>
                                <p class="about__feature-text">Используем инновационные технологии и материалы</p>
                            </div>
                        </div>
                        <div class="about__feature">
                            <div class="about__feature-content">
                                <div class="about__feature-line"></div>
                                <h3 class="about__feature-title">Безупречное качество</h3>
                                <p class="about__feature-text">Строгий контроль на каждом этапе работы</p>
                            </div>
                        </div>
                    </div>

                    <div class="about__cta">
                        <a href="#request" class="about__button">
                            <span class="about__button-text">Начать проект</span>
                            <div class="about__button-line"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="reviews" id="reviews">
        <div class="container">
            <div class="reviews__header">
                <span class="reviews__subtitle">Отзывы</span>
                <h2 class="reviews__title">Что говорят наши клиенты</h2>
            </div>

            <div class="reviews__slider">
                <div class="reviews__track">
                    <div class="reviews__slide">
                        <div class="reviews__card">
                            <div class="reviews__card-header">
                                <div class="reviews__rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="reviews__date">15.03.2024</div>
                            </div>
                            <p class="reviews__text">"Невероятно профессиональная команда! Ремонт квартиры выполнен в срок и с безупречным качеством. Особенно впечатлило внимание к деталям и постоянная связь с прорабом."</p>
                            <div class="reviews__author">
                                <div class="reviews__author-image">
                                    <img src="assets/images/reviews/author-1.jpg" alt="Анна К.">
                                </div>
                                <div class="reviews__author-info">
                                    <h3 class="reviews__author-name">Анна К.</h3>
                                    <p class="reviews__author-project">Ремонт квартиры 85м²</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews__slide">
                        <div class="reviews__card">
                            <div class="reviews__card-header">
                                <div class="reviews__rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="reviews__date">02.03.2024</div>
                            </div>
                            <p class="reviews__text">"Заказывали ремонт кухни. Результат превзошел все ожидания! Современный дизайн, качественные материалы и профессиональный подход к работе."</p>
                            <div class="reviews__author">
                                <div class="reviews__author-image">
                                    <img src="assets/images/reviews/author-2.jpg" alt="Михаил П.">
                                </div>
                                <div class="reviews__author-info">
                                    <h3 class="reviews__author-name">Михаил П.</h3>
                                    <p class="reviews__author-project">Ремонт кухни 25м²</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews__slide">
                        <div class="reviews__card">
                            <div class="reviews__card-header">
                                <div class="reviews__rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="reviews__date">20.02.2024</div>
                            </div>
                            <p class="reviews__text">"Отличная работа по ремонту ванной комнаты. Все сделано аккуратно, в срок и с учетом всех пожеланий. Рекомендую!"</p>
                            <div class="reviews__author">
                                <div class="reviews__author-image">
                                    <img src="assets/images/reviews/author-3.jpg" alt="Елена С.">
                                </div>
                                <div class="reviews__author-info">
                                    <h3 class="reviews__author-name">Елена С.</h3>
                                    <p class="reviews__author-project">Ремонт ванной 12м²</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews__slide">
                        <div class="reviews__card">
                            <div class="reviews__card-header">
                                <div class="reviews__rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="reviews__date">10.02.2024</div>
                            </div>
                            <p class="reviews__text">"Благодарна команде за ремонт гостиной. Все работы выполнены качественно, в срок и с учетом всех пожеланий. Особенно понравилось, что все материалы были подобраны с учетом моего бюджета."</p>
                            <div class="reviews__author">
                                <div class="reviews__author-image">
                                    <img src="assets/images/reviews/author-4.jpg" alt="Ольга М.">
                                </div>
                                <div class="reviews__author-info">
                                    <h3 class="reviews__author-name">Ольга М.</h3>
                                    <p class="reviews__author-project">Ремонт гостиной 35м²</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="reviews__slide">
                        <div class="reviews__card">
                            <div class="reviews__card-header">
                                <div class="reviews__rating">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                </div>
                                <div class="reviews__date">05.02.2024</div>
                            </div>
                            <p class="reviews__text">"Заказывали ремонт детской комнаты. Результат превзошел все ожидания! Дети в восторге от новой комнаты. Спасибо за внимательность к деталям и безопасные материалы."</p>
                            <div class="reviews__author">
                                <div class="reviews__author-image">
                                    <img src="assets/images/reviews/author-5.jpg" alt="Сергей В.">
                                </div>
                                <div class="reviews__author-info">
                                    <h3 class="reviews__author-name">Сергей В.</h3>
                                    <p class="reviews__author-project">Ремонт детской 18м²</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="reviews__controls">
                    <button class="reviews__prev">
                        <i class='bx bx-chevron-left'></i>
                    </button>
                    <div class="reviews__dots"></div>
                    <button class="reviews__next">
                        <i class='bx bx-chevron-right'></i>
                    </button>
                </div>
            </div>

            <div class="reviews__cta">
                <a href="reviews.php" class="reviews__button">
                    <span>Все отзывы</span>
                    <i class='bx bx-right-arrow-alt'></i>
                </a>
            </div>
        </div>
    </section>

    <section class="faq" id="faq">
        <div class="container">
            <div class="faq__header">
                <span class="faq__subtitle">FAQ</span>
                <h2 class="faq__title">Часто задаваемые вопросы</h2>
            </div>

            <div class="faq__accordion">
                <div class="faq__item">
                    <button class="faq__question">
                        <span>Как долго длится ремонт квартиры?</span>
                        <i class='bx bx-plus'></i>
                    </button>
                    <div class="faq__answer">
                        <p>Сроки ремонта зависят от площади помещения, сложности работ и выбранных материалов. В среднем, ремонт квартиры площадью 60-80 м² занимает 2-3 месяца. Мы всегда составляем детальный график работ и строго его соблюдаем.</p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question">
                        <span>Предоставляете ли вы гарантию на выполненные работы?</span>
                        <i class='bx bx-plus'></i>
                    </button>
                    <div class="faq__answer">
                        <p>Да, мы предоставляем гарантию на все виды работ. Срок гарантии зависит от типа работ и используемых материалов. В среднем гарантийный срок составляет от 1 до 5 лет. Все гарантийные обязательства фиксируются в договоре.</p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question">
                        <span>Как происходит расчет стоимости ремонта?</span>
                        <i class='bx bx-plus'></i>
                    </button>
                    <div class="faq__answer">
                        <p>Стоимость ремонта рассчитывается индивидуально для каждого проекта. Мы учитываем площадь помещения, сложность работ, выбранные материалы и сроки выполнения. После осмотра объекта мы предоставляем детальную смету с разбивкой по видам работ.</p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question">
                        <span>Можно ли заказать только дизайн-проект?</span>
                        <i class='bx bx-plus'></i>
                    </button>
                    <div class="faq__answer">
                        <p>Да, мы предоставляем услугу разработки дизайн-проекта отдельно от ремонтных работ. Дизайн-проект включает в себя планировочные решения, визуализацию, подбор материалов и мебели, а также техническую документацию для ремонта.</p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question">
                        <span>Как происходит контроль качества работ?</span>
                        <i class='bx bx-plus'></i>
                    </button>
                    <div class="faq__answer">
                        <p>На каждом объекте работает прораб, который контролирует качество выполнения работ. Также регулярно проводятся проверки техническим директором. Вы можете в любой момент связаться с прорабом или менеджером проекта для решения вопросов.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="contact__background">
            <div class="contact__pattern"></div>
        </div>
        
        <div class="container">
            <div class="contact__grid">
                <div class="contact__info">
                    <div class="contact__header">
                        <span class="contact__subtitle">Контакты</span>
                        <h2 class="contact__title">Свяжитесь с нами</h2>
                    </div>
                    
                    <p class="contact__text">Оставьте заявку, и мы свяжемся с вами в ближайшее время для обсуждения вашего проекта.</p>
                    
                    <div class="contact__details">
                        <div class="contact__detail">
                            <i class='bx bx-map'></i>
                            <div class="contact__detail-content">
                                <h3 class="contact__detail-title">Адрес</h3>
                                <p class="contact__detail-text">г. Москва, ул. Примерная, д. 123</p>
                            </div>
                        </div>
                        
                        <div class="contact__detail">
                            <i class='bx bx-phone'></i>
                            <div class="contact__detail-content">
                                <h3 class="contact__detail-title">Телефон</h3>
                                <p class="contact__detail-text">+7 (999) 123-45-67</p>
                            </div>
                        </div>
                        
                        <div class="contact__detail">
                            <i class='bx bx-envelope'></i>
                            <div class="contact__detail-content">
                                <h3 class="contact__detail-title">Email</h3>
                                <p class="contact__detail-text">info@luxrenove.ru</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact__social">
                        <a href="#" class="contact__social-link">
                            <i class='bx bxl-telegram'></i>
                        </a>
                        <a href="#" class="contact__social-link">
                            <i class='bx bxl-whatsapp'></i>
                        </a>
                        <a href="#" class="contact__social-link">
                            <i class='bx bxl-vk'></i>
                        </a>
                    </div>
                </div>
                
                <div class="contact__form-wrapper">
                    <form class="contact__form" id="contactForm">
                        <div class="contact__form-group">
                            <input type="text" class="contact__input" id="name" name="name" required>
                            <label class="contact__label" for="name">Ваше имя</label>
                        </div>
                        
                        <div class="contact__form-group">
                            <input type="tel" class="contact__input" id="phone" name="phone" required>
                            <label class="contact__label" for="phone">Телефон</label>
                        </div>
                        
                        <div class="contact__form-group">
                            <input type="email" class="contact__input" id="email" name="email" required>
                            <label class="contact__label" for="email">Email</label>
                        </div>
                        
                        <div class="contact__form-group">
                            <textarea class="contact__textarea" id="message" name="message" required></textarea>
                            <label class="contact__label" for="message">Сообщение</label>
                        </div>
                        
                        <button type="submit" class="contact__submit">
                            <span>Отправить</span>
                            <i class='bx bx-right-arrow-alt'></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/reviews.js"></script>
</body>
</html>