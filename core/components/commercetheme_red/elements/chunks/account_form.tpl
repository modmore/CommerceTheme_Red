<div class="card">
	<div class="card-body">
		[[!+modx.user.id:is=`0`:then=`
		<p>You are not logged in.</p>
		[[$ctred.login_chunk]]
		`:else=`
		<p>You are logged in.</p>
		[[$ctred.profile_details]]
		`]]
	</div>
</div>