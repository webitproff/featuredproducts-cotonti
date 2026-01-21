<!-- BEGIN: MAIN -->
<div class="py-3">
	<p class="h6 mt-3">{PHP.L.featuredproducts_title_item}</p>

	<div class="list-group list-group-striped list-group-flush">
	<!-- BEGIN: FEATURED_PRODUCTS_ROW -->
		<div class="list-group-item list-group-item-action px-0">
			<div class="d-flex flex-column flex-md-row gap-3 align-items-center">

				
				<!-- IF {FEATURED_PRODUCTS_ROW_LINK_MAIN_IMAGE} -->
				<a href="{FEATURED_PRODUCTS_ROW_URL}" class="w-100 w-md-auto">
					<img
						src="{FEATURED_PRODUCTS_ROW_LINK_MAIN_IMAGE}"
						alt="{FEATURED_PRODUCTS_ROW_TITLE}"
						class="img-fluid rounded d-block mx-auto"
						style="object-fit:cover;
							   width:100%;
							   max-height:220px;
							   height:auto;"
					>
				</a>
				<!-- ENDIF -->

				<!-- CONTENT -->
				<div class="flex-grow-1 d-flex flex-column justify-content-center">
					<a href="{FEATURED_PRODUCTS_ROW_URL}" class="text-decoration-none">
						<p class="mb-1 fw-semibold">
							{FEATURED_PRODUCTS_ROW_TITLE}
						</p>
					</a>

					<div class="mb-1">
						<small class="text-secondary">
							<!-- IF {FEATURED_PRODUCTS_ROW_DESC} -->
								{FEATURED_PRODUCTS_ROW_DESC}
							<!-- ELSE -->
								{FEATURED_PRODUCTS_ROW_TEXT}
							<!-- ENDIF -->
						</small>
					</div>

					<div>
						<small>
							<a href="{FEATURED_PRODUCTS_ROW_CAT_URL}">
								{FEATURED_PRODUCTS_ROW_CAT_TITLE}
							</a>
						</small>
					</div>
				</div>

			</div>
		</div>
	<!-- END: FEATURED_PRODUCTS_ROW -->
	</div>
</div>
<!-- END: MAIN -->
