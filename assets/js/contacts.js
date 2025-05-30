document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const phoneInput = document.getElementById('phone');

    // Маска для телефона
    phoneInput.addEventListener('input', function(e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : '+7 (' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '') + (x[4] ? '-' + x[4] : '');
    });

    // Обработка отправки формы
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Собираем данные формы
        const formData = {
            name: form.name.value.trim(),
            phone: form.phone.value.trim(),
            email: form.email.value.trim(),
            message: form.message.value.trim()
        };

        // Валидация
        if (!validateForm(formData)) {
            return;
        }

        try {
            const response = await fetch('includes/send_contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.success) {
                showMessage('Сообщение успешно отправлено! Мы свяжемся с вами в ближайшее время.', 'success');
                form.reset();
            } else {
                showMessage(result.message || 'Произошла ошибка при отправке сообщения. Пожалуйста, попробуйте позже.', 'error');
            }
        } catch (error) {
            showMessage('Произошла ошибка при отправке сообщения. Пожалуйста, попробуйте позже.', 'error');
        }
    });

    // Функция валидации формы
    function validateForm(data) {
        if (!data.name) {
            showMessage('Пожалуйста, введите ваше имя', 'error');
            return false;
        }

        if (!data.phone) {
            showMessage('Пожалуйста, введите номер телефона', 'error');
            return false;
        }

        // Проверка формата телефона
        const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
        if (!phoneRegex.test(data.phone)) {
            showMessage('Пожалуйста, введите корректный номер телефона', 'error');
            return false;
        }

        if (data.email && !validateEmail(data.email)) {
            showMessage('Пожалуйста, введите корректный email', 'error');
            return false;
        }

        if (!data.message) {
            showMessage('Пожалуйста, введите ваше сообщение', 'error');
            return false;
        }

        return true;
    }

    // Функция валидации email
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    // Функция отображения сообщений
    function showMessage(message, type) {
        // Создаем элемент сообщения
        const messageElement = document.createElement('div');
        messageElement.className = `contacts-page__message contacts-page__message--${type}`;
        messageElement.textContent = message;

        // Добавляем сообщение на страницу
        document.body.appendChild(messageElement);

        // Показываем сообщение
        setTimeout(() => {
            messageElement.classList.add('show');
        }, 100);

        // Удаляем сообщение через 5 секунд
        setTimeout(() => {
            messageElement.classList.remove('show');
            setTimeout(() => {
                messageElement.remove();
            }, 300);
        }, 5000);
    }
}); 