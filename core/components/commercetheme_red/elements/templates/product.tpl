[[$ctred.header?
    &extra=``
    &showBreadcrumbs=`1`
]]

<main role="main" class="container">
    <div class="row equal product-top-container">
        <div class="col-md product-image">
            <div class="product-image__container">
                <img src="https://placekitten.com/600/400" data-original-image="https://placekitten.com/600/400" class="product-image__img" alt="[[*longtitle:default=`[[*pagetitle]]`:htmlent]]">
            </div>
        </div>
        <div class="col-md product-details">
            <h1 class="product-details__header">[[*longtitle:default=`[[*pagetitle]]`]]</h1>
            [[*description:notempty=`
                <p class="product-details__introduction">[[*description]]</p>
            `]]

            <form method="post" action="[[~[[++commerce.cart_resource]]]]" class="product-add-to-cart add-to-cart add-to-cart__matrix">
                <input type="hidden" name="add_to_cart" value="1">

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

    [[*content]]

    <h2>Related kittens</h2>
</main>

[[$ctred.footer?
    &extra=``
]]