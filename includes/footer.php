<style>
    .footer {
    background-color: #000;
    color: #fff;
    position: relative;
    overflow: hidden;
}

.footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
}

.footer__top {
    padding: 80px 0 60px;
    position: relative;
}

.footer__grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 40px;
}

.footer__logo {
    display: inline-block;
    margin-bottom: 20px;
}

.footer__logo img {
    height: 40px;
    filter: brightness(0) invert(1);
}

.footer__text {
    color: rgba(255, 255, 255, 0.7);
    line-height: 1.6;
    margin-bottom: 30px;
}

.footer__social {
    display: flex;
    gap: 15px;
}

.footer__social-link {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    transition: all 0.3s ease;
}

.footer__social-link:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-3px);
}

.footer__title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 25px;
    color: #fff;
}

.footer__list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer__list li {
    margin-bottom: 12px;
}

.footer__list a {
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-block;
}

.footer__list a:hover {
    color: #fff;
    transform: translateX(5px);
}

.footer__contact-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer__contact-list li {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    color: rgba(255, 255, 255, 0.7);
}

.footer__contact-list i {
    margin-right: 15px;
    font-size: 18px;
    color: rgba(255, 255, 255, 0.5);
}

.footer__bottom {
    padding: 25px 0;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.footer__bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.footer__copyright {
    color: rgba(255, 255, 255, 0.5);
}

.footer__links {
    display: flex;
    gap: 30px;
}

.footer__links a {
    color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer__links a:hover {
    color: #fff;
}

@media (max-width: 1024px) {
    .footer__grid {
        grid-template-columns: 1fr 1fr;
        gap: 40px 30px;
    }
}

@media (max-width: 768px) {
    .footer__grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .footer__bottom-content {
        flex-direction: column;
        gap: 20px;
        text-align: center;
    }
    
    .footer__links {
        justify-content: center;
    }
} 
</style>

<footer class="footer">
        <div class="footer__top">
            <div class="container">
                <div class="footer__grid">
                    <div class="footer__info">
                        <a href="/" class="footer__logo">
                            <img src="assets/images/logo.svg" alt="Логотип">
                        </a>
                        <p class="footer__text">
                            Профессиональный ремонт квартир в Москве и Московской области. 
                            Качественные материалы, опытные мастера, гарантия на все виды работ.
                        </p>
                        <div class="footer__social">
                            <a href="#" class="footer__social-link">
                                <i class="fab fa-telegram"></i>
                            </a>
                            <a href="#" class="footer__social-link">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="footer__social-link">
                                <i class="fab fa-vk"></i>
                            </a>
                        </div>
                    </div>
                    <div class="footer__nav">
                        <h3 class="footer__title">Навигация</h3>
                        <ul class="footer__list">
                            <li><a href="#about">О компании</a></li>
                            <li><a href="#services">Услуги</a></li>
                            <li><a href="#portfolio">Портфолио</a></li>
                            <li><a href="#reviews">Отзывы</a></li>
                            <li><a href="#faq">FAQ</a></li>
                            <li><a href="#contact">Контакты</a></li>
                        </ul>
                    </div>
                    <div class="footer__services">
                        <h3 class="footer__title">Услуги</h3>
                        <ul class="footer__list">
                            <li><a href="#services">Ремонт квартир</a></li>
                            <li><a href="#services">Дизайн-проект</a></li>
                            <li><a href="#services">Отделочные работы</a></li>
                            <li><a href="#services">Электрика</a></li>
                            <li><a href="#services">Сантехника</a></li>
                            <li><a href="#services">Строительство</a></li>
                        </ul>
                    </div>
                    <div class="footer__contact">
                        <h3 class="footer__title">Контакты</h3>
                        <ul class="footer__contact-list">
                            <li>
                                <i class="fas fa-map-marker-alt"></i>
                                <span>г. Москва, ул. Примерная, д. 123</span>
                            </li>
                            <li>
                                <i class="fas fa-phone"></i>
                                <span>+7 (999) 123-45-67</span>
                            </li>
                            <li>
                                <i class="fas fa-envelope"></i>
                                <span>info@example.com</span>
                            </li>
                            <li>
                                <i class="fas fa-clock"></i>
                                <span>Пн-Вс: 9:00 - 20:00</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-content">
                    <div class="footer__copyright">
                        © 2024 Все права защищены
                    </div>
                    <div class="footer__links">
                        <a href="#">Политика конфиденциальности</a>
                        <a href="#">Условия использования</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

