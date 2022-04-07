<div class="col-md-3 d-flex">
    <a class="card category-product__card" href="[[~[[+id]]]]">
        <img class="card-img-top category-product__image"
                onerror="this.style.display = 'none'"
                src="[[++ctred.product_template:eq=`[[+template]]`:then=`
                    [[!commerce.get_matrix_first_product?
                        &matrix=`[[+product_matrix]]`
                        &withImage=`1`
                        &withStock=`0`
                        &field=`image`
                    ]]
                `:else=`
                    [[!commerce.get_product?
                        &product=`[[+products]]`
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
                        &matrix=`[[+product_matrix]]`
                        &getMin=`1`
                        &getMax=`1`
                        &inStockOnly=`1`
                    ]]
                `:else=`
                    [[!commerce.get_product?
                        &product=`[[+products]]`
                        &field=`price_formatted`
                    ]]
                `]]
            </p>
        </div>
    </a>
</div>