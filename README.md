# Спортивный клуб

Курсовая работа: клиент-серверное приложение для учёта спортсменов.

## Технологии
- React (Create React App)
- PHP
- MAMP
- JSON-файл

## Запуск
1. Запусти MAMP
2. cd frontend
3. npm install
4. npm start

## Данные для входа
- admin / 123 (администратор)
- coach / 123 (тренер)
- user / 123 (спортсмен)

## API эндпоинты
- POST api.php?action=login — вход
- GET api.php?action=athletes — список спортсменов
- GET api.php?action=athlete&id={id} — спортсмен по ID
- POST api.php?action=create — создание (только admin)

## Права доступа
- Admin: полный доступ
- Coach: просмотр всех, +1 тренировка любому
- User: только свой профиль, +1 тренировка себе
