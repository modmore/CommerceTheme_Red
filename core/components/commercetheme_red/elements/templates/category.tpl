[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="category__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
        </div>
        <div class="col-md-6">
            [[!TaggerGetTags?
                &parents=`[[*id]]`
                &rowTpl=`ctred.tag_list_chunk`
                &outTpl=`ctred.tag_outer_chunk`
                &wrapIfEmpty=`0`
            ]]
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            [[*content]]
        </div>
    </div>
    <div class="row">
        [[!pdoPage?
            &parents=`[[*id]]`
            &depth=`1`
            &showHidden=`0`
            &includeTVs=`product_matrix`
            &tpl=`ctred.category_list`
            &limit=`12`
            &ajaxMode=`default`
            &where=`[[!TaggerGetResourcesWhere]]`
        ]]
        <div class="col-md-12">
            [[!+page.nav]]
        </div>
    </div>

</main>

[[$ctred.footer?
    &extra=``
]]