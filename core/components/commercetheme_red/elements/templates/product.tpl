[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <div class="row equal product-top-container">
        <div class="col-md product-image">
            <div class="product-image__container">
                [[- you can set a different default image      V V V     here     V V V     ]]
                [[commerce.get_matrix_first_product:default=`https://via.placeholder.com/600x400?text=[[%ctred.placeholder.matrix_product_image? &namespace=`commercetheme_red`]]`:toPlaceholder=`first_image`?
                    &matrix=`[[*product_matrix]]`
                    &withImage=`1`
                    &withStock=`0`
                    &field=`image`
                ]]
                <img src="[[+first_image]]" data-original-image="[[+first_image]]" class="product-image__img" alt="[[*longtitle:default=`[[*pagetitle]]`:htmlent]]">
            </div>
        </div>
        <div class="col-md product-details">
            <h1 class="product-details__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
            [[*description:notempty=`
                <p class="product-details__introduction">[[*description]]</p>
            `]]

            <form method="post" action="[[~[[++commerce.cart_resource]]]]" class="product-add-to-cart add-to-cart add-to-cart__matrix">
                <input type="hidden" name="add_to_cart" value="1">
                <input type="hidden" name="link" value="[[*id]]">

                [[!commerce.get_matrix?
                    &matrix=`[[*product_matrix]]`
                    &tpl=`frontend/matrix/enhanced-select.twig`
                ]]

                <div class="d-flex align-items-center">
                    <!--<div class="col add-to-cart__sku_wrapper">
                        [[-!%commerce.sku]]
                        <span class="add-to-cart__sku"></span>
                    </div>-->


                    <div class="px-2 ml-auto add-to-cart__stock_wrapper">
                        <span class="add-to-cart__stock"></span>
                        [[!%commerce.in_stock]]
                    </div>

                    <div class="px-2 add-to-cart__price_wrapper">
                        [[-!%commerce.price]]
                        <span class="add-to-cart__price"></span>
                    </div>

                    <!--
                    <div class="px-2 add-to-cart__quantity_wrapper d-flex align-items-center">
                        <label for="product-quantity" class="my-0 pr-2">[[!%commerce.quantity]]:</label>
                        <input type="number" name="quantity" id="product-quantity" min="0" step="1" value="1" style="width: 3rem;">
                    </div>
                    -->

                    <div class="pl-2 add-to-cart__submit">
                        <button type="submit" class="btn btn-primary add-to-cart__button">[[!%commerce.add_to_cart]]</button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-3 mb-3">
            [[*content]]
        </div>
    </div>
    [[*ctred.product_tab_show:notempty=`
    <div class="row">
        <div class="col-md-12 mt-3 mb-3">
            <div class="tab_container">
                [[*ctred.product_tab_1_title:notempty=`
                <input id="tab1" type="radio" name="tabs" class="tab_input" checked>
                <label for="tab1" class="tab_label">[[*ctred.product_tab_1_title]]</label>
                `]]
                [[*ctred.product_tab_2_title:notempty=`
                <input id="tab2" type="radio" name="tabs" class="tab_input">
                <label for="tab2" class="tab_label">[[*ctred.product_tab_2_title]]</label>
                `]]
                [[*ctred.product_tab_3_title:notempty=`
                <input id="tab3" type="radio" name="tabs" class="tab_input">
                <label for="tab3" class="tab_label">[[*ctred.product_tab_3_title]]</label>
                `]]
                [[*ctred.product_tab_1_title:notempty=`
                <section id="content1" class="tab_section">
                    [[*ctred.product_tab_1_content]]
                </section>
                `]]
                [[*ctred.product_tab_2_title:notempty=`
                <section id="content2" class="tab_section">
                    [[*ctred.product_tab_2_content]]
                </section>
                `]]
                [[*ctred.product_tab_3_title:notempty=`
                <section id="content3" class="tab_section">
                    [[*ctred.product_tab_3_content]]
                </section>
                `]]
            </div>
        </div>
    </div>
    `]]
    <div class="row">
        <div class="col-md-12 mt-3 mb-3">
            <h3>Related products</h3>
        </div>
        [[pdoResources?
            &parents=`[[*parent]]`
            &where=`[[TaggerGetResourcesWhere]]`
            &tpl=`ctred.item_list`
            &includeTVs=`product_matrix,products`
            &limit=`4`
        ]]
    </div>
    <div class="row">
        [[getRelated?
            &tplOuter=`ctred.related_outer`
            &tplRow=`ctred.related_outer_list`
            &fields=`pagetitle:1,description:2,tv.product_matrix:3,tv.products:4`
            &returnFields=`pagetitle,description`
            &returnTVs=`product_matrix,products`
            &limit=`4`
            &hideContainers=`1`
        ]]
    </div>
</main>

[[$ctred.footer?
    &extra=``
]]