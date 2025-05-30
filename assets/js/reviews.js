document.addEventListener('DOMContentLoaded', function() {
    // Элементы страницы
    const sortSelect = document.getElementById('sort');
    const ratingButtons = document.querySelectorAll('.reviews-page__rating-buttons a');
    const reviewForm = document.querySelector('.reviews-page__form');
    const imageInput = document.getElementById('image');
    const imagePreview = document.querySelector('.reviews-page__image-preview');
    const ratingInputs = document.querySelectorAll('.reviews-page__rating-input input[type="radio"]');
    const ratingLabels = document.querySelectorAll('.reviews-page__rating-input label');

    const slider = document.querySelector('.reviews__slider');
    const track = document.querySelector('.reviews__track');
    const slides = document.querySelectorAll('.reviews__slide');
    const prevButton = document.querySelector('.reviews__prev');
    const nextButton = document.querySelector('.reviews__next');
    const dotsContainer = document.querySelector('.reviews__dots');

    let currentIndex = 0;
    const slidesToShow = window.innerWidth > 992 ? 3 : window.innerWidth > 768 ? 2 : 1;
    const totalSlides = slides.length;

    // Создаем точки навигации
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('reviews__dot');
        if (index === 0) dot.classList.add('active');
        dot.addEventListener('click', () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = document.querySelectorAll('.reviews__dot');

    // Функция для перехода к определенному слайду
    function goToSlide(index) {
        currentIndex = index;
        const offset = -currentIndex * (100 / slidesToShow);
        track.style.transform = `translateX(${offset}%)`;
        
        // Обновляем активную точку
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === currentIndex);
        });
    }

    // Обработчики для кнопок навигации
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        goToSlide(currentIndex);
    });

    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % totalSlides;
        goToSlide(currentIndex);
    });

    // Автоматическое переключение слайдов
    let autoplayInterval = setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        goToSlide(currentIndex);
    }, 5000);

    // Останавливаем автопереключение при наведении
    slider.addEventListener('mouseenter', () => {
        clearInterval(autoplayInterval);
    });

    // Возобновляем автопереключение при уходе курсора
    slider.addEventListener('mouseleave', () => {
        autoplayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % totalSlides;
            goToSlide(currentIndex);
        }, 5000);
    });

    // Обработка изменения размера окна
    window.addEventListener('resize', () => {
        const newSlidesToShow = window.innerWidth > 992 ? 3 : window.innerWidth > 768 ? 2 : 1;
        if (newSlidesToShow !== slidesToShow) {
            goToSlide(0);
        }
    });

    // Анимация появления элементов при загрузке страницы
    const animateElements = () => {
        const cards = document.querySelectorAll('.reviews-page__card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 100);
            }, index * 100);
        });
    };

    // Сортировка отзывов
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', this.value);
            window.location.href = currentUrl.toString();
        });
    }

    // Фильтрация по рейтингу
    ratingButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const currentUrl = new URL(window.location.href);
            const rating = this.getAttribute('href').split('rating=')[1];
            
            if (rating === 'all') {
                currentUrl.searchParams.delete('rating');
            } else {
                currentUrl.searchParams.set('rating', rating);
            }
            
            window.location.href = currentUrl.toString();
        });
    });

    // Обработка формы отзыва
    if (reviewForm) {
        reviewForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('.reviews-page__submit');
            const originalButtonText = submitButton.textContent;
            
            try {
                // Показываем состояние загрузки
                submitButton.disabled = true;
                submitButton.textContent = 'Отправка...';
                
                const response = await fetch('includes/submit_review.php', {
                    method: 'POST',
                    body: formData
                });
                
                const result = await response.json();
                
                // Создаем элемент для сообщения
                const messageElement = document.createElement('div');
                messageElement.className = result.success ? 'reviews-page__success' : 'reviews-page__error';
                messageElement.textContent = result.message;
                
                // Вставляем сообщение перед формой
                reviewForm.parentNode.insertBefore(messageElement, reviewForm);
                
                if (result.success) {
                    // Очищаем форму
                    reviewForm.reset();
                    imagePreview.innerHTML = '';
                    
                    // Обновляем страницу через 2 секунды
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                }
                
                // Удаляем сообщение через 3 секунды
                setTimeout(() => {
                    messageElement.remove();
                }, 3000);
                
            } catch (error) {
                console.error('Ошибка:', error);
                alert('Произошла ошибка при отправке отзыва. Пожалуйста, попробуйте позже.');
            } finally {
                // Восстанавливаем кнопку
                submitButton.disabled = false;
                submitButton.textContent = originalButtonText;
            }
        });
    }

    // Обработка загрузки изображения
    if (imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            
            if (file) {
                // Проверяем тип файла
                if (!file.type.startsWith('image/')) {
                    alert('Пожалуйста, выберите изображение');
                    this.value = '';
                    return;
                }
                
                // Проверяем размер файла (5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Размер изображения не должен превышать 5MB');
                    this.value = '';
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    imagePreview.innerHTML = `
                        <img src="${e.target.result}" alt="Предпросмотр">
                        <button type="button" class="reviews-page__remove-image">
                            <i class="bx bx-x"></i>
                        </button>
                    `;
                    
                    // Добавляем обработчик для кнопки удаления
                    const removeButton = imagePreview.querySelector('.reviews-page__remove-image');
                    removeButton.addEventListener('click', function() {
                        imageInput.value = '';
                        imagePreview.innerHTML = '';
                    });
                };
                
                reader.readAsDataURL(file);
            }
        });
    }

    // Улучшенный выбор рейтинга
    ratingInputs.forEach((input, index) => {
        input.addEventListener('change', function() {
            // Обновляем стили для всех звезд
            ratingLabels.forEach((label, i) => {
                if (i <= index) {
                    label.style.color = 'var(--color-light-purple)';
                    label.style.transform = 'scale(1.2)';
                } else {
                    label.style.color = '#ddd';
                    label.style.transform = 'scale(1)';
                }
            });
        });
        
        // Добавляем эффект при наведении
        ratingLabels[index].addEventListener('mouseenter', function() {
            ratingLabels.forEach((label, i) => {
                if (i <= index) {
                    label.style.color = 'var(--color-light-purple)';
                    label.style.transform = 'scale(1.2)';
                }
            });
        });
        
        ratingLabels[index].addEventListener('mouseleave', function() {
            const checkedInput = document.querySelector('.reviews-page__rating-input input[type="radio"]:checked');
            if (checkedInput) {
                const checkedIndex = Array.from(ratingInputs).indexOf(checkedInput);
                ratingLabels.forEach((label, i) => {
                    if (i <= checkedIndex) {
                        label.style.color = 'var(--color-light-purple)';
                        label.style.transform = 'scale(1.2)';
                    } else {
                        label.style.color = '#ddd';
                        label.style.transform = 'scale(1)';
                    }
                });
            } else {
                ratingLabels.forEach(label => {
                    label.style.color = '#ddd';
                    label.style.transform = 'scale(1)';
                });
            }
        });
    });

    // Запускаем анимацию при загрузке страницы
    animateElements();
}); 