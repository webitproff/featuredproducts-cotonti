<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.update.done
 * [END_COT_EXT]
 */
/**
 * featuredproducts.market.edit.update.done.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.market.edit.update.done.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
 
 
defined('COT_CODE') or die('Wrong URL');

global $db, $db_market, $db_x, $cfg; // ← $page_id, $id,  — ключевой fallback для edit/update

// При редактировании существующей страницы используем $id (он всегда доступен после загрузки страницы)
$real_id = (int)($id > 0 ? $id : $page_id);

if ($real_id <= 0) {
    return; // Если ID всё равно 0 — не редактирование существующей страницы
}

$max = (int)($cfg['plugin']['featuredproducts']['maxitems'] ?? 5);
if ($max < 1) $max = 5;

$db_featuredproducts = $db_x . 'featuredproducts';

// Удаляем старые связи
$db->delete($db_featuredproducts, "pr_from_id = ?", [$real_id]);

$featured_ids = cot_import('related_id', 'P', 'ARR');

if (!is_array($featured_ids) || empty($featured_ids)) {
    return;
}

$used = [];
$order = 0;

foreach ($featured_ids as $val) {
    $rel_id = (int) trim($val);
    if ($rel_id < 1 || $rel_id == $real_id || in_array($rel_id, $used)) {
        continue;
    }

    $exists = $db->query(
        "SELECT 1 FROM $db_market WHERE fieldmrkt_id = ? AND fieldmrkt_state = 0",
        [$rel_id]
    )->fetchColumn();

    if (!$exists) continue;

    $db->insert($db_featuredproducts, [
        'pr_from_id' => $real_id,
        'pr_to_id'   => $rel_id,
        'pr_order'   => $order++
    ]);

    $used[] = $rel_id;

    if ($order >= $max) break;
}