<?php
/**
 * [BEGIN_COT_EXT]
 * Hooks=market.edit.delete.done
 * [END_COT_EXT]
 */
/**
 * featuredproducts.market.edit.delete.done.php - Registration of hooks in the system core to connect the logic of our file to the declared hook or hooks. File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: featuredproducts.market.edit.delete.done.php
 *
 * Date: Jan 21Th, 2026
 * @package featuredproducts
 * @version 2.1.2
 * @author webitproff
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff
 * @license BSD
 */
defined('COT_CODE') or die('Wrong URL');

global $db, $db_featuredproducts, $id;

if ($id > 0)
{
    $db->delete($db_featuredproducts, "pr_from_id = ? OR pr_to_id = ?", [$id, $id]);
}