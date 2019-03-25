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
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Filter by category:</a>
                </li>
                <li class="nav-item">
                    <a href="[[~[[*id]]]]" class="nav-link">All</a>
                </li>
                [[!TaggerGetTags? &rowTpl=`ctred.tag_list_chunk`]]
            </ul>
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