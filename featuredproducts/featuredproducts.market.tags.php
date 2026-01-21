<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.tags
 * Tags=market.tpl:{FEATURED_PRODUCTS_PAGES}
 * [END_COT_EXT]
 */
/**
 * featuredproducts.market.tags.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.market.tags.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
// Этот файл является точкой входа для подключения тегов плагина Featured Products in Market в шаблон страницы (market.tpl)
// Регистрируется через хук market.tags и отвечает за генерацию блока {PAGE_CUSTOMRELATED} в шаблоне
// Основная задача — выводить список специально назначенных, "вручную" заданных, рекомендуемых товаров для текущего товара

// Защита от прямого обращения к файлу через браузер — стандартная проверка Cotonti
defined('COT_CODE') or die('Wrong URL');

// Объявляем глобальные объекты базы данных и таблиц, которые будем использовать в этом скрипте
// $db_i18n4marketpro_pages добавлен специально для поддержки многоязычных переводов страниц (плагин i18n)
global $db, $db_market, $db_users, $db_i18n4marketpro_pages;

// Локализация интерфейса
// Подключаем языковой файл плагина, чтобы иметь доступ к переводам строк интерфейса
// require_once cot_langfile('featuredproducts', 'plug'); // уже подключили в featuredproducts.functions.php

// Функции плагина
// Подключаем основной файл функций и настроек плагина Featured Products in Market
require_once cot_incfile('featuredproducts', 'plug');

// Инициализируем переменные, которые будут хранить основную информацию о текущей странице
// Эти значения будут заполняться ниже в зависимости от контекста
$page_id = 0;
$page_owner_name = '';
$page_url = '';

// Проверяем, передан ли массив $item — это основной массив данных текущей страницы в Cotonti
// Если массив существует и является корректным, начинаем извлекать из него ключевые поля
if (isset($item) && is_array($item)) {

    // Приводим fieldmrkt_id к целому числу — это основной идентификатор страницы в базе
    $page_id = isset($item['fieldmrkt_id']) ? (int)$item['fieldmrkt_id'] : 0;

    // Определяем текущую языковую локаль пользователя или берём значение по умолчанию из конфига
    $current_locale = Cot::$usr['lang'] ?? Cot::$cfg['defaultlang'];

    // Проверяем, активен ли плагин i18n, отличается ли текущая локаль от дефолтной и есть ли ID страницы
    // Если условия выполняются — пытаемся подгрузить перевод текущей страницы
    if (cot_plugin_active('i18n') && $current_locale !== Cot::$cfg['defaultlang'] && $page_id > 0) {

        // Запрос к таблице переводов страниц для получения заголовка, описания и текста на нужном языке
        $translation = $db->query(
            "SELECT ipage_title, ipage_desc, ipage_text
             FROM $db_i18n4marketpro_pages
             WHERE ipage_id = ? AND ipage_locale = ?",
            [$page_id, $current_locale]
        )->fetch(PDO::FETCH_ASSOC);

        // Если перевод найден — заменяем значения в массиве $item на переведённые
        if ($translation) {
            if (!empty($translation['ipage_title'])) $item['fieldmrkt_title'] = $translation['ipage_title'];
            if (!empty($translation['ipage_desc'])) $item['fieldmrkt_desc'] = $translation['ipage_desc'];
            if (!empty($translation['ipage_text'])) $item['fieldmrkt_text'] = $translation['ipage_text'];
        }
    }
}

// Формируем как переменную имя таблицы плагина featuredproducts с учётом префикса базы данных
$table = $db_x . 'featuredproducts';

// Читаем из конфигурации плагина максимальное количество связанных страниц для вывода
$max_featured = (int) ($cfg['plugin']['featuredproducts']['maxitems'] ?? 5);

// Ограничиваем длину описания связанных страниц — минимум 40 символов, по умолчанию около 160
$desc_len = (int) ($cfg['plugin']['featuredproducts']['desc_length'] ?? 160);
if ($desc_len < 40) $desc_len = 120;

// Инициализируем пустой массив, в который будут помещены данные связанных страниц
$featured_pages = [];

// Проверяем наличие категории у текущей страницы — без неё нет смысла искать связи
if (isset($item['fieldmrkt_cat']) && !empty($item['fieldmrkt_cat'])) {

    // Основной запрос: получаем связанные страницы через связующую таблицу featuredproducts
    // Учитываем только опубликованные страницы (fieldmrkt_state = 0), сортируем по заданному порядку
    $featured_pages = $db->query(
        "SELECT
            p.fieldmrkt_id,
            p.fieldmrkt_title,
            p.fieldmrkt_desc,
            p.fieldmrkt_text,
            p.fieldmrkt_cat,
            p.fieldmrkt_alias
         FROM $table pr
         INNER JOIN $db->market p ON p.fieldmrkt_id = pr.pr_to_id
         WHERE pr.pr_from_id = ?
           AND p.fieldmrkt_state = 0
         ORDER BY pr.pr_order ASC
         LIMIT ?",
        [$item['fieldmrkt_id'], $max_featured]
    )->fetchAll();
}

// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode = 'featuredproducts'; // Extentions Code
$tpl_PartExt = 'market'; // area
$tpl_PartExtSecond = false; // location

// Загружаем шаблон для админки плагина forumspostsuser
$mskin = cot_tplfile([$tpl_ExtCode, $tpl_PartExt, $tpl_PartExtSecond], 'plug', true);

// Создаём объект шаблона XTemplate с указанным файлом шаблона в $mskin выше
// объявляем как $tt, потому что будем встраивать наш шаблон $tt в строку $t 
// $t = {FEATURED_PRODUCTS_PAGES} которую вешаем на market.tags и присваиваем как тег в шаблон market.tpl
$tt = new XTemplate($mskin);

// Если рекомендуемые товары найдены — начинаем подготовку блока в шаблоне
if (!empty($featured_pages)) {

    // Устанавливаем флаг наличия рекомендуемых товаров — может использоваться в шаблоне при проверках
    $t->assign('FEATURED_PRODUCTS_TRUE', true);

    // Проходим по каждой связанной странице и подготавливаем теги для строки списка
    foreach ($featured_pages as $featured_page) {

        // Приводим ID связанной страницы к целому числу для безопасной работы
        $featured_id = (int)($featured_page['fieldmrkt_id'] ?? 0);

        // Если i18n4marketpro активен и локаль отличается от дефолтной — пытаемся подгрузить перевод
        if (cot_plugin_active('i18n4marketpro') && $current_locale !== Cot::$cfg['defaultlang'] && $featured_id > 0) {

            // Запрос перевода заголовка, описания и текста для данной страницы и языка
            $rel_translation = $db->query(
                "SELECT ipage_title, ipage_desc, ipage_text
                 FROM $db_i18n4marketpro_pages
                 WHERE ipage_id = ? AND ipage_locale = ?",
                [$featured_id, $current_locale]
            )->fetch(PDO::FETCH_ASSOC);

            // При наличии перевода заменяем значения в массиве текущей итерации
            if ($rel_translation) {
                if (!empty($rel_translation['ipage_title'])) $featured_page['fieldmrkt_title'] = $rel_translation['ipage_title'];
                if (!empty($rel_translation['ipage_desc'])) $featured_page['fieldmrkt_desc'] = $rel_translation['ipage_desc'];
                if (!empty($rel_translation['ipage_text'])) $featured_page['fieldmrkt_text'] = $rel_translation['ipage_text'];
            }
        }

        // Получаем название категории текущей (главной) страницы с учётом перевода i18n4marketpro_structure
        $category_code = $item['fieldmrkt_cat'] ?? '';
        if (!empty($category_code)) {

            // Сначала пытаемся найти перевод категории в таблице i18n4marketpro_structure
            if (cot_plugin_active('i18n4marketpro') && $current_locale !== Cot::$cfg['defaultlang']) {
                $cat_translation = $db->query(
                    "SELECT istructure_title FROM $db_i18n4marketpro_structure
                     WHERE istructure_code = ? AND istructure_locale = ?",
                    [$category_code, $current_locale]
                )->fetchColumn();
                if ($cat_translation) {
                    $page_category_name = htmlspecialchars($cat_translation, ENT_QUOTES, 'UTF-8');
                }
            }

            // Если перевода нет — берём оригинальное название из таблицы structure
            if (empty($page_category_name)) {
                $category_name_result = $db->query(
                    "SELECT structure_title FROM $db_structure WHERE structure_code = ? AND structure_area = 'market'",
                    [$category_code]
                )->fetchColumn();
                $page_category_name = !empty($category_name_result)
                    ? htmlspecialchars($category_name_result, ENT_QUOTES, 'UTF-8')
                    : htmlspecialchars($category_code, ENT_QUOTES, 'UTF-8');
            }
        }

        // Получаем ссылку на главное изображение связанной страницы (функция плагина)
        $featured_image = get_featuredproducts_main_first_image($featured_page['fieldmrkt_id'] ?? 0);
		
		// Формируем финальное описание: берем desc или text, очищаем и обрезаем до 160 символов
		$descriptionText = $featured_page['fieldmrkt_text'] ?? '';
		$page_market_text = cot_string_truncate(featuredproducts_descriptionText_cleaning($descriptionText), 160, true, false);

        // Формируем корректный URL страницы — через alias, если он есть, иначе через ID
        $featured_url = (isset($featured_page['fieldmrkt_alias']) && !empty($featured_page['fieldmrkt_alias']))
            ? cot_url('market', 'c=' . $featured_page['fieldmrkt_cat'] . '&al=' . $featured_page['fieldmrkt_alias'])
            : cot_url('market', 'id=' . ($featured_page['fieldmrkt_id'] ?? 0));

        // Заполняем все необходимые теги для одной строки блока связанных материалов
        $tt->assign([
            'FEATURED_PRODUCTS_ROW_URL' => htmlspecialchars($featured_url, ENT_QUOTES, 'UTF-8'),
            'FEATURED_PRODUCTS_ROW_TITLE' => htmlspecialchars($featured_page['fieldmrkt_title'] ?? '', ENT_QUOTES, 'UTF-8'),
            'FEATURED_PRODUCTS_ROW_TEXT' => htmlspecialchars($page_market_text, ENT_QUOTES, 'UTF-8'),
            'FEATURED_PRODUCTS_ROW_DESC' => htmlspecialchars(
                cot_string_truncate(strip_tags($featured_page['fieldmrkt_desc'] ?? ''), $desc_len, true, false),
                ENT_QUOTES,
                'UTF-8'
            ),
            'FEATURED_PRODUCTS_ROW_CAT_TITLE' => htmlspecialchars($page_category_name, ENT_QUOTES, 'UTF-8'),
            'FEATURED_PRODUCTS_ROW_CAT_URL' => cot_url('market', 'c=' . $item['fieldmrkt_cat'], '', true),
            'FEATURED_PRODUCTS_ROW_LINK_MAIN_IMAGE' => htmlspecialchars($featured_image, ENT_QUOTES, 'UTF-8'),
        ]);

        // Парсим строку списка связанных страниц внутри цикла
        $tt->parse('MAIN.FEATURED_PRODUCTS_ROW');
    }

    // После обработки всех строк парсим основной блок
	// это содержимое нашего featuredproducts.market.tpl
    $tt->parse('MAIN');
	// ложим теперь весь наш featuredproducts.market.tpl в тег {FEATURED_PRODUCTS_PAGES} для шаблона market.tpl
	$t->assign('FEATURED_PRODUCTS_PAGES', $tt->text('MAIN'));

} else 
{
	return;
}
