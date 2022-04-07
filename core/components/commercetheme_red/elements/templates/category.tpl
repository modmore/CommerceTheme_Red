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
            <aside>
                [[pdoResources?
                    &parents=`0`
                    &context=`[[*context_key]]`
                    &where=`{"template:=":[[++ctred.category_template]]}`
                    &depth=`0`
                    &tpl=`ctred.category_list_chunk`
                    &tplWrapper=`ctred.category_list_outer_chunk`
                    &wrapIfEmpty=`0`
                ]]
                [[!TaggerGetTags?
                    &parents=`[[*id]]`
                    &rowTpl=`ctred.tag_list_chunk`
                    &outTpl=`ctred.tag_outer_chunk`
                    &wrapIfEmpty=`0`
                ]]
            </aside>
        </div>
        <div class="col-md-9 col-lg-10">
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
                    &includeTVs=`product_matrix,products`
                    &tpl=`ctred.category_list`
                    &limit=`12`
                    &ajaxMode=`default`
                    &where=`[[!TaggerGetResourcesWhere]]`
                ]]
                <div class="col-md-12">
                    [[!+page.nav]]
                </div>
            </div>
        </div>
    </div>

</main>

[[$ctred.footer?
    &extra=``
]]