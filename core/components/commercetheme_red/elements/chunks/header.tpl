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

<div class="container-fluid bg-dark mb-4">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="#">[[++site_name]]</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                [[pdoMenu?
                    &parents=`0`
                    &level=`1`
                    &outerClass=`navbar-nav ml-2 mr-auto`
                    &rowClass=`nav-item`
                    &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]] class="nav-link">[[+menutitle]]</a>[[+wrapper]]</li>`
                ]]

                <div class="navbar-text header-cart">
                    [[!commerce.get_cart? &toPlaceholders=`cart`]]
                    [[!+cart.total_quantity:notempty=`
                        <a href="[[~[[++commerce.cart_resource]]]]" class="btn btn-primary">
                            [[!+cart.total_quantity]] items in cart
                        </a>
                    `:default=`
                        <em>Cart is empty.</em>
                    `]]
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