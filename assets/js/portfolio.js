document.addEventListener('DOMContentLoaded', function() {
    // Элементы страницы
    const modal = document.querySelector('.portfolio-page__modal');
    const modalContent = document.querySelector('.portfolio-page__modal-content');
    const modalClose = document.querySelector('.portfolio-page__modal-close');
    const filterButtons = document.querySelectorAll('.portfolio-page__filter-button');
    const projectButtons = document.querySelectorAll('.portfolio-page__card-button');
    const cards = document.querySelectorAll('.portfolio-page__card');

    // Анимация появления карточек
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

    cards.forEach(card => observer.observe(card));

    // Обработка фильтров
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Обновляем активную кнопку
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            // Обновляем URL
            const url = new URL(window.location);
            if (category === 'all') {
                url.searchParams.delete('category');
            } else {
                url.searchParams.set('category', category);
            }
            window.history.pushState({}, '', url);

            // Анимируем карточки
            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
            });

            // Фильтруем и показываем карточки
            setTimeout(() => {
                cards.forEach(card => {
                    if (category === 'all' || card.dataset.category === category) {
                        card.style.display = 'block';
                        observer.observe(card);
                    } else {
                        card.style.display = 'none';
                    }
                });
            }, 300);
        });
    });

    // Обработка клика по кнопке проекта
    projectButtons.forEach(button => {
        button.addEventListener('click', async function(e) {
            e.preventDefault();
            const projectId = this.dataset.projectId;
            
            try {
                // Добавляем эффект нажатия
                this.style.transform = 'scale(0.95)';
                setTimeout(() => this.style.transform = '', 150);

                // Загружаем данные проекта
                const response = await fetch(`includes/get_project.php?id=${projectId}`);
                if (!response.ok) throw new Error('Ошибка загрузки данных');
                
                const project = await response.json();
                showModal(project);
            } catch (error) {
                showError('Не удалось загрузить информацию о проекте');
            }
        });
    });

    // Функция показа модального окна
    function showModal(project) {
        // Заполняем контент
        modalContent.innerHTML = `
            <button class="portfolio-page__modal-close">&times;</button>
            <div class="portfolio-page__modal-body">
                <h2 class="portfolio-page__modal-title">${project.title}</h2>
                <div class="portfolio-page__modal-info">
                    <div class="portfolio-page__modal-category">
                        <i class="fas fa-tag"></i> ${project.category}
                    </div>
                    <div class="portfolio-page__modal-area">
                        <i class="fas fa-ruler-combined"></i> ${project.area} м²
                    </div>
                    <div class="portfolio-page__modal-duration">
                        <i class="fas fa-clock"></i> ${project.duration}
                    </div>
                </div>
                <div class="portfolio-page__modal-description">
                    ${project.description}
                </div>
                <div class="portfolio-page__modal-gallery">
                    ${project.images.map(image => `
                        <div class="portfolio-page__modal-gallery-item">
                            <img src="${image}" alt="${project.title}" loading="lazy">
                        </div>
                    `).join('')}
                </div>
                <div class="portfolio-page__modal-client">
                    <h3>Информация о клиенте</h3>
                    <p>${project.client}</p>
                </div>
            </div>
        `;

        // Показываем модальное окно
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Добавляем обработчики для галереи
        const galleryItems = modalContent.querySelectorAll('.portfolio-page__modal-gallery-item');
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                const img = this.querySelector('img');
                const lightbox = document.createElement('div');
                lightbox.className = 'portfolio-page__lightbox';
                lightbox.innerHTML = `
                    <div class="portfolio-page__lightbox-content">
                        <img src="${img.src}" alt="${img.alt}">
                        <button class="portfolio-page__lightbox-close">&times;</button>
                    </div>
                `;
                document.body.appendChild(lightbox);
                
                // Закрытие лайтбокса
                const closeLightbox = () => {
                    lightbox.remove();
                };
                
                lightbox.querySelector('.portfolio-page__lightbox-close').addEventListener('click', closeLightbox);
                lightbox.addEventListener('click', (e) => {
                    if (e.target === lightbox) closeLightbox();
                });
            });
        });
    }

    // Функция показа ошибки
    function showError(message) {
        const error = document.createElement('div');
        error.className = 'portfolio-page__error';
        error.textContent = message;
        document.body.appendChild(error);
        
        setTimeout(() => {
            error.classList.add('show');
            setTimeout(() => {
                error.classList.remove('show');
                setTimeout(() => error.remove(), 300);
            }, 3000);
        }, 100);
    }

    // Закрытие модального окна
    function closeModal() {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Обработчики закрытия модального окна
    modalClose.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModal();
        }
    });
}); 