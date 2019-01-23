(function() {
    onReady(function () {
        initializeMatrixSelects();
        initializeCartEnhancements();
        updateMiniCart()
    });

    function onReady (callback) {
        if (document.readyState !== 'loading') {
            callback();
        }
        else if (document.addEventListener) {
            document.addEventListener('DOMContentLoaded', callback);
        }
        else {
            document.attachEvent('onreadystatechange', function() {
                if (document.readyState !== 'loading') {
                    callback();
                }
            });
        }
    }

    function initializeCartEnhancements() {
        let quantities = document.querySelectorAll('.cart-item__quantityfld');

        if (quantities.length > 0) {
            quantities.forEach(function (quantityFld) {
                let plus = quantityFld.querySelector('.cart-item__quantityfld_plus'),
                    minus = quantityFld.querySelector('.cart-item__quantityfld_minus'),
                    input = quantityFld.querySelector('.cart-item__quantityfld_input'),
                    max = input.hasAttribute('max') ? parseInt(input.getAttribute('max')) : false;

                // Don't bother if there's no input
                if (!input) {
                    return;
                }

                if (plus) {
                    plus.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (!max || input.value <= max - 2) {
                            input.value = parseInt(input.value) + 1;
                        }
                        else {
                            input.value = max;
                            plus.setAttribute('disabled', 'disabled')
                        }

                        if (minus && input.value > 1) {
                            minus.removeAttribute('disabled');
                        }
                    });
                    plus.removeAttribute('disabled');
                }
                if (minus) {
                    minus.addEventListener('click', function(e) {
                        e.preventDefault();
                        if (input.value > 2) {
                            input.value = parseInt(input.value) - 1;
                        }
                        else {
                            input.value = 1;
                            minus.setAttribute('disabled', 'disabled');
                        }

                        if (plus && max && input.value < max) {
                            plus.removeAttribute('disabled');
                        }
                    });
                    if (input.value > 1) {
                        minus.removeAttribute('disabled');
                    }
                }

            });
        }
    }

    function initializeMatrixSelects() {
        let matrixSelector = document.querySelectorAll('.add-to-cart__matrix');

        if (matrixSelector.length > 0) {
            matrixSelector.forEach(function (matrixForm) {
                let priceDisplay = matrixForm.querySelector('.add-to-cart__price'),
                    stockDisplay = matrixForm.querySelector('.add-to-cart__stock'),
                    skuDisplay = matrixForm.querySelector('.add-to-cart__sku'),
                    rowSelect = matrixForm.querySelector('.add-to-cart__matrix_rowselect'),
                    colSelect = matrixForm.querySelector('.add-to-cart__matrix_colselect'),
                    colOptions = colSelect.querySelectorAll('option'),

                    // Note: global search outside the matrix
                    imageDisplay = document.querySelector('.product-image__img');

                colOptions.forEach(function(colOpt) {
                    let name = colOpt.getAttribute('data-enhanced-name');
                    if (name !== '') {
                        colOpt.innerHTML = name;
                    }
                });

                updateColumnOptions();
                rowSelect.addEventListener('change', updateColumnOptions);
                colSelect.addEventListener('change', updateSelectedProduct);

                function updateColumnOptions() {
                    let selectedRow = rowSelect.value,
                        targetClass = 'matrix-row-' + selectedRow + '-product',
                        firstAvlOpt = '';

                    colOptions.forEach(function (colOpt, index) {
                        if (colOpt.value === '' || colOpt.className.indexOf(targetClass) !== -1) {
                            colOpt.style.display = 'initial';
                            if (firstAvlOpt === '') {
                                firstAvlOpt = colOpt.value;
                            }
                        }
                        else {
                            colOpt.style.display = 'none';
                        }
                    });
                    colSelect.value = firstAvlOpt;
                    updateSelectedProduct();
                }

                function updateSelectedProduct() {
                    let opt = colSelect.options[colSelect.selectedIndex];
                    if (opt) {
                        if (priceDisplay) {
                            priceDisplay.innerHTML = opt.getAttribute('data-price-formatted');
                        }
                        if (stockDisplay) {
                            stockDisplay.innerHTML = opt.getAttribute('data-stock');
                        }
                        if (skuDisplay) {
                            skuDisplay.innerHTML = opt.getAttribute('data-sku');
                        }
                        if (imageDisplay) {
                            let image = opt.getAttribute('data-image');
                            if (!image) {
                                image = imageDisplay.getAttribute('data-original-image');
                            }
                            if (image !== imageDisplay.src) {
                                let fakeImg = document.createElement('img');
                                fakeImg.addEventListener('load', function () {
                                    imageDisplay.src = this.src;
                                    this.remove();
                                });
                                fakeImg.src = image;
                            }
                        }
                    }
                }

            });
        }
    }

    function updateMiniCart() {
        if (!window.fetch) {
            alert('Sorry, fetch() is not supported.');
        }


    }
})();