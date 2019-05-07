[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`0`
]]

<div class="jumbotron jumbotron-fluid" style="background-image: url([[*ctred.hero_image]]);">
    <div class="container">
        [[*ctred.hero_content]]
    </div>
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-12">
            [[*content]]
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Featured products</h3>
        </div>
        [[!pdoResources?
            &parents=`0`
            &tpl=`ctred.item_list`
            &includeTVs=`product_matrix,ctred_featured_product`
            &limit=`4`
            &where=`{"ctred_featured_product":"true"}` 
            &prepareTVs=`1`
        ]]
    </div>
</main>

[[$ctred.footer?
    &extra=``
]]