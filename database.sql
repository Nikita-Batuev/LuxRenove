CREATE DATABASE IF NOT EXISTS luxrenove;
USE luxrenove;

CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    project VARCHAR(255) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
    text TEXT NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
);

-- Создаем таблицу услуг
CREATE TABLE IF NOT EXISTS services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    short_description TEXT NOT NULL,
    full_description TEXT NOT NULL,
    image VARCHAR(255),
    price DECIMAL(10,2),
    duration VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Добавляем тестовые данные
INSERT INTO services (title, short_description, full_description, image, price, duration) VALUES
('Ремонт квартир под ключ', 
'Полный комплекс ремонтных работ от черновой отделки до финишного декора', 
'Наша компания предлагает полный комплекс ремонтных работ для вашей квартиры. Мы выполняем все этапы ремонта: от демонтажа старых покрытий до финальной уборки. Наши специалисты имеют многолетний опыт и используют только качественные материалы. Мы гарантируем соблюдение сроков и высокое качество работ.',
'assets/images/services/remont-kvartir.jpg',
150000.00,
'2-3 месяца'),

('Дизайн интерьера', 
'Профессиональное проектирование и оформление жилых и коммерческих помещений', 
'Наши дизайнеры создадут уникальный интерьер, который будет отражать вашу индивидуальность. В услугу входит: разработка концепции, создание 3D-визуализации, подбор материалов и мебели, авторский надзор за реализацией проекта. Мы учитываем все ваши пожелания и создаем функциональное и эстетичное пространство.',
'assets/images/services/design-interior.jpg',
80000.00,
'1-2 месяца'),

('Электрика и сантехника', 
'Монтаж и замена электрических и сантехнических систем любой сложности', 
'Мы выполняем полный спектр работ по электрике и сантехнике: монтаж новых систем, замена старых коммуникаций, установка сантехнического оборудования, прокладка электропроводки, установка розеток и выключателей. Все работы выполняются с соблюдением норм безопасности и с использованием качественных материалов.',
'assets/images/services/electrics-plumbing.jpg',
45000.00,
'2-4 недели'),

('Отделочные работы', 
'Качественная отделка помещений с использованием современных материалов', 
'Выполняем все виды отделочных работ: штукатурка, шпаклевка, покраска, поклейка обоев, укладка плитки, настил полов. Используем только проверенные материалы от ведущих производителей. Гарантируем аккуратность и качество выполнения работ.',
'assets/images/services/finishing.jpg',
60000.00,
'1-2 месяца'),

('Мебель на заказ', 
'Изготовление и установка мебели по индивидуальным размерам и дизайну', 
'Мы изготавливаем мебель любой сложности: кухни, шкафы-купе, гардеробные, встроенная мебель. Используем качественные материалы и фурнитуру. Предоставляем бесплатный замер и 3D-визуализацию. Гарантируем точное соответствие размерам и высокое качество сборки.',
'assets/images/services/custom-furniture.jpg',
120000.00,
'3-4 недели');

-- Тестовые данные
INSERT INTO reviews (name, project, rating, text, image, status) VALUES
('Анна К.', 'Ремонт квартиры 85м²', 5, 'Невероятно профессиональная команда! Ремонт квартиры выполнен в срок и с безупречным качеством. Особенно впечатлило внимание к деталям и постоянная связь с прорабом.', 'author-1.jpg', 'approved'),
('Михаил П.', 'Ремонт кухни 25м²', 4, 'Заказывали ремонт кухни. Результат превзошел все ожидания! Современный дизайн, качественные материалы и профессиональный подход к работе.', 'author-2.jpg', 'approved'),
('Елена С.', 'Ремонт ванной 12м²', 5, 'Отличная работа по ремонту ванной комнаты. Все сделано аккуратно, в срок и с учетом всех пожеланий. Рекомендую!', 'author-3.jpg', 'approved'),
('Дмитрий В.', 'Ремонт коттеджа 200м²', 3, 'Хорошая работа, но были небольшие задержки в сроках. В целом результатом доволен.', 'author-4.jpg', 'approved'),
('Ольга М.', 'Дизайн-проект квартиры', 5, 'Потрясающий дизайн-проект! Учли все наши пожелания и предложили интересные решения. Спасибо за креативный подход!', 'author-5.jpg', 'approved');

-- Создаем таблицу портфолио
CREATE TABLE IF NOT EXISTS portfolio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    category VARCHAR(100) NOT NULL,
    area DECIMAL(10,2),
    duration VARCHAR(50),
    client VARCHAR(255),
    main_image VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Создаем таблицу для изображений портфолио
CREATE TABLE IF NOT EXISTS portfolio_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    portfolio_id INT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    sort_order INT DEFAULT 0,
    FOREIGN KEY (portfolio_id) REFERENCES portfolio(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Добавляем тестовые данные
INSERT INTO portfolio (title, description, category, area, duration, client, main_image) VALUES
('Современная квартира в центре города', 
'Полный ремонт трехкомнатной квартиры в современном стиле. Включает демонтаж, черновую отделку, электрику, сантехнику, финишную отделку и установку мебели.',
'Квартиры',
85.5,
'3 месяца',
'Частный заказчик',
'assets/images/portfolio/modern-apartment-1.jpg'),

('Загородный дом в классическом стиле', 
'Ремонт и отделка двухэтажного загородного дома. Включает внутреннюю и внешнюю отделку, ландшафтный дизайн и благоустройство территории.',
'Загородные дома',
250.0,
'6 месяцев',
'Семья Ивановых',
'assets/images/portfolio/country-house-1.jpg'),

('Офисное пространство в стиле лофт', 
'Ремонт и перепланировка офисного помещения. Создание современного рабочего пространства с зонами отдыха и переговоров.',
'Коммерческие помещения',
180.0,
'2 месяца',
'IT-компания "ТехноСофт"',
'assets/images/portfolio/office-loft-1.jpg'),

('Дизайнерская кухня-гостиная', 
'Ремонт и дизайн кухни-гостиной в современном стиле. Включает демонтаж, перепланировку, отделку и установку встроенной мебели.',
'Кухни',
45.0,
'1.5 месяца',
'Частный заказчик',
'assets/images/portfolio/kitchen-living-1.jpg'),

('Спа-комплекс в коттедже', 
'Создание спа-комплекса с сауной, бассейном и зоной отдыха. Включает гидроизоляцию, отделку и установку специального оборудования.',
'Спа и бассейны',
60.0,
'2 месяца',
'Частный заказчик',
'assets/images/portfolio/spa-complex-1.jpg');

-- Добавляем дополнительные изображения для проектов
INSERT INTO portfolio_images (portfolio_id, image_path, sort_order) VALUES
(1, 'assets/images/portfolio/modern-apartment-2.jpg', 1),
(1, 'assets/images/portfolio/modern-apartment-3.jpg', 2),
(1, 'assets/images/portfolio/modern-apartment-4.jpg', 3),
(2, 'assets/images/portfolio/country-house-2.jpg', 1),
(2, 'assets/images/portfolio/country-house-3.jpg', 2),
(2, 'assets/images/portfolio/country-house-4.jpg', 3),
(3, 'assets/images/portfolio/office-loft-2.jpg', 1),
(3, 'assets/images/portfolio/office-loft-3.jpg', 2),
(3, 'assets/images/portfolio/office-loft-4.jpg', 3),
(4, 'assets/images/portfolio/kitchen-living-2.jpg', 1),
(4, 'assets/images/portfolio/kitchen-living-3.jpg', 2),
(4, 'assets/images/portfolio/kitchen-living-4.jpg', 3),
(5, 'assets/images/portfolio/spa-complex-2.jpg', 1),
(5, 'assets/images/portfolio/spa-complex-3.jpg', 2),
(5, 'assets/images/portfolio/spa-complex-4.jpg', 3);

-- Обновляем таблицу контактной информации
DROP TABLE IF EXISTS contact_info;
CREATE TABLE IF NOT EXISTS contact_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('address', 'phone', 'email', 'social', 'schedule', 'messenger') NOT NULL,
    title VARCHAR(255) NOT NULL,
    value TEXT NOT NULL,
    icon VARCHAR(50),
    sort_order INT DEFAULT 0,
    status ENUM('active', 'inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Добавляем обновленные данные для контактной информации
INSERT INTO contact_info (type, title, value, icon, sort_order) VALUES
('address', 'Главный офис', 'г. Москва, ул. Ленина, д. 42, офис 305', 'bx-map', 1),
('phone', 'Телефон', '+7 (495) 123-45-67', 'bx-phone', 2),
('phone', 'Мобильный', '+7 (999) 123-45-67', 'bx-mobile', 3),
('email', 'Email', 'info@luxrenove.ru', 'bx-envelope', 4),
('email', 'Поддержка', 'support@luxrenove.ru', 'bx-support', 5),
('messenger', 'WhatsApp', '+7 (999) 123-45-67', 'bxl-whatsapp', 6),
('messenger', 'Telegram', '@luxrenove', 'bxl-telegram', 7),
('social', 'Instagram', 'https://instagram.com/luxrenove', 'bxl-instagram', 8),
('social', 'VK', 'https://vk.com/luxrenove', 'bxl-vk', 9),
('schedule', 'Режим работы офиса', 'Пн-Пт: 9:00 - 20:00\nСб-Вс: 10:00 - 18:00', 'bx-time', 10),
('schedule', 'Время работы бригад', 'Ежедневно: 8:00 - 22:00', 'bx-time-five', 11);

-- Создаем таблицу для обратной связи
CREATE TABLE IF NOT EXISTS contact_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('new', 'in_progress', 'completed', 'rejected') DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Создаем таблицу для акций и скидок
CREATE TABLE IF NOT EXISTS promotions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    discount_value VARCHAR(50) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    image VARCHAR(255),
    conditions TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Добавляем тестовые данные для акций
INSERT INTO promotions (title, description, discount_value, start_date, end_date, image, conditions) VALUES
('Ремонт под ключ со скидкой 20%', 
'Полный комплекс ремонтных работ с максимальной скидкой. Включает все этапы от черновой отделки до финишного декора.',
'20%',
'2024-03-01',
'2024-04-30',
'assets/images/promotions/remont-sale.jpg',
'Акция действует при заказе ремонта от 50м². Скидка не распространяется на материалы.'),

('Бесплатный дизайн-проект', 
'При заказе ремонта под ключ дизайн-проект в подарок! Создадим уникальный интерьер специально для вас.',
'100%',
'2024-03-01',
'2024-05-31',
'assets/images/promotions/design-free.jpg',
'Акция действует при заказе ремонта от 100м². Дизайн-проект включает 3D-визуализацию и подбор материалов.'),

('Скидка на отделочные работы', 
'Специальное предложение на все виды отделочных работ. Качественные материалы и профессиональное исполнение.',
'15%',
'2024-03-15',
'2024-04-15',
'assets/images/promotions/finishing-sale.jpg',
'Акция действует на все виды отделочных работ. Скидка не распространяется на материалы.'),

('Весенняя распродажа', 
'Встречайте весну с обновленным интерьером! Специальные цены на все услуги компании.',
'25%',
'2024-03-20',
'2024-04-20',
'assets/images/promotions/spring-sale.jpg',
'Акция действует на все услуги компании. Максимальная скидка при заказе от 3 услуг.'),

('Скидка на электрику и сантехнику', 
'Профессиональный монтаж электрики и сантехники со скидкой. Гарантия качества и безопасности.',
'10%',
'2024-03-10',
'2024-05-10',
'assets/images/promotions/electrics-sale.jpg',
'Акция действует на монтаж электрики и сантехники. Скидка не распространяется на материалы и оборудование.');

-- Таблица для заявок на ремонт
CREATE TABLE IF NOT EXISTS repair_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    address TEXT NOT NULL,
    square_meters DECIMAL(10,2) NOT NULL,
    repair_type ENUM('cosmetic', 'capital', 'designer') NOT NULL,
    description TEXT,
    budget DECIMAL(10,2),
    preferred_date DATE,
    status ENUM('new', 'in_progress', 'completed', 'cancelled') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Создание таблицы для сообщений
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(255),
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 