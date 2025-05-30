document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('repairRequestForm');
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
            address: form.address.value.trim(),
            square_meters: form.square_meters.value,
            repair_type: form.repair_type.value,
            description: form.description.value.trim(),
            budget: form.budget.value,
            preferred_date: form.preferred_date.value
        };

        // Валидация
        if (!validateForm(formData)) {
            return;
        }

        try {
            // Отправляем данные на сервер
            const response = await fetch('includes/send_repair_request.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            });

            const result = await response.json();

            if (result.success) {
                showMessage('success', 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.');
                form.reset();
            } else {
                showMessage('error', result.message || 'Произошла ошибка при отправке заявки.');
            }
        } catch (error) {
            showMessage('error', 'Произошла ошибка при отправке заявки. Пожалуйста, попробуйте позже.');
        }
    });

    // Функция валидации формы
    function validateForm(data) {
        // Проверка имени
        if (data.name.length < 2) {
            showMessage('error', 'Пожалуйста, введите корректное имя');
            return false;
        }

        // Проверка телефона
        const phoneRegex = /^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/;
        if (!phoneRegex.test(data.phone)) {
            showMessage('error', 'Пожалуйста, введите корректный номер телефона');
            return false;
        }

        // Проверка email, если он указан
        if (data.email && !validateEmail(data.email)) {
            showMessage('error', 'Пожалуйста, введите корректный email');
            return false;
        }

        // Проверка адреса
        if (data.address.length < 5) {
            showMessage('error', 'Пожалуйста, введите корректный адрес');
            return false;
        }

        // Проверка площади
        if (data.square_meters < 1) {
            showMessage('error', 'Пожалуйста, укажите корректную площадь помещения');
            return false;
        }

        // Проверка типа ремонта
        if (!data.repair_type) {
            showMessage('error', 'Пожалуйста, выберите тип ремонта');
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
    function showMessage(type, text) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `repair-request-page__message repair-request-page__message--${type}`;
        messageDiv.textContent = text;

        // Удаляем предыдущие сообщения
        const oldMessages = document.querySelectorAll('.repair-request-page__message');
        oldMessages.forEach(msg => msg.remove());

        // Добавляем новое сообщение
        form.insertAdjacentElement('beforebegin', messageDiv);

        // Удаляем сообщение через 5 секунд
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
}); 