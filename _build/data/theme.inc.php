<?php

$componentPath = dirname(__DIR__, 2)  . '/core/components/commercetheme_red/';
$chunkPrefix = 'ctred.';
$templatePrefix = 'Red - ';

$templates = [
    $templatePrefix . 'Cart' => $componentPath . 'elements/templates/cart.tpl',
    $templatePrefix . 'Category' => $componentPath . 'elements/templates/category.tpl',
    $templatePrefix . 'Checkout' => $componentPath . 'elements/templates/checkout.tpl',
    $templatePrefix . 'Product' => $componentPath . 'elements/templates/product.tpl',
    $templatePrefix . 'Account' => $componentPath . 'elements/templates/account.tpl',
    $templatePrefix . 'Account login' => $componentPath . 'elements/templates/account_login.tpl',
    $templatePrefix . 'Account register' => $componentPath . 'elements/templates/account_register.tpl',
    $templatePrefix . 'Account activate registration' => $componentPath . 'elements/templates/account_activate_registration.tpl',
    $templatePrefix . 'Account thank you registration' => $componentPath . 'elements/templates/account_thank_you_registration.tpl',
    $templatePrefix . 'Account forgot password' => $componentPath . 'elements/templates/account_password.tpl',
];

$chunks = [
    $chunkPrefix . 'category_list' => $componentPath . 'elements/chunks/category_list.tpl',
    $chunkPrefix . 'login_form' => $componentPath . 'elements/chunks/login_form.tpl',
    $chunkPrefix . 'logout_form' => $componentPath . 'elements/chunks/logout_form.tpl',
    $chunkPrefix . 'forgot_pass' => $componentPath . 'elements/chunks/forgot_pass.tpl',
    $chunkPrefix . 'account_form' => $componentPath . 'elements/chunks/account_form.tpl',
    $chunkPrefix . 'register_form' => $componentPath . 'elements/chunks/register_form.tpl',
    $chunkPrefix . 'register_email' => $componentPath . 'elements/chunks/register_email.tpl',
    $chunkPrefix . 'update_profile_form' => $componentPath . 'elements/chunks/update_profile_form.tpl',
    $chunkPrefix . 'profile_details' => $componentPath . 'elements/chunks/profile_details.tpl',
    $chunkPrefix . 'login_chunk' => $componentPath . 'elements/chunks/login_chunk.tpl',
    $chunkPrefix . 'tag_list_chunk' => $componentPath . 'elements/chunks/tag_list_chunk.tpl',
    $chunkPrefix . 'tag_outer_chunk' => $componentPath . 'elements/chunks/tag_outer_chunk.tpl',
    $chunkPrefix . 'footer' => $componentPath . 'elements/chunks/footer.tpl',
    $chunkPrefix . 'header' => $componentPath . 'elements/chunks/header.tpl',
];

// Alias => [...]
$resources = [
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
    'account' => [
        'setting' => '',
        'pagetitle' => 'Your Account',
        'template' => $templatePrefix . 'Account',
        'content' => '',
        'children' => [
            'orders' => [
                'setting' => 'commerce.orders_resource',
                'pagetitle' => 'Order History',
                'template' => $templatePrefix . 'Account orders',
                'content' => '',
            ]
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
