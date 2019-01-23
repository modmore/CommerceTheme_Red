[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <h1 class="category__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>

    [[*content]]

    <div class="row">
        [[pdoResources?
            &parents=`[[*id]]`
            &depth=`1`
            &showHidden=`0`
            &includeTVs=`product_matrix`

            &tpl=`ctred.category_list`
            &limit=`12`
        ]]
    </div>

</main>

[[$ctred.footer?
    &extra=``
]]