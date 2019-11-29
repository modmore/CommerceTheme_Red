<?php

$componentPath = dirname(__DIR__, 2)  . '/core/components/commercetheme_red/';
$chunkPrefix = 'ctred.';
$namespace = 'commercetheme_red';
$templatePrefix = 'Red - ';
$category = 'Red';

// Template Name => path/to/file.tpl
$templates = [
    $templatePrefix . 'Account' => [
        'file' => $componentPath . 'elements/templates/account.tpl',
    ],
    $templatePrefix . 'Account - Activate registration' => [
        'file' => $componentPath . 'elements/templates/account_activate_registration.tpl',
    ],
    $templatePrefix . 'Account - Edit profile' => [
        'file' => $componentPath . 'elements/templates/account_edit_profile.tpl',
    ],
    $templatePrefix . 'Account - Login' => [
        'file' => $componentPath . 'elements/templates/account_login.tpl',
    ],
    $templatePrefix . 'Account - Order' => [
        'file' => $componentPath . 'elements/templates/account_order.tpl',
    ],
    $templatePrefix . 'Account - Orders' => [
        'file' => $componentPath . 'elements/templates/account_orders.tpl',
    ],
    $templatePrefix . 'Account - Forgot password' => [
        'file' => $componentPath . 'elements/templates/account_password.tpl',
    ],
    $templatePrefix . 'Account - Register' => [
        'file' => $componentPath . 'elements/templates/account_register.tpl',
    ],
    $templatePrefix . 'Account - Thank you registration' => [
        'file' => $componentPath . 'elements/templates/account_thank_you_registration.tpl',
    ],
    $templatePrefix . 'Account - Forgot password' => [
        'file' => $componentPath . 'elements/templates/account_password.tpl',
    ],
    $templatePrefix . 'Cart' => [
        'file' => $componentPath . 'elements/templates/cart.tpl',
    ],
    $templatePrefix . 'Category' => [
        'file' => $componentPath . 'elements/templates/category.tpl',
        'setting' => 'ctred.category_template',
        'template_variables' => [
            'ctred_category_image' => [
                'type' => 'image',
                'caption' => 'Category image'
            ],
        ]
    ],
    $templatePrefix . 'Checkout' => [
        'file' => $componentPath . 'elements/templates/checkout.tpl',
    ],
    $templatePrefix . 'Home' => [
        'file' => $componentPath . 'elements/templates/home.tpl',
        'template_variables' => [
            'ctred.hero_image' => [
                'type' => 'image',
                'caption' => 'Hero (background) image',
            ],
            'ctred.hero_content' => [
                'type' => 'richtext',
                'caption' => 'Hero content'
            ],
        ],
    ],
    $templatePrefix . 'Product' => [
        'file' => $componentPath . 'elements/templates/product.tpl',
        'setting' => 'ctred.product_template',
        'template_variables' => [
            'product_matrix' => [
                'type' => 'commerce_matrix',
                'caption' => 'Products',
            ],
            'ctred.hero_content' => [
                'type' => 'richtext',
                'caption' => 'Hero content'
            ],
            'ctred_featured_product' => [
                'type' => 'textfield', //@todo checkbox? select yes/no?
                'caption' => 'Featured product',
                'description' => 'Makes this product a feature product, which will be shown on the homepage.'
            ],
            'ctred.product_tab_show' => [
                'type' => 'textfield', //@todo checkbox? select yes/no?
                'caption' => 'Show tab section',
                'description' => 'Enter true to show the tabs.',
            ],
            'ctred.product_tab_1_title' => [
                'type' => 'textfield',
                'caption' => 'Tab 1 title',
                'description' => 'Leave blank to hide the tab.',
            ],
            'ctred.product_tab_1_content' => [
                'type' => 'richtext',
                'caption' => 'Tab 1 content',
            ],
            'ctred.product_tab_2_title' => [
                'type' => 'textfield',
                'caption' => 'Tab 2 title',
                'description' => 'Leave blank to hide the tab.',
            ],
            'ctred.product_tab_2_content' => [
                'type' => 'richtext',
                'caption' => 'Tab 2 content',
            ],
            'ctred.product_tab_3_title' => [
                'type' => 'textfield',
                'caption' => 'Tab 3 title',
                'description' => 'Leave blank to hide the tab.',
            ],
            'ctred.product_tab_3_content' => [
                'type' => 'richtext',
                'caption' => 'Tab 3 content',
            ],
        ],
    ],
];

// chunk.name_here => path/to/file.tpl
$chunks = [
    $chunkPrefix . 'account_form' => $componentPath . 'elements/chunks/account_form.tpl',
    $chunkPrefix . 'category_list' => $componentPath . 'elements/chunks/category_list.tpl',
    $chunkPrefix . 'category_list_chunk' => $componentPath . 'elements/chunks/category_list_chunk.tpl',
    $chunkPrefix . 'category_list_home_chunk' => $componentPath . 'elements/chunks/category_list_home_chunk.tpl',
    $chunkPrefix . 'category_list_home_outer_chunk' => $componentPath . 'elements/chunks/category_list_home_outer_chunk.tpl',
    $chunkPrefix . 'category_list_outer_chunk' => $componentPath . 'elements/chunks/category_list_outer_chunk.tpl',
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
        'hidemenu' => true,
        'children' => [],
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
            ],
        ]
    ],
    'cart' => [
        'setting' => 'commerce.cart_resource',
        'pagetitle' => 'Cart',
        'template' => $templatePrefix . 'Cart',
        'content' => '',
        'hidemenu' => true,
        'children' => [],
    ],
    'checkout' => [
        'setting' => 'commerce.checkout_resource',
        'pagetitle' => 'Checkout',
        'template' => $templatePrefix . 'Checkout',
        'content' => '',
        'hidemenu' => true,
        'children' => [],
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
                'children' => [],
            ],
            'thank-you' => [
                'setting' => 'ctred.registration_thank_you_page_id',
                'pagetitle' => 'Thank you',
                'template' => $templatePrefix . 'Account - Thank you registration',
                'content' => '',
                'hidemenu' => true,
                'children' => [],
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
                    'forgot' => [
                        'setting' => 'ctred.forgot_password_page_id',
                        'pagetitle' => 'Forgot password?',
                        'template' => $templatePrefix . 'Account - Forgot password',
                    ],
                    'reset' => [
                        'setting' => 'ctred.password_reset_page_id',
                        'pagetitle' => 'Reset Password',
                        'template' => $templatePrefix . 'Account - Forgot password',
                    ],
                ]
            ],
            'logout' => [
                'setting' => 'ctred.logout_page_id',
                'pagetitle' => 'Logout',
                'template' => $templatePrefix . 'Account - Login',
                'content' => '',
                'children' => [],
            ],
            'edit-profile' => [
                'setting' => 'ctred.edit_profile_page_id',
                'pagetitle' => 'Edit profile',
                'template' => $templatePrefix . 'Account - Edit profile',
                'content' => '',
                'children' => [],
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
        'pdotools',
        'login',
        'csrfhelper',
        'tagger',
        'getrelated',
    ]
];

$def = [
    'category' => $category,
    'template_prefix' => $templatePrefix,
    'chunk_prefix' => $chunkPrefix,
    'namespace' => $namespace,
    'templates' => [],
    'chunks' => [],
    'packages' => $packages,
    'resources' => $resources,
];

foreach ($templates as $templateName => $template) {
    $content = file_get_contents($template['file']);
    $def['templates'][$templateName] = [
        'class' => 'modTemplate',
        'primary' => ['templatename' => $templateName],
        'hash' => sha1($content),
        'content' => $content,
        'file' => $template['file'],
        'template_variables' => array_key_exists('template_variables', $template) ? $template['template_variables'] : [],
        'setting' => array_key_exists('setting', $template) ? $template['setting'] : '',
    ];
}

foreach ($chunks as $chunkName => $chunk) {
    $content = file_get_contents($chunk);
    $def['chunks'][$chunkName] = [
        'class' => 'modChunk',
        'primary' => ['name' => $chunkName],
        'hash' => sha1($content),
        'content' => $content,
        'file' => $chunk,
    ];
}

return $def;
