<?php
/* ====================
[BEGIN_COT_EXT]
Code=featuredproducts
Name=Featured Products in Market
Category=
Description=
Version=2.1.2
Date=Jan 21Th, 2026
Author=webitproff
Copyright=(c) webitproff 2026 | https://github.com/webitproff
Notes=
Auth_guests=R
Lock_guests=WA
Auth_members=RW
Lock_members=A
Requires_modules=market
Requires_plugins=
Recommends_modules=
Recommends_plugins=
[END_COT_EXT]

[BEGIN_COT_EXT_CONFIG]
maxitems=01:select:0,1,2,3,5,8:3:Максимальное количество связанных материалов
desc_length=02:select:0,50,75,100,150,200,300:100:Длина краткого описания в блоке рекомендаций (символов)
nonimage=11:string::plugins/featuredproducts/img/image.webp:Default image path plugins/featuredproducts/img/image.webp (no domain)
[END_COT_EXT_CONFIG]
==================== */


/**
 * featuredproducts.setup.php - Register data in $db_core and $db_config. Setup & Config File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.setup.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL.');

/**
Разбор полей:

    Code: Уникальный код плагина, в данном случае featuredproducts.
    Name: Название плагина, например, Featured Products in Market.
    Category: Категория, к которой относится плагин.
    Description: Описание плагина, например, 
    Version: Версия плагина, например, 1.0.0.
    Date: Дата выпуска текущей версии плагина, например, 2025-02-27.
    Author: Автор плагина. Здесь можно указать ваше имя или компанию.
    Copyright: Авторские права, например, ваше имя или название вашей компании.
    Notes: Лицензия плагина. В данном случае BSD License.
    SQL: Если плагин использует SQL-таблицы, то укажите путь к SQL-скрипту. Если нет, оставьте пустым.
    Auth_guests: (Auth_guests=R) Права доступа для гостей, например, R — доступ только для чтения.
    Lock_guests: (Lock_guests=WA) Лок (лок - даже админ не поправит в админке) для гостей, например, 12345A — защищает от несанкционированного доступа.
    Auth_members: (Auth_members=RW) Права доступа для зарегистрированных пользователей, например, RW — чтение и запись.
    Lock_members: (Lock_members=A )Лок для зарегистрированных пользователей, например, 12345A.
    Recommends_modules: Модули, которые рекомендуется использовать с плагином (если применимо).
    Recommends_plugins: Плагины, которые рекомендуется использовать с плагином (если применимо).
    Requires_modules: Модули, которые необходимы для работы плагина. В данном случае, page, так как плагин работает со статьями.
    Requires_plugins: Плагины, которые необходимы для работы плагина (если применимо). Если нет, оставьте пустым.

 */
