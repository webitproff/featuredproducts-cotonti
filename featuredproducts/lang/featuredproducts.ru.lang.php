<?php
/**
 * featuredproducts.ru.lang.php - Russian language File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredproducts/lang/featuredproducts.ru.lang.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');



/**
 * Plugin Config
 */

$L['cfg_maxitems'] = 'Количество связанных товаров';
$L['cfg_maxitems_hint'] = 'Максимальное число публикаций, которые можно установить как "Рекомендуемые товары". Визуально видим при редактировании товара и на его публичной странице.';
$L['cfg_desc_length'] = 'Длина текста описания';
$L['cfg_desc_length_hint'] = 'Количество символов текста для показа в списках рекомендуемых товаров.';
$L['cfg_nonimage'] = 'Картинка-заглушка';
$L['cfg_nonimage_hint'] = 'Если товар без картинки - устанавливаем заглушку. <br>Путь по-умолчанию <code>plugins/featuredproducts/img/image.webp</code> <br>(Строго как в примере, без домена и слешей)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Рекомендуемые товары и услуги в MarketPRO';
$L['info_desc']  = 'На странице товара, показываем рекомендуемые товары, которые назначаем, при редактировании карточки этого товара.';
$L['info_notes'] = 'Только для модуля MarketPRO v.5+ 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Актуальная бесплатная версия модуля интернет-магазина и/или онлайн-рынка" class="initialism"><strong>(Скачать бесплатно с GitHub)</strong></abbr>
</a>';

$L['featuredproducts_title'] = $L['info_name']; // строка для админки
$L['featuredproducts_desc']  = $L['info_desc']; // строка для админки
$L['featuredproducts_title_item'] = 'Рекомендуемые товары и услуги'; // строка для страницы товара
$L['featuredproducts_selectpage'] = 'Начните вводить название товара...'; // строка в форме поиска рекомендуемых
$L['featuredproducts_add'] = 'Добавить ещё';
$L['featuredproducts_maxreached'] = 'Достигнут максимум связанных материалов';


// New added lines
$L['featuredproducts_item_number'] = 'Рекомендуемый товар или услуга №'; 
$L['featuredproducts_selectpage_hint'] = 'Начните вводить название страницы'; 
$L['featuredproducts_min_search'] = 'Введите минимум 2 символа для поиска страниц'; 