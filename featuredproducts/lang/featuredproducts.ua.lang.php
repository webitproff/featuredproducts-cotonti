<?php
/**
 * featuredproducts.ua.lang.php - Ukrainian language File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredproducts/lang/featuredproducts.ua.lang.php
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

$L['cfg_maxitems'] = 'Кількість пов’язаних товарів';
$L['cfg_maxitems_hint'] = 'Максимальна кількість товарів, які можна позначити як "Рекомендовані". Це відображається під час редагування товару та на його публічній сторінці.';
$L['cfg_desc_length'] = 'Довжина опису';
$L['cfg_desc_length_hint'] = 'Кількість символів опису, які будуть показуватися в списку рекомендованих товарів.';
$L['cfg_nonimage'] = 'Зображення-заміна';
$L['cfg_nonimage_hint'] = 'Якщо товар не має зображення, буде використано зображення-заміна. <br>Шлях за замовчуванням <code>plugins/featuredproducts/img/image.webp</code> <br>(Чітко як в прикладі, без домену та слешів)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Рекомендовані товари та послуги в MarketPRO';
$L['info_desc']  = 'На сторінці товару показуються рекомендовані товари, які ми призначаємо при редагуванні картки товару.';
$L['info_notes'] = 'Тільки для модуля MarketPRO v.5+ 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Актуальна безкоштовна версія модуля інтернет-магазину та/або онлайн-ринку" class="initialism"><strong>(Завантажити безкоштовно з GitHub)</strong></abbr>
</a>';

$L['featuredproducts_title'] = $L['info_name']; // рядок для адмінки
$L['featuredproducts_desc']  = $L['info_desc']; // рядок для адмінки
$L['featuredproducts_title_item'] = 'Рекомендовані товари та послуги'; // рядок для сторінки товару
$L['featuredproducts_selectpage'] = 'Почніть вводити назву товару...'; // рядок у формі пошуку рекомендованих
$L['featuredproducts_add'] = 'Додати ще';
$L['featuredproducts_maxreached'] = 'Досягнуто максиму пов’язаних матеріалів';

// New added lines
$L['featuredproducts_item_number'] = 'Рекомендований товар або послуга №'; // New line 1
$L['featuredproducts_selectpage_hint'] = 'Почніть вводити назву сторінки'; // New line 2
$L['featuredproducts_min_search'] = 'Введіть хоча б 2 символи для пошуку сторінок'; //