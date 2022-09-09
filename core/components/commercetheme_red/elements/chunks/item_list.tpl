<div class="col-md-3 d-flex">
    <a class="card category-product__card" href="[[~[[+id]]]]">
        <img class="card-img-top category-product__image"
                onerror="this.style.display = 'none'"
                src="[[++ctred.product_template:eq=`[[+template]]`:then=`
                    [[!commerce.get_matrix_first_product:default=`https://via.placeholder.com/400x300?text=[[%ctred.placeholder.matrix_product_image? &namespace=`commercetheme_red`]]`?
                        &matrix=`[[+tv.product_matrix]]`
                        &withImage=`1`
                        &withStock=`0`
                        &field=`image`
                    ]]
                `:else=`
                    [[!commerce.get_product:default=`https://via.placeholder.com/400x300?text=[[%ctred.placeholder.product_list_image? &namespace=`commercetheme_red`]]`?
                        &product=`[[+tv.products]]`
                        &field=`image`
                    ]]
                `]]"
                alt="[[+pagetitle:htmlent]]">
        <div class="card-body category-product__body">
            <h5 class="card-title">
                [[+pagetitle]]
            </h5>
            <p class="card-subtitle mb-2 text-muted">
                [[- Check template so we know which TV type to use. (Product Matrix or Product List) ]]
                [[++ctred.product_template:eq=`[[+template]]`:then=`
                    [[!commerce.get_matrix_price?
                        &matrix=`[[+tv.product_matrix]]`
                        &getMin=`1`
                        &getMax=`1`
                        &inStockOnly=`1`
                    ]]
                `:else=`
                    [[!commerce.get_product?
                        &product=`[[+tv.products]]`
                        &field=`price_formatted`
                    ]]
                `]]
            </p>
        </div>
    </a>
</div>