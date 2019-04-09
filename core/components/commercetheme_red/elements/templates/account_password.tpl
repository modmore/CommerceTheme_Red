[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]
<main role="main" class="container">
	<div class="row">
        <div class="col-md-6">
        	[[!ForgotPassword?
        		&resetResourceId=`[[++ctred.password_reset_page_id]]`
        		&tpl=`ctred.forgot_pass`
        		&preHooks=`csrfhelper_login`
    			&csrfKey=`changepassword`
        	]]
		</div>
		<div class="col-md-6">
			[[*content]]
		</div>
	</div>
</main>
[[$ctred.footer?
    &extra=``
]]