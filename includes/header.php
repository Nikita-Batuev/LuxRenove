<style>
        .header {
    background-color: var(--color-black);
    padding: 20px 0;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    
}

.header__container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header__logo-link {
    display: block;
    transition: transform 0.3s ease;
}

.header__logo-link:hover {
    transform: scale(1.1);
}

.header__logo {
    width: 50px;
    height: auto;
    display: block;
}

.header__nav {
    display: flex;
    align-items: center;
    gap: 30px;
}

.header__menu-btn {
    background: none;
    border: none;
    color: var(--color-white);
    font-size: 24px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.header__menu-btn:hover {
    color: var(--color-light-purple);
}

.header__account-btn {
    background: none;
    border: none;
    color: var(--color-white);
    font-size: 24px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.header__account-btn:hover {
    color: var(--color-light-purple);
}

/* Мобильное меню */
.mobile-menu {
    position: fixed;
    top: 0;
    right: -400px;
    width: 400px;
    height: auto;
    background-color: var(--color-black);
    padding: 60px 30px 30px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 1001;
    border-radius: 0 0 0 10px;
    box-shadow: -5px 5px 15px rgba(0, 0, 0, 0.2);
}

.mobile-menu.active {
    right: 0;
}

.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1000;
}

.mobile-menu-overlay.active {
    opacity: 1;
    visibility: visible;
}

.mobile-menu__close {
    position: absolute;
    top: 20px;
    right: 20px;
    background: none;
    border: none;
    color: var(--color-white);
    font-size: 24px;
    cursor: pointer;
    padding: 5px;
    transition: transform 0.3s ease;
}

.mobile-menu__close:hover {
    transform: rotate(90deg);
}

.mobile-menu__nav {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

.mobile-menu__link {
    color: var(--color-white);
    text-decoration: none;
    font-size: 18px;
    transition: all 0.3s ease;
    font-weight: 500;
    padding: 8px 0;
    position: relative;
}

.mobile-menu__link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background-color: var(--color-light-purple);
    transition: width 0.3s ease;
}

.mobile-menu__link:hover {
    color: var(--color-light-purple);
    padding-left: 10px;
}

.mobile-menu__link:hover::after {
    width: 100%;
}

.mobile-menu__button {
    display: inline-block;
    padding: 12px 25px;
    background-color: var(--color-dark-purple);
    color: var(--color-white);
    text-decoration: none;
    border-radius: 5px;
    font-weight: 500;
    font-size: 16px;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.mobile-menu__button:hover {
    background-color: transparent;
    border-color: var(--color-light-purple);
    color: var(--color-light-purple);
}

/* Адаптивные стили */
@media (max-width: 768px) {
    .header__logo {
        width: 140px;
    }
    
    .mobile-menu {
        width: 320px;
        padding: 50px 25px 25px;
    }
}

@media (max-width: 480px) {
    .header__logo {
        width: 120px;
    }
    
    .header {
        padding: 15px 0;
    }
    
    .mobile-menu {
        width: 280px;
        padding: 45px 20px 20px;
    }
    
    .mobile-menu__link {
        font-size: 16px;
    }
}

</style>
<header class="header">
        <div class="container header__container">
            <button class="header__account-btn">
                <i class='bx bx-user'></i>
            </button>
            
            <a href="/" class="header__logo-link">
                <img src="assets/images/logo.svg" alt="LuxRenove" class="header__logo">
            </a>
            
            <button class="header__menu-btn">
                <i class='bx bx-menu'></i>
            </button>
        </div>
    </header>

    <div class="mobile-menu">
        <button class="mobile-menu__close">
            <i class='bx bx-x'></i>
        </button>
        
        <nav class="mobile-menu__nav">
            <a href="index.php" class="mobile-menu__link">Главная</a>
            <a href="#services" class="mobile-menu__link">Услуги</a>
            <a href="#portfolio" class="mobile-menu__link">Портфолио</a>
            <a href="#reviews" class="mobile-menu__link">Отзывы</a>
            <a href="#contacts" class="mobile-menu__link">Контакты</a>
            <a href="#promo" class="mobile-menu__link">Акции и скидки</a>
        </nav>
        
        <a href="#request" class="mobile-menu__button">Заявка на ремонт</a>
    </div>

    <div class="mobile-menu-overlay"></div>
    <script>
        function initMobileMenu() {
    const menuBtn = document.querySelector('.header__menu-btn');
    const closeBtn = document.querySelector('.mobile-menu__close');
    const mobileMenu = document.querySelector('.mobile-menu');
    const overlay = document.querySelector('.mobile-menu-overlay');
    const menuLinks = document.querySelectorAll('.mobile-menu__link');
    
    function openMenu() {
        mobileMenu.classList.add('active');
        overlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeMenu() {
        mobileMenu.classList.remove('active');
        overlay.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    menuBtn?.addEventListener('click', openMenu);
    closeBtn?.addEventListener('click', closeMenu);
    overlay?.addEventListener('click', closeMenu);
    
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMenu();
        }
    });
}


    </script>