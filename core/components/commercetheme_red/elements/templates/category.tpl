[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <h1 class="category__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>

    [[*content]]

    <div class="row">
        [[!pdoPage?
            &parents=`[[*id]]`
            &depth=`1`
            &showHidden=`0`
            &includeTVs=`product_matrix`
            &tpl=`ctred.category_list`
            &limit=`12`
            &ajaxMode=`default`
        ]]
        <div class="col-md-12">
            [[!+page.nav]]
        </div>
    </div>

</main>

[[$ctred.footer?
    &extra=``
]]