[[!UpdateProfile?
    &excludeExtended=`email:required:email,login-updprof-btn`
    &useExtended=`1`
    &preHooks=`csrfhelper_login`
    &csrfKey=`updateprofile`
]]
<div class="update-profile">
    [[+error.message:notempty=`
    <div class="alert alert-danger updprof-error" role="alert">
        [[+error.message]]
    </div>
    `]]

    [[+login.update_success:if=`[[+login.update_success]]`:is=`1`:then=`
    <div class="alert alert-success" role="alert">
        [[%login.profile_updated? &namespace=`login` &topic=`updateprofile`]]
    </div>
    `]]
  
    <form class="form" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`updateprofile` &singleUse=`1`]]">
        <div class="form-group">
            <input type="hidden" name="nospam:blank" value="" />
            <label for="fullname">[[!%login.fullname? &namespace=`login` &topic=`updateprofile`]]
                <span class="error">[[+error.fullname]]</span>
            </label>
            <input type="text" name="fullname" id="fullname" value="[[+fullname]]" class="form-control" />
        </div>
        <div class="form-group">
            <label for="email">[[!%login.email]]
                <span class="error">[[+error.email]]</span>
            </label>
            <input type="text" name="email:required:email" id="email" value="[[+email]]" class="form-control" />
        </div>
        <div class="form-group">
            <div class="form-buttons">
                <input type="submit" name="login-updprof-btn" value="[[!%login.update_profile]]" class="btn btn-primary" />
            </div>
        </div>
    </form>
</div>
<hr>
<p><a href="[[~8]]" class="btn">Back to account page</a></p>