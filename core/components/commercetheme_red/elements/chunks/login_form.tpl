<div class="loginForm card">
    [[+errors:notempty=`
    <div class="alert alert-danger loginMessage" role="alert">
        [[+errors]]
    </div>
    `]]
    <div class="loginLogin card-body">
        <form class="loginLoginForm" action="[[~[[*id]]]]" method="post">
            <input type="hidden" name="csrf_token" value="[[!csrfhelper? &key=`login` &singleUse=`1`]]">
            <input class="returnUrl" type="hidden" name="returnUrl" value="[[+request_uri]]" />
            <fieldset class="loginLoginFieldset">
                <div class="form-group">
                    <legend class="loginLegend card-title">[[+actionMsg]]</legend>
                    <label for="loginInputUsername" class="loginUsernameLabel">[[%login.username]]</label>
                    <input class="loginUsername form-control" type="text" name="username" id="loginInputUsername" />
                </div>
                <div class="form-group">
                    <label for="loginInputPassword" class="loginPasswordLabel">[[%login.password]]</label>
                    <input class="loginPassword form-control" type="password" name="password" id="loginInputPassword" />
                </div>
                <div class="form-group">
                    [[+login.recaptcha_html]]
                </div>
                <div class="form-group">
                    <input class="loginLoginValue form-control" type="hidden" name="service" value="login" />
                    <input type="submit" name="Login" value="[[+actionMsg]]" class="btn btn-primary" />
                </div>
            </fieldset>
            <p><small><a href="[[~[[++ctred.forgot_password_page_id]]]]" class="card-link">Forgot your Password?</a></small></p>
            <hr>
            <p><a href="[[~[[++commerce.register_resource]]]]" class="card-link">To registration page</a> <a href="[[~[[++ctred.account_page_id]]]]" class="card-link">Back to account page</a></p>
        </form>
    </div>
</div>