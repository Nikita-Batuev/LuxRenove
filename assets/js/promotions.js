document.addEventListener('DOMContentLoaded', function() {
    // Анимация появления карточек
    const cards = document.querySelectorAll('.promotions-page__card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        observer.observe(card);
    });
});

// Функция для показа деталей акции
async function showPromoDetails(promoId) {
    try {
        const response = await fetch(`includes/get_promo.php?id=${promoId}`);
        const data = await response.json();

        if (data.success) {
            const promo = data.promo;
            const modal = document.getElementById('promoModal');
            const modalBody = modal.querySelector('.promotions-page__modal-body');

            // Формируем HTML для модального окна
            modalBody.innerHTML = `
                <div class="promotions-page__modal-image">
                    <img src="${promo.image}" alt="${promo.title}" loading="lazy">
                    <div class="promotions-page__modal-discount">${promo.discount_value}</div>
                </div>
                <h2 class="promotions-page__modal-title">${promo.title}</h2>
                <div class="promotions-page__modal-description">
                    <p>${promo.description}</p>
                </div>
                <div class="promotions-page__modal-dates">
                    <p><strong>Период действия:</strong> ${formatDate(promo.start_date)} - ${formatDate(promo.end_date)}</p>
                </div>
                <div class="promotions-page__modal-conditions">
                    <h3>Условия акции:</h3>
                    <p>${promo.conditions}</p>
                </div>
                <div class="promotions-page__modal-footer">
                    <button class="promotions-page__modal-button" onclick="window.location.href='contacts.php'">
                        Получить консультацию
                    </button>
                </div>
            `;

            // Показываем модальное окно
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';

            // Добавляем обработчики для закрытия
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
        } else {
            throw new Error(data.error || 'Ошибка при загрузке данных');
        }
    } catch (error) {
        showError(error.message);
    }
}

// Функция для закрытия модального окна
function closeModal() {
    const modal = document.getElementById('promoModal');
    modal.classList.remove('show');
    document.body.style.overflow = '';
}

// Функция для форматирования даты
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Функция для показа ошибок
function showError(message) {
    const errorDiv = document.createElement('div');
    errorDiv.className = 'promotions-page__error';
    errorDiv.textContent = message;

    document.body.appendChild(errorDiv);

    setTimeout(() => {
        errorDiv.classList.add('show');
    }, 100);

    setTimeout(() => {
        errorDiv.classList.remove('show');
        setTimeout(() => {
            errorDiv.remove();
        }, 300);
    }, 3000);
} 