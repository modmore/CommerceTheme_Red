<aside>
	[[!+modx.user.id:is=`0`:then=`
	<ul class="list-group mb-5">
		<a href="[[~[[++commerce.register_resource]]]]" class="list-group-item">[[pdoField? &id=`[[++commerce.register_resource]]` &field=`pagetitle`]]</a>
	</ul>
	`:else=`
	<ul class="list-group mb-5">
		<a href="[[~[[++ctred.account_page_id]]]]" class="list-group-item">[[pdoField? &id=`[[++ctred.account_page_id]]` &field=`pagetitle`]]</a>
		<a href="[[~[[++commerce.orders_resource]]]]" class="list-group-item">[[pdoField? &id=`[[++commerce.orders_resource]]` &field=`pagetitle`]]</a>
		<a href="[[~[[++ctred.edit_profile_page_id]]]]" class="list-group-item">[[pdoField? &id=`[[++ctred.edit_profile_page_id]]` &field=`pagetitle`]]</a>
		<a href="[[~[[++commerce.login_resource]]? &service=logout]]" class="list-group-item">Logout</a>
	</ul>
	`]]
</aside>