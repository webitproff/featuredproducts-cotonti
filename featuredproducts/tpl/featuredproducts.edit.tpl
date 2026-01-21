<!-- BEGIN: MAIN -->
<div class="customrelated-container">

    <!-- BEGIN: ROW -->
    <div class="customrelated-row mb-3">
        <label class="form-label">{PHP.L.featuredproducts_item_number} №{NUM}</label>

        <div class="input-group">
            <!-- Это поле отправляется на сервер -->
            <input type="hidden"
                   name="related_id[{INDEX}]"
                   class="customrelated-id"
                   value="{TO_ID}" />

            <!-- select ТОЛЬКО для интерфейса, name убираем полностью -->
            <select class="customrelated-select "
                    data-placeholder="{PHP.L.featuredproducts_selectpage_hint}">
                <!-- IF {TO_ID} > 0 -->
                <option value="{TO_ID}" selected>{TO_TITLE}</option>
                <!-- ENDIF -->
            </select>
        </div>

        <small class="form-text text-muted">
            {PHP.L.featuredproducts_min_search}
        </small>
    </div>
    <!-- END: ROW -->

</div>
<!-- END: MAIN -->
/**
 * featuredproducts.edit.tpl - Template File for the Plugin Featured Products in Market in edit.tpl 
 *
 * featuredproducts plugin for Cotonti 0.9.26, PHP 8.4+ 
 * Filename: featuredproducts.edit.tpl 
 *
 * Date: Jan 21Th, 2026 
 * @package featuredproducts 
 * @version 2.1.2 
 * @author webitproff 
 * @copyright Copyright (c) webitproff 2026 | https://github.com/webitproff 
 * @license BSD 
 */

display: block;
  width: 100%;
  padding: .375rem 2.25rem .375rem .75rem;
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: var(--bs-body-color);