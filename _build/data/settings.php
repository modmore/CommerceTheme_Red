<?php
return [
    'assets_url' => [
        'area' => 'paths',
        'value' => '{assets_url}components/commercetheme_red/',
    ],
    'registration_please_activate_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'registration_activation_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'registration_thank_you_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'password_reset_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'account_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'logout_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'forgot_password_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'edit_profile_page_id' => [
        'area' => 'resources',
        'value' => 0,
    ],
    'category_template' => [
        'area' => 'templates',
        'value' => 0,
    ],
    'product_template' => [
        'area' => 'templates',
        'value' => 0,
    ],
    'product_list_template' => [
        'area' => 'templates',
        'value' => 0,
    ],
    'footer_header_one' => [
        'area' => 'footer',
        'value' => 'Sections',
    ],
    'footer_header_two' => [
        'area' => 'footer',
        'value' => 'Quick links',
    ],
    'quick_link_01_text' => [
        'area' => 'footer',
        'value' => 'Account',
    ],
    'quick_link_01_url' => [
        'area' => 'footer',
        'value' => '[[~[[++ctred.account_page_id]]]]',
    ],
    'quick_link_02_text' => [
        'area' => 'footer',
        'value' => 'Profile',
    ],
    'quick_link_02_url' => [
        'area' => 'footer',
        'value' => '[[~[[++ctred.edit_profile_page_id]]]]',
    ],
    'footer_content' => [
        'area' => 'footer',
        'value' => '<p>Starter Pack for Commerce named "Red", even though its accent color is blue. Open 24/7.</p>',
    ],
    'footer_bottom_row_content' => [
        'area' => 'footer',
        'value' => '<p>Powered by <a href="https://modmore.com/commerce/" target="_blank" rel="noopener">Commerce</a>.</p><p>&copy; [[!+nowdate:default=`now`:strtotime:date=`%Y`]] [[++site_name]]. All rights reserved.</p>',
    ],
];