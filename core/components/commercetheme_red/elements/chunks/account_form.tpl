<h1>Account</h1>
[[!+modx.user.id:is=`0`:then=`
<p>You are not logged in.</p>
<hr>
<p><a href="[[~[[++commerce.login_resource]]]]" class="btn btn-primary">To login page</a></p>
`:else=`
<p>You are logged in.</p>
[[$ctred.profile_details]]
`]]