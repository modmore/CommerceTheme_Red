[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <div class="row equal product-top-container">
        <div class="col-md product-image">
            <div class="product-image__container">
                [[commerce.get_product?
                    &product=`[[*products]]`
                    &toPlaceholders=`product`
                ]]
                
                [[- you can set a different default image      V V V     here     V V V     ]]
                <img src="[[+product.image:empty=`https://via.placeholder.com/600x400?text=[[%ctred.placeholder.product_list_image? &namespace=`commercetheme_red`]]`]]"
                     data-original-image="[[+product.image:empty=`https://via.placeholder.com/600x400?text=[[%ctred.placeholder.product_list_image? &namespace=`commercetheme_red`]]`]]"
                     class="product-image__img" 
                     alt="[[*longtitle:default=`[[*pagetitle]]`:htmlent]]"
                >
            </div>
        </div>
        <div class="col-md product-details">
            <h1 class="product-details__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
            [[*description:notempty=`
                <p class="product-details__introduction">[[*description]]</p>
            `]]

            <form method="post" action="[[~[[++commerce.cart_resource]]]]" class="product-add-to-cart add-to-cart add-to-cart__productlist">
                <input type="hidden" name="add_to_cart" value="1">
                <input type="hidden" name="link" value="[[*id]]">

                <div class="form-row add-to-cart__productlist">
                    <div class="product-variation form-group col-md-10">
                        <label for="add-quantity">Variation</label>
                        <select id="choose-variation" class="form-control" name="product">
                            [[!commerce.get_products?
                                &products=`[[*products]]`
                                &tpl=`ctred.product_list_option`
                            ]]
                        </select>
                    </div>
                    <div class="product-quantity form-group col-md-2">
                        <label for="add-quantity">Quantity</label>
                        <input class="form-control" type="number" id="add-quantity" name="quantity" value="1">
                    </div>
                </div>

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
            &includeTVs=`products,product_matrix`
            &limit=`4`
        ]]
    </div>
    <div class="row">
        [[getRelated?
            &tplOuter=`ctred.related_outer`
            &tplRow=`ctred.related_outer_list`
            &fields=`pagetitle:1,description:2,tv.products:3,tv.product_matrix:4`
            &returnFields=`pagetitle,description`
            &returnTVs=`products,product_matrix`
            &limit=`4`
            &hideContainers=`1`
        ]]
    </div>
</main>

[[$ctred.footer?
    &extra=``
]]