(function() {
    let cart, checkout;

    onReady(function () {
        initializeMatrixSelects();

        cart = document.querySelector('.c-checkout-cart');
        if (cart) {
            initializeCartEnhancements(cart);
        }
        checkout = document.querySelector('.c-checkout-wrapper');
        if (checkout) {
            initializeCheckoutEnhancements(checkout);
        }
        updateMiniCart();

        window.onpopstate = function() {
            if (checkout && window.location.href.indexOf(CommerceConfig.checkout_url) !== -1) {
                checkout.classList.add('commerce-loader');
                _request('GET', window.location.href, null, _handleCheckoutResponse);
            }
            else {
                window.location = window.location.href;
            }
        };
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

    function initializeCartEnhancements(cart) {
        let quantities = cart.querySelectorAll('.cart-item__quantityfld');

        if (quantities.length > 0) {
            quantities.forEach(function (quantityFld) {
                let plus = quantityFld.querySelector('.cart-item__quantityfld_plus'),
                    minus = quantityFld.querySelector('.cart-item__quantityfld_minus'),
                    input = quantityFld.querySelector('.cart-item__quantityfld_input'),
                    max = input.hasAttribute('max') ? parseInt(input.getAttribute('max')) : false,
                    updateBtn = quantityFld.querySelector('.cart-item__quantityfld_update'),
                    cartRow = quantityFld.closest('.cart-item');

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

                        updateCart();
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

                        updateCart();
                    });
                    if (input.value > 1) {
                        minus.removeAttribute('disabled');
                    }
                }
                input.addEventListener('change', updateCart);
                input.addEventListener('keypress', function(e) {
                    if (e.keyCode === 13) {
                        e.preventDefault();
                        updateCart();
                    }
                });

                if (updateBtn) {
                    updateBtn.className += ' ' + 'cart-item__quantityfld_update__hidden';
                }

                function updateCart() {
                    let oldNumbers = cartRow.querySelector('.cart-item__numbers');
                    oldNumbers.classList.add('commerce-loader');
                    _request('POST', CommerceConfig.cart_url, new FormData(input.form), _refreshCart);
                }
            });
        }

        let couponForm = cart.querySelector('.c-cart-coupon-form');
        if (couponForm) {
            couponForm.addEventListener('submit', function(e) {
                e.preventDefault();
                couponForm.classList.add('commerce-loader');
                _request('POST', CommerceConfig.cart_url, new FormData(couponForm), _refreshCart);
            });
        }

        let checkoutForms = cart.querySelectorAll('.cart__checkout');
        checkoutForms.forEach(function(checkoutForm) {
            checkoutForm.addEventListener('submit', function(e) {
                e.preventDefault();
                cart.classList.add('commerce-loader');
                _request('POST', CommerceConfig.cart_url, new FormData(checkoutForm), function(response) {
                    if (response.success && response.redirect) {
                        window.location = response.redirect;
                    }
                    else {
                        _refreshCart(response);
                        cart.classList.remove('commerce-loader');
                    }
                });
            });

        });
    }

    function _refreshCart(response) {
        let responseDom = document.createElement('div'),
            currentFocus = document.activeElement && document.activeElement.id ? document.activeElement.id : false;
        responseDom.innerHTML = response.output;

        cart.innerHTML = responseDom.innerHTML;
        initializeCartEnhancements(cart);

        if (currentFocus) {
            let newFocus = document.getElementById(currentFocus);
            if (newFocus && newFocus.focus) {
                newFocus.focus();
            }
        }

        _updateMiniCartResponse(response);
    }

    function initializeCheckoutEnhancements(checkout) {
        let forms = checkout.querySelectorAll('.checkout-form');
        forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                checkout.classList.add('commerce-loader');

                _request('POST', form.getAttribute('action'), new FormData(form), _handleCheckoutResponse);
            });
        });
    }

    function _handleCheckoutResponse(result) {
        console.log(result);

        let responseDom = document.createElement('div');
        if (result.output) {
            responseDom.innerHTML = result.output;
        }
        else {
            responseDom.innerHTML = result;
        }
        checkout.querySelector('.c-step-wrapper').innerHTML = responseDom.innerHTML;

        if (result.redirect) {
            // Account for GET or POST-style redirects
            if (result.redirect_method === 'GET') {
                // Make sure we only redirect to the same origin
                if (result.redirect.substring(0, location.origin.length) !== location.origin) {
                    window.location = result.redirect;
                }
                else {
                    window.history.pushState(null, '', result.redirect);
                    _request('GET', result.redirect, null, _handleCheckoutResponse);
                }
            }
            // For POST redirects (i.e. some payment gateways), create a dynamic form with the redirect_data and submit it
            else if (result.redirect_method === 'POST') {
                let form = document.createElement('form');
                form.setAttribute('action', result.redirect);
                form.setAttribute('method', 'POST');

                result.redirect_data.forEach(function(index, value) {
                    let input = document.createElement('input');
                    input.setAttribute('type', 'hidden');
                    input.setAttribute('name', index);
                    input.setAttribute('value', value);
                    form.appendChild(input);
                });

                checkout.appendChild(form);
                form.submit();
            }
        }
        else {
            checkout.classList.remove('commerce-loader');
        }

        initializeCheckoutEnhancements(checkout);
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
        _request('GET', CommerceConfig.cart_url, {}, _updateMiniCartResponse);
    }
    function _updateMiniCartResponse(response) {
        document.querySelectorAll('.minicart__items').forEach(function (item) {
            item.innerText = response.order.total_quantity;
        });

        let wrapper = document.querySelector('.minicart__wrapper');
        if (wrapper) {
            wrapper.style.display = response.order.total_quantity > 0 ? 'initial' : 'none';
        }
    }


    let lastRequest = null;
    function _request(method, url, data, callback, cancelLast) {
        data = data || null;
        cancelLast = typeof cancelLast !== "undefined" ? cancelLast : true;

        if (cancelLast && lastRequest) {
            lastRequest.abort();
        }

        let request = new XMLHttpRequest();
        request.open(method, url, true);
        request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        if (method === 'POST') {
            // request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        }

        request.onreadystatechange = function() {
            if (this.readyState !== 4) {
                return;
            }
            if (this.status >= 200 && this.status < 400) {
                let resp = JSON.parse(this.responseText);
                callback(resp);
            } else if (this.status > 0) { // 0 = cancelled
                console.error(this);
            }
        };

        request.send(data);
        lastRequest = request;
    }

    // Polyfill for closest()
    if (!Element.prototype.matches) {
        Element.prototype.matches = Element.prototype.msMatchesSelector ||
            Element.prototype.webkitMatchesSelector;
    }

    if (!Element.prototype.closest) {
        Element.prototype.closest = function(s) {
            var el = this;

            do {
                if (el.matches(s)) return el;
                el = el.parentElement || el.parentNode;
            } while (el !== null && el.nodeType === 1);
            return null;
        };
    }
})();