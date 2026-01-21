<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=ajax
 * [END_COT_EXT]
 */
/**
 * featuredproducts.ajax.php - AJAX search for featured roducts in market.edit.tpl
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.ajax.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */

defined('COT_CODE') or die('Wrong URL');

header('Content-Type: application/json; charset=UTF-8');

$q = cot_import('q', 'G', 'TXT');
$q = trim($q);

if (mb_strlen($q) < 2) {
    echo json_encode(['results' => []]);
    exit;
}

// Получаем параметры фильтрации из GET-запроса
$current_page_id = cot_import('current_page_id', 'G', 'INT');
$current_user_id = cot_import('current_user_id', 'G', 'INT');

global $db, $db_market;

$like = '%' . mb_strtolower($q) . '%';

// Базовые условия
$where = "fieldmrkt_state = 0 AND LOWER(fieldmrkt_title) LIKE ?";
$params = [$like];


// 2. Исключаем саму редактируемую страницу
if ($current_page_id > 0) {
    $where .= " AND fieldmrkt_id != ?";
    $params[] = $current_page_id;
}

// 2.1. Только страницы текущего автора, если это не администратор
if ($current_user_id > 0 && !cot::$usr['isadmin']) {
    $where .= " AND fieldmrkt_ownerid = ?";
    $params[] = $current_user_id;
}

$rows = $db->query(
    "SELECT fieldmrkt_id AS id, fieldmrkt_title AS text
     FROM $db_market
     WHERE $where
     ORDER BY fieldmrkt_date DESC
     LIMIT 50",
    $params
)->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as &$row) {
    $row['id'] = (int)$row['id'];
    $row['text'] = (string)$row['text'];
}

echo json_encode(
    ['results' => $rows],
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);

exit;