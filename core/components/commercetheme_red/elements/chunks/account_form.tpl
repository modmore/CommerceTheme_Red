<div class="card">
	<div class="card-body">
		<h3 class="card-title">[[*pagetitle]]</h3>
		[[!+modx.user.id:is=`0`:then=`
		<p>You are not logged in.</p>
		[[$login_chunk]]
		<hr>
		<p><a href="[[~[[++commerce.register_resource]]]]" class="card-link">To registration page</a></p>
		`:else=`
		<p>You are logged in.</p>
		[[$ctred.profile_details]]
		`]]
	</div>
</div>