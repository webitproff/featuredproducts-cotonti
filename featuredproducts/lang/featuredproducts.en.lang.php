<?php
/**
 * featuredproducts.en.lang.php - English language File for the Plugin Featured Products in Market
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+
 * Filename: plugins/featuredproducts/lang/featuredproducts.en.lang.php
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

$L['cfg_maxitems'] = 'Number of related products';
$L['cfg_maxitems_hint'] = 'Maximum number of products that can be marked as "Featured". This is visible when editing a product and on its public page.';
$L['cfg_desc_length'] = 'Description length';
$L['cfg_desc_length_hint'] = 'Number of characters of the description to show in the list of featured products.';
$L['cfg_nonimage'] = 'Placeholder image';
$L['cfg_nonimage_hint'] = 'If a product has no image, a placeholder will be used. <br>Default path <code>plugins/featuredproducts/img/image.webp</code> <br>(Strictly as in the example, without the domain and slashes)';

/**
 * Plugin Info
 */
$L['info_name']  = 'Featured Products and Services in MarketPRO';
$L['info_desc']  = 'On the product page, we show featured products that we assign when editing the product card.';
$L['info_notes'] = 'For MarketPRO v.5+ module only 
<a href="https://github.com/webitproff/marketpro-cotonti" target="_blank">
<abbr title="Current free version of the online store and/or marketplace module" class="initialism"><strong>(Download for free from GitHub)</strong></abbr>
</a>';

$L['featuredproducts_title'] = $L['info_name']; // string for admin
$L['featuredproducts_desc']  = $L['info_desc']; // string for admin
$L['featuredproducts_title_item'] = 'Featured Products and Services'; // string for product page
$L['featuredproducts_selectpage'] = 'Start typing the product name...'; // string in the search form for featured products
$L['featuredproducts_add'] = 'Add another';
$L['featuredproducts_maxreached'] = 'Maximum number of related items reached';

$L['featuredproducts_item_number'] = 'Recommended product or service №'; // New line 1
$L['featuredproducts_selectpage_hint'] = 'Start typing the page name'; // New line 2
$L['featuredproducts_min_search'] = 'Enter at least 2 characters to search pages'; // New line 3
