[[+loginfp.errors:notempty=`
<div class="alert alert-danger loginFPErrors" role="alert">
    [[+loginfp.errors]]
</div>
`]]
<div class="loginFP">
    <form class="loginFPForm" action="[[~[[*id]]]]" method="post">
        <fieldset class="loginFPFieldset">
            <div class="form-group">
                <legend class="loginFPLegend">[[%login.forgot_password]]</legend>
                <label class="loginFPUsernameLabel">[[%login.username]]
                    <input class="loginFPUsername form-control" type="text" name="username" value="[[+loginfp.post.username]]" />
                </label>
            </div>
            
            <p>[[%login.or_forgot_username]]</p>
            
            <div class="form-group">
                <label class="loginFPEmailLabel">[[%login.email]]
                    <input class="loginFPEmail form-control" type="text" name="email" value="[[+loginfp.post.email]]" />
                </label>
                <input class="returnUrl" type="hidden" name="returnUrl" value="[[+loginfp.request_uri]]" />
            </div>
            
            <div class="form-group">
                <input class="loginFPService" type="hidden" name="login_fp_service" value="forgotpassword" />
                <span class="loginFPButton"><input type="submit" name="login_fp" class="btn btn-primary" value="[[%login.reset_password]]" /></span>
            </div>
        </fieldset>
    </form>
</div>
<hr>
<p><a href="[[~[[++commerce.login_resource]]]]" class="btn">Back to login page</a></p>