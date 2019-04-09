[[!Register?
    &submitVar=`registerbtn`
    &activationResourceId=`[[++ctred.registration_activation_page_id]]`
    &activationEmailTpl=`ctred.register_email`
    &activationEmailSubject=`Thanks for Registering!`
    &submittedResourceId=`[[++ctred.registration_please_activate_page_id]]`
    &usergroups=`Marketing,Research`
    &preHooks=`csrfhelper_login`
    &csrfKey=`register`
    &validate=`nospam:blank,username:required:minLength=^6^,password:required:minLength=^6^,password_confirm:password_confirm=^password^,fullname:required,email:required:email`
    &placeholderPrefix=`reg.`
]]
<div class="register card">
	[[!+reg.error.message:notempty=`
    <div class="alert alert-danger registerMessage" role="alert">
        [[!+reg.error.message]]
    </div>
    `]]
    <div class="card-body">
    	<h3 class="card-title">[[*pagetitle]]</h3>
	    <form class="form" action="[[~[[*id]]]]" method="post">
	    	<input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`register` &singleUse=`1`]]">
	    	<input type="hidden" name="nospam" value="[[!+reg.nospam]]" />
	    	<fieldset>
		        <div class="form-group">
			        <label for="username">[[%register.username? &namespace=`login` &topic=`register`]]
			        </label>
			        <input class="form-control [[!+reg.error.username:notempty=`is-invalid`]]" type="text" name="username" id="username" value="[[!+reg.username]]" />
			        <span class="invalid-feedback">[[!+reg.error.username]]</span>
			    </div>
			    <div class="form-group">
			        <label for="password">[[%register.password]]</label>
			        <input class="form-control [[!+reg.error.password:notempty=`is-invalid`]]" type="password" name="password" id="password" value="[[!+reg.password]]" />
			        <span class="invalid-feedback">[[!+reg.error.password]]</span>
		        </div>
			    <div class="form-group">
			        <label for="password_confirm">[[%register.password_confirm]]</label>
			        <input class="form-control [[!+reg.error.password_confirm:notempty=`is-invalid`]]" type="password" name="password_confirm" id="password_confirm" value="[[!+reg.password_confirm]]" />
			        <span class="error invalid-feedback">[[!+reg.error.password_confirm]]</span>
		        </div>
			    <div class="form-group">
			        <label for="fullname">[[%register.fullname]]</label>
			        <input class="form-control [[!+reg.error.fullname:notempty=`is-invalid`]]" type="text" name="fullname" id="fullname" value="[[!+reg.fullname]]" />
			        <span class="error invalid-feedback">[[!+reg.error.fullname]]</span>
		        </div>
			    <div class="form-group">
			        <label for="email">[[%register.email]]</label>
			        <input class="form-control [[!+reg.error.email:notempty=`is-invalid`]]" type="text" name="email" id="email" value="[[!+reg.email]]" />
			        <span class="error invalid-feedback">[[!+reg.error.email]]</span>
		        </div>
			    <div class="form-group">
			        <input class="btn btn-primary" type="submit" name="registerbtn" value="Register" />
		       	</div>
	        </fieldset>
	    </form>
	    <hr>
        <p><a href="[[~[[++ctred.account_page_id]]]]" class="card-link">Back to account page</a></p>
	</div>
</div>