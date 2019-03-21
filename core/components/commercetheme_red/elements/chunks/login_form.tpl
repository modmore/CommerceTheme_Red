<div class="loginForm">
    [[+errors:notempty=`
    <div class="alert alert-danger loginMessage" role="alert">
        [[+errors]]
    </div>
    `]]
    <div class="loginLogin">
        <form class="loginLoginForm" action="[[~[[*id]]]]" method="post">
            <fieldset class="loginLoginFieldset">
                <div class="form-group">
                    <legend class="loginLegend">[[+actionMsg]]</legend>
                    <label class="loginUsernameLabel">[[%login.username]]
                        <input class="loginUsername form-control" type="text" name="username" />
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="loginPasswordLabel">[[%login.password]]
                        <input class="loginPassword form-control" type="password" name="password" />
                    </label>
                    <input class="returnUrl" type="hidden" name="returnUrl" value="[[+request_uri]]" />
                </div>

                <div class="form-group">
                    [[+login.recaptcha_html]]
                </div>
                
                <div class="form-group">
                    <input class="loginLoginValue form-control" type="hidden" name="service" value="login" />
                    <span class="loginLoginButton"><input type="submit" name="Login" value="[[+actionMsg]]" class="btn btn-primary" /></span>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<hr>
<p><a href="[[~15]]" class="btn">Forgot your Password?</a> <a href="[[~8]]" class="btn">Back to account page</a></p>