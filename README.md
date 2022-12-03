# Учебный проект: Wall-History

---
## Системные требования
- PHP 7.4 +
- База данных MySql 8.0 COLLATE utf8_general_ci

## Установка

- выполнить команду `./init`
- Выбрать окружение `0` - dev, `1` - prod
- выполнить команду `path/to/php composer.phar install`
- В файле `common/config/main-local` произвести необходимые настройки
- выполнить команду `./yii migrate`

## Точка входа

Точка входа в данном приложении `frontend/web/index.php`