<!doctype html>
<html lang="[[++cultureKey]]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="[[!++site_url]]">
    <title>[[*pagetitle]] - [[++site_name]]</title>

    <link rel="stylesheet" href="[[++ctred.assets_url]]css/main.css">

    [[+extra]]
</head>
<body>

<div class="page-header container-fluid">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">[[++site_name]]</a>
            <input type="checkbox" id="navbar-toggle-cbox">
            <label for="navbar-toggle-cbox" class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbar-header">
                <span class="navbar-toggler-icon"></span>
            </label>
            <div class="collapse navbar-collapse" id="navbarText">
                [[pdoMenu?
                    &parents=`0`
                    &level=`1`
                    &outerClass=`navbar-nav ml-2 mr-auto`
                    &rowClass=`nav-item`
                    &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]] class="nav-link">[[+menutitle]]</a>[[+wrapper]]</li>`
                ]]

                [[!commerce.get_cart?
                    &itemTpl=`ctred.minicart_item`
                    &toPlaceholders=`cart`
                ]]
                <div class="navbar-text header-cart minicart" style="[[!+cart.total_quantity:eq=`0`:then=`display: none;`]]">
                    <input type="checkbox" class="minicart__toggler" id="minicart-header-toggler">
                    <label for="minicart-header-toggler" class="btn btn-primary minicart__label">
                        <span class="minicart__item-count">[[!+cart.total_quantity]]</span> items <span class="caret"></span>
                    </label>
                    <div class="minicart__wrapper bg-light text-dark">
                        <div class="minicart__header d-flex">
                            <div class="minicart__quantity-wrapper">
                                [[!%commerce.order.item_count? &quantity=`<span class="minicart__quantity">[[!+cart.total_quantity]]</span>`]]
                            </div>
                            <div class="minicart__total ml-auto pl-2">
                                <span class="minicart__total-label">[[!%commerce.total]]:</span>
                                <span class="minicart__total-value">[[!+cart.total_formatted]]</span>
                            </div>
                        </div>

                        <ul class="minicart__items"></ul>

                        <form class="minicart__footer" method="post" action="[[~[[++commerce.checkout_resource]]]]">
                            <input type="hidden" name="checkout" value="1">

                            <div class="d-flex btn-group">
                                <a href="[[~[[++commerce.cart_resource]]]]" class="btn btn-outline-primary minicart__cart">[[!%checkout.step_cart]]</a>
                                <button type="submit" href="[[~[[++commerce.checkout_resource]]]]" class="btn btn-primary flex-grow-1 minicart__checkout">[[!%commerce.checkout]]</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

    </div>
</div>

[[+showBreadcrumbs:neq=`0`:then=`
<div class="container">
    <nav aria-label="breadcrumb">
        [[pdoCrumbs?
            &tplWrapper=`@INLINE <ol class="breadcrumb">[[+output]]</ol>`
            &tpl=`@INLINE <li class="breadcrumb-item"><a href="[[+link]]">[[+menutitle]]</a></li>`
            &tplCurrent=`@INLINE <li class="breadcrumb-item active" aria-current="page">[[+menutitle]]</li>`
        ]]
    </nav>
</div>
`]]