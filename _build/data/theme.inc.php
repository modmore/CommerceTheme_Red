<?php

$componentPath = dirname(__DIR__, 2)  . '/core/components/commercetheme_red/';
$chunkPrefix = 'ctred.';
$templatePrefix = 'Red - ';

// Template Name => path/to/file.tpl
$templates = [
    $templatePrefix . 'Account' => $componentPath . 'elements/templates/account.tpl',
    $templatePrefix . 'Account - Activate registration' => $componentPath . 'elements/templates/account_activate_registration.tpl',
    $templatePrefix . 'Account - Edit profile' => $componentPath . 'elements/templates/account_edit_profile.tpl',
    $templatePrefix . 'Account - Login' => $componentPath . 'elements/templates/account_login.tpl',
    $templatePrefix . 'Account - Order' => $componentPath . 'elements/templates/account_order.tpl',
    $templatePrefix . 'Account - Orders' => $componentPath . 'elements/templates/account_orders.tpl',
    $templatePrefix . 'Account - Forgot password' => $componentPath . 'elements/templates/account_password.tpl',
    $templatePrefix . 'Account - Register' => $componentPath . 'elements/templates/account_register.tpl',
    $templatePrefix . 'Account - Thank you registration' => $componentPath . 'elements/templates/account_thank_you_registration.tpl',
    $templatePrefix . 'Account - Forgot password' => $componentPath . 'elements/templates/account_password.tpl',
    $templatePrefix . 'Cart' => $componentPath . 'elements/templates/cart.tpl',
    $templatePrefix . 'Category' => $componentPath . 'elements/templates/category.tpl',
    $templatePrefix . 'Checkout' => $componentPath . 'elements/templates/checkout.tpl',
    $templatePrefix . 'Home' => $componentPath . 'elements/templates/home.tpl',
    $templatePrefix . 'Product' => $componentPath . 'elements/templates/product.tpl',
];

// chunk.name_here => path/to/file.tpl
$chunks = [
    $chunkPrefix . 'account_form' => $componentPath . 'elements/chunks/account_form.tpl',
    $chunkPrefix . 'category_list' => $componentPath . 'elements/chunks/category_list.tpl',
    $chunkPrefix . 'category_list_chunk' => $componentPath . 'elements/chunks/category_list_chunk.tpl',
    $chunkPrefix . 'category_list_home_chunk' => $componentPath . 'elements/chunks/category_list_home_chunk.tpl',
    $chunkPrefix . 'category_list_home_outer_chunk' => $componentPath . 'elements/chunks/category_list_home_outer_chunk.tpl',
    $chunkPrefix . 'category_list_outer_chunk' => $componentPath . 'elements/chunks/category_list.tpl',
    $chunkPrefix . 'footer' => $componentPath . 'elements/chunks/footer.tpl',
    $chunkPrefix . 'forgot_pass' => $componentPath . 'elements/chunks/forgot_pass.tpl',
    $chunkPrefix . 'header' => $componentPath . 'elements/chunks/header.tpl',
    $chunkPrefix . 'item_list' => $componentPath . 'elements/chunks/item_list.tpl',
    $chunkPrefix . 'login_chunk' => $componentPath . 'elements/chunks/login_chunk.tpl',
    $chunkPrefix . 'login_form' => $componentPath . 'elements/chunks/login_form.tpl',
    $chunkPrefix . 'logout_form' => $componentPath . 'elements/chunks/logout_form.tpl',
    $chunkPrefix . 'profile_details' => $componentPath . 'elements/chunks/profile_details.tpl',
    $chunkPrefix . 'profile_menu' => $componentPath . 'elements/chunks/profile_menu.tpl',
    $chunkPrefix . 'register_email' => $componentPath . 'elements/chunks/register_email.tpl',
    $chunkPrefix . 'register_form' => $componentPath . 'elements/chunks/register_form.tpl',
    $chunkPrefix . 'related_list' => $componentPath . 'elements/chunks/related_list.tpl',
    $chunkPrefix . 'related_outer' => $componentPath . 'elements/chunks/related_outer.tpl',
    $chunkPrefix . 'related_outer_list' => $componentPath . 'elements/chunks/related_outer_list.tpl',
    $chunkPrefix . 'tag_list_chunk' => $componentPath . 'elements/chunks/tag_list_chunk.tpl',
    $chunkPrefix . 'tag_outer_chunk' => $componentPath . 'elements/chunks/tag_outer_chunk.tpl',
    $chunkPrefix . 'update_profile_form' => $componentPath . 'elements/chunks/update_profile_form.tpl',
];

// Alias => [...]
$resources = [
    'home' => [
        'setting' => 'commerce.shop_resource',
        'pagetitle' => 'Home',
        'template' => $templatePrefix . 'Home',
        'content' => '',
    ],
    'category-1' => [
        'setting' => '',
        'pagetitle' => 'Category 1',
        'template' => $templatePrefix . 'Category',
        'content' => '',
        'children' => [
            'product-foo' => [
                'setting' => '',
                'pagetitle' => 'Product Foo',
                'template' => $templatePrefix . 'Product',
                'content' => '',
                'hidemenu' => true,
            ],
        ]
    ],
    'cart' => [
        'setting' => 'commerce.cart_resource',
        'pagetitle' => 'Cart',
        'template' => $templatePrefix . 'Cart',
        'content' => '',
    ],
    'checkout' => [
        'setting' => 'commerce.checkout_resource',
        'pagetitle' => 'Checkout',
        'template' => $templatePrefix . 'Checkout',
        'content' => '',
    ],
    'signup' => [
        'setting' => 'commerce.register_resource',
        'pagetitle' => 'Signup',
        'template' => $templatePrefix . 'Account - Register',
        'content' => '',
        'hidemenu' => true,
        'children' => [
            'activate' => [
                'setting' => 'ctred.registration_activation_page_id',
                'pagetitle' => 'Activate registration',
                'template' => $templatePrefix . 'Account - Activate registration',
                'content' => '',
                'hidemenu' => true,
            ],
            'thank-you' => [
                'setting' => 'ctred.registration_thank_you_page_id',
                'pagetitle' => 'Thank you',
                'template' => $templatePrefix . 'Account - Thank you registration',
                'content' => '',
                'hidemenu' => true,
            ],
        ]
    ],
    'account' => [
        'setting' => 'ctred.account_page_id',
        'pagetitle' => 'Your Account',
        'template' => $templatePrefix . 'Account',
        'content' => '',
        'children' => [
            'login' => [
                'setting' => 'commerce.login_resource',
                'pagetitle' => 'Login',
                'template' => $templatePrefix . 'Account - Login',
                'content' => '',
                'children' => [
                    'reset' => [
                        'setting' => 'ctred.forgot_password_page_id',
                        'pagetitle' => 'Forgot password?',
                        'template' => $templatePrefix . 'Account - Forgot password',
                    ]
                ]
            ],
            'logout' => [
                'setting' => '',
                'pagetitle' => 'Login',
                'template' => $templatePrefix . 'Account - Login',
                'content' => '',
            ],
            'edit-profile' => [
                'setting' => '',
                'pagetitle' => 'Edit profile',
                'template' => $templatePrefix . 'Account - Edit profile',
                'content' => '',
            ],
            'orders' => [
                'setting' => 'commerce.orders_resource',
                'pagetitle' => 'Order History',
                'template' => $templatePrefix . 'Account - Orders',
                'content' => '',
                'children' => [
                    'detail' => [
                        'setting' => 'commerce.order_resource',
                        'pagetitle' => 'Order detail',
                        'template' => $templatePrefix . 'Account - Order',
                        'hidemenu' => true,
                        'content' => '',
                    ],
                ]
            ],
        ]
    ],
];

$packages = [
    'modmore.com' => [
        'commerce',
    ],
    'modx.com' => [
        'login',
        'csrfhelper',
        'tagger',
    ]
];

$def = [
    'template_prefix' => $templatePrefix,
    'chunk_prefix' => $chunkPrefix,
    'templates' => [],
    'chunks' => [],
    'packages' => $packages,
    'resources' => $resources,
];

foreach ($templates as $templateName => $template) {
    $content = file_get_contents($template);
    $def['templates'][$templateName] = [
        'class' => 'modTemplate',
        'primary' => ['templatename' => $templateName],
        'hash' => sha1($content),
        'content' => $content,
    ];
}

foreach ($chunks as $chunkName => $chunk) {
    $content = file_get_contents($chunk);
    $def['chunks'][$chunkName] = [
        'class' => 'modChunk',
        'primary' => ['name' => $chunkName],
        'hash' => sha1($content),
        'content' => $content,
    ];
}

return $def;
