[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]
<main role="main" class="container">
	<div class="row">
        <div class="col-md-8">
			[[!pdoPage?
				&element=`commerce.get_orders`
				&limit=`10`
			]]
			[[!+page.nav]]
		</div>
		<div class="col-md-4">
			[[*content]]
		</div>
	</div>
</main>
[[$ctred.footer?
    &extra=``
]]