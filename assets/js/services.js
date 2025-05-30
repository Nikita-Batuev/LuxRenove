document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('serviceModal');
    const modalContent = modal.querySelector('.services-page__modal-body');
    const closeButton = modal.querySelector('.services-page__modal-close');
    const serviceButtons = document.querySelectorAll('.services-page__card-button');

    // Анимация появления карточек
    const cards = document.querySelectorAll('.services-page__card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        observer.observe(card);
    });

    // Обработчик клика по кнопке "Подробнее"
    serviceButtons.forEach(button => {
        button.addEventListener('click', async function() {
            const serviceId = this.dataset.serviceId;
            const card = this.closest('.services-page__card');
            
            // Добавляем эффект нажатия
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);

            try {
                const response = await fetch(`includes/get_service.php?id=${serviceId}`);
                if (!response.ok) throw new Error('Ошибка загрузки данных');
                
                const data = await response.json();
                if (data.success) {
                    showModal(data.service);
                } else {
                    throw new Error(data.message || 'Ошибка загрузки данных');
                }
            } catch (error) {
                console.error('Ошибка:', error);
                showError('Произошла ошибка при загрузке данных услуги');
            }
        });
    });

    // Функция отображения модального окна
    function showModal(service) {
        modalContent.innerHTML = `
            <div class="services-page__modal-header">
                <h2 class="services-page__modal-title">${service.title}</h2>
                <div class="services-page__modal-info">
                    ${service.price ? `
                        <div class="services-page__modal-price">
                            <i class="bx bx-ruble"></i>
                            ${new Intl.NumberFormat('ru-RU').format(service.price)}
                        </div>
                    ` : ''}
                    ${service.duration ? `
                        <div class="services-page__modal-duration">
                            <i class="bx bx-time"></i>
                            ${service.duration}
                        </div>
                    ` : ''}
                </div>
            </div>
            ${service.image ? `
                <div class="services-page__modal-image">
                    <img src="${service.image}" alt="${service.title}" loading="lazy">
                </div>
            ` : ''}
            <div class="services-page__modal-description">
                ${service.full_description}
            </div>
            <div class="services-page__modal-footer">
                <button class="services-page__modal-button" onclick="window.location.href='contact.php'">
                    Заказать услугу
                </button>
            </div>
        `;
        
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Анимация появления контента
        const modalElements = modalContent.querySelectorAll('*');
        modalElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            setTimeout(() => {
                el.style.transition = 'all 0.4s ease';
                el.style.opacity = '1';
                el.style.transform = 'translateY(0)';
            }, 100 + index * 50);
        });
    }

    // Функция отображения ошибки
    function showError(message) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'services-page__error';
        errorDiv.innerHTML = `
            <i class="bx bx-error-circle"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(errorDiv);

        setTimeout(() => {
            errorDiv.classList.add('active');
        }, 100);

        setTimeout(() => {
            errorDiv.classList.remove('active');
            setTimeout(() => {
                errorDiv.remove();
            }, 300);
        }, 3000);
    }

    // Закрытие модального окна
    function closeModal() {
        const modalElements = modalContent.querySelectorAll('*');
        modalElements.forEach((el, index) => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
        });

        setTimeout(() => {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }, 300);
    }

    // Обработчики закрытия модального окна
    closeButton.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
}); 