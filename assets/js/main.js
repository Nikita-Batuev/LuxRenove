// Мобильное меню


// Управление слайдером баннера
function initBannerSlider() {
    const slider = {
        currentSlide: 1,
        totalSlides: 4,
        autoplayInterval: 5000,
        autoplayTimer: null,
        isAnimating: false,
        slides: document.querySelectorAll('.banner__slide'),
        navItems: document.querySelectorAll('.banner__nav-item'),
        progressBar: document.querySelector('.banner__progress-bar'),
        banner: document.querySelector('.banner'),

        init() {
            if (!this.slides.length || !this.navItems.length || !this.progressBar || !this.banner) {
                console.warn('Не найдены необходимые элементы слайдера');
                return;
            }

            // Устанавливаем начальное состояние
            this.slides[0].classList.add('active');
            this.navItems[0].classList.add('active');
            this.progressBar.style.width = `${(1 / this.totalSlides) * 100}%`;

            // Инициализация обработчиков событий
            this.navItems.forEach(item => {
                item.addEventListener('click', () => {
                    const slideNumber = parseInt(item.dataset.slide);
                    if (!isNaN(slideNumber)) {
                        this.goToSlide(slideNumber);
                    }
                });
            });

            // Управление автопрокруткой
            this.banner.addEventListener('mouseenter', () => this.stopAutoplay());
            this.banner.addEventListener('mouseleave', () => this.startAutoplay());
            this.banner.addEventListener('touchstart', () => this.stopAutoplay());
            this.banner.addEventListener('touchend', () => this.startAutoplay());

            // Запуск автопрокрутки
            this.startAutoplay();

            // Добавляем свайп для мобильных устройств
            let touchStartX = 0;
            let touchEndX = 0;

            this.banner.addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            });

            this.banner.addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                const swipeThreshold = 50;
                if (touchEndX < touchStartX - swipeThreshold) {
                    this.nextSlide();
                } else if (touchEndX > touchStartX + swipeThreshold) {
                    this.prevSlide();
                }
            });
        },

        goToSlide(number) {
            if (this.isAnimating || number === this.currentSlide || number < 1 || number > this.totalSlides) return;
            this.isAnimating = true;

            // Обновление активного класса у слайдов
            this.slides.forEach(slide => slide.classList.remove('active'));
            this.slides[number - 1].classList.add('active');

            // Обновление навигации
            this.navItems.forEach(item => item.classList.remove('active'));
            this.navItems[number - 1].classList.add('active');

            // Обновление прогресс-бара
            this.progressBar.style.width = `${(number / this.totalSlides) * 100}%`;

            // Обновление текущего слайда
            this.currentSlide = number;

            // Сброс таймера анимации
            setTimeout(() => {
                this.isAnimating = false;
            }, 800);
        },

        prevSlide() {
            const prevSlide = this.currentSlide === 1 ? this.totalSlides : this.currentSlide - 1;
            this.goToSlide(prevSlide);
        },

        nextSlide() {
            const nextSlide = this.currentSlide === this.totalSlides ? 1 : this.currentSlide + 1;
            this.goToSlide(nextSlide);
        },

        startAutoplay() {
            if (!this.autoplayTimer) {
                this.autoplayTimer = setInterval(() => {
                    this.nextSlide();
                }, this.autoplayInterval);
            }
        },

        stopAutoplay() {
            if (this.autoplayTimer) {
                clearInterval(this.autoplayTimer);
                this.autoplayTimer = null;
            }
        }
    };

    slider.init();
}

// Инициализация всех компонентов при загрузке страницы
document.addEventListener('DOMContentLoaded', () => {
    initMobileMenu();
    initBannerSlider();
}); 