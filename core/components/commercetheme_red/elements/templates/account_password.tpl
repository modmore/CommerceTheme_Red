[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]
<main role="main" class="container">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            
        </div>
        <div class="col-md-9 col-lg-10">
            <h1 class="category__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 col-lg-2">
            [[$ctred.profile_menu]]
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="row">
                <div class="col-md-12">
                    [[*content]]
                    [[!ForgotPassword?
                        &resetResourceId=`[[++ctred.password_reset_page_id]]`
                        &tpl=`ctred.forgot_pass`
                        &preHooks=`csrfhelper_login`
                        &csrfKey=`changepassword`
                    ]]
                </div>
            </div>
        </div>
    </div>
</main>
[[$ctred.footer?
    &extra=``
]]