<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.tags
 * Tags=market.edit.tpl:{FEATURED_PRODUCTS_EDIT}
 * [END_COT_EXT]
 */
/**
 * featuredproducts.market.edit.tags.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.market.edit.tags.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

global $cfg, $L, $db, $db_market, $db_x; // $id,  $t

$max = (int)($cfg['plugin']['featuredproducts']['maxitems'] ?? 5);
if ($max < 1) $max = 5;

$table = $db_x . 'featuredproducts';

$related = [];
// Проверка прав администратора
if (cot::$usr['isadmin']) {
    $related = $db->query(
        "SELECT pr.pr_order, pr.pr_to_id AS id, p.fieldmrkt_title AS title
         FROM $table pr
         LEFT JOIN $db_market p ON p.fieldmrkt_id = pr.pr_to_id
         WHERE pr.pr_from_id = ?
         ORDER BY pr.pr_order ASC
         LIMIT ?",
        [$id, $max]
    )->fetchAll(PDO::FETCH_ASSOC);
} else {
    $related = $db->query(
        "SELECT pr.pr_order, pr.pr_to_id AS id, p.fieldmrkt_title AS title
         FROM $table pr
         LEFT JOIN $db_market p ON p.fieldmrkt_id = pr.pr_to_id
         WHERE pr.pr_from_id = ? AND p.fieldmrkt_ownerid = ?
         ORDER BY pr.pr_order ASC
         LIMIT ?",
        [$id, cot::$usr['id'], $max]
    )->fetchAll(PDO::FETCH_ASSOC);
}

// присваиваем шаблону имя части и/или локации расширения
$tpl_ExtCode = 'featuredproducts'; // Extentions Code
$tpl_PartExt = 'edit'; // area
$tpl_PartExtSecond = false; // location

// Загружаем шаблон для админки плагина forumspostsuser
$mskin = cot_tplfile([$tpl_ExtCode, $tpl_PartExt, $tpl_PartExtSecond], 'plug', true);

// Создаём объект шаблона XTemplate с указанным файлом шаблона в $mskin выше
// объявляем как $tt, потому что будем встраивать наш шаблон $tt в строку $t 
// $t = {FEATURED_PRODUCTS_EDIT} которую вешаем на market.edit.tags и присваиваем как тег в шаблон market.edit.tpl
$tt = new XTemplate($mskin);

for ($i = 0; $i < $max; $i++) {
    $item = $related[$i] ?? ['id' => 0, 'title' => ''];
    $tt->assign([
        'NUM' => $i + 1,
        'INDEX' => $i,
        'TO_ID' => (int)$item['id'],
        'TO_TITLE' => htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8')
    ]);
    $tt->parse('MAIN.ROW');
}

$tt->parse('MAIN');
$t->assign('FEATURED_PRODUCTS_EDIT', $tt->text('MAIN'));



Resources::linkFileFooter(Resources::SELECT2);

// Передаём в ajax-запрос ID текущей страницы и ID текущего пользователя
$ajaxUrl = cot_url('plug', [
    'r'              => 'featuredproducts',
    'ajax'           => 'search',
    'current_page_id' => $id,
    'current_user_id' => cot::$usr['id']
], '', true);

$placeholder = addslashes($L['featuredproducts_selectpage'] ?? 'Выберите страницу');

Resources::embedFooter(<<<JS
document.addEventListener('DOMContentLoaded', function () {
    $('.customrelated-select').each(function () {
        if (this.dataset.inited) return;
        this.dataset.inited = true;
        const \$select = $(this);
        const \$hidden = \$select.closest('.customrelated-row').find('.customrelated-id');
        \$select.select2({
            ajax: {
                url: '{$ajaxUrl}',
                dataType: 'json',
                delay: 300,
                data: params => ({ q: params.term || '' }),
                processResults: data => ({ results: data.results || [] }),
                cache: true
            },
            minimumInputLength: 2,
            width: '100%',
            placeholder: '{$placeholder}',
            allowClear: true,
            tags: false
        });
        // Синхронизация значения при любом изменении
        const syncValue = () => {
            \$hidden.val(\$select.val() || '');
        };
        \$select.on('change', syncValue);
        \$select.on('select2:select select2:unselect', syncValue);
        // Инициализация уже выбранного значения
        const preselectedId = \$hidden.val();
        if (preselectedId && parseInt(preselectedId) > 0) {
            let text = \$select.find('option[value="' + preselectedId + '"]').text();
            if (!text) text = 'Страница #' + preselectedId;
            const option = new Option(text, preselectedId, true, true);
            \$select.append(option).trigger('change');
        }
    });
});
JS
);