<?php
/* Get the core config */
if (!file_exists(dirname(dirname(__FILE__)).'/config.core.php')) {
    die('ERROR: missing '.dirname(dirname(__FILE__)).'/config.core.php file defining the MODX core path.');
}

/* Boot up MODX */
echo "Loading modX...\n";
require_once dirname(dirname(__FILE__)) . '/config.core.php';
require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
$modx = new modX();
echo "Initializing manager...\n";
$modx->initialize('mgr');
$modx->getService('error','error.modError', '', '');
$modx->setLogTarget('HTML');

$componentPath = dirname(dirname(__FILE__));

/** @var Commerce $commerce */
//$modx->setOption('commerce.core_path', $componentPath.'/core/components/commerce/');
//$commerce = $modx->getService('commerce','Commerce', $componentPath.'/core/components/commerce/model/commerce/');


$elements = [
    'modTemplate' => [
        'Red - Home' => $componentPath . '/core/components/commercetheme_red/elements/templates/home.tpl',
        'Red - Cart' => $componentPath . '/core/components/commercetheme_red/elements/templates/cart.tpl',
        'Red - Category' => $componentPath . '/core/components/commercetheme_red/elements/templates/category.tpl',
        'Red - Checkout' => $componentPath . '/core/components/commercetheme_red/elements/templates/checkout.tpl',
        'Red - Product' => $componentPath . '/core/components/commercetheme_red/elements/templates/product.tpl',
        'Red - Account' => $componentPath . '/core/components/commercetheme_red/elements/templates/account.tpl',
        'Red - Account login' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_login.tpl',
        'Red - Account register' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_register.tpl',
        'Red - Account activate registration' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_activate_registration.tpl',
        'Red - Account thank you registration' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_thank_you_registration.tpl',
        'Red - Account forgot password' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_password.tpl',
        'Red - Account Order' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_order.tpl',
        'Red - Account Orders' => $componentPath . '/core/components/commercetheme_red/elements/templates/account_orders.tpl',
    ],

    'modChunk' => [
        'ctred.category_list' => $componentPath . '/core/components/commercetheme_red/elements/chunks/category_list.tpl',
        'ctred.related_list' => $componentPath . '/core/components/commercetheme_red/elements/chunks/related_list.tpl',
        'ctred.related_outer' => $componentPath . '/core/components/commercetheme_red/elements/chunks/related_outer.tpl',
        'ctred.related_outer_list' => $componentPath . '/core/components/commercetheme_red/elements/chunks/related_outer_list.tpl',
        'ctred.login_form' => $componentPath . '/core/components/commercetheme_red/elements/chunks/login_form.tpl',
        'ctred.logout_form' => $componentPath . '/core/components/commercetheme_red/elements/chunks/logout_form.tpl',
        'ctred.forgot_pass' => $componentPath . '/core/components/commercetheme_red/elements/chunks/forgot_pass.tpl',
        'ctred.account_form' => $componentPath . '/core/components/commercetheme_red/elements/chunks/account_form.tpl',
        'ctred.register_form' => $componentPath . '/core/components/commercetheme_red/elements/chunks/register_form.tpl',
        'ctred.register_email' => $componentPath . '/core/components/commercetheme_red/elements/chunks/register_email.tpl',
        'ctred.update_profile_form' => $componentPath . '/core/components/commercetheme_red/elements/chunks/update_profile_form.tpl',
        'ctred.profile_details' => $componentPath . '/core/components/commercetheme_red/elements/chunks/profile_details.tpl',
        'ctred.login_chunk' => $componentPath . '/core/components/commercetheme_red/elements/chunks/login_chunk.tpl',
        'ctred.tag_list_chunk' => $componentPath . '/core/components/commercetheme_red/elements/chunks/tag_list_chunk.tpl',
        'ctred.tag_outer_chunk' => $componentPath . '/core/components/commercetheme_red/elements/chunks/tag_outer_chunk.tpl',
        'ctred.footer' => $componentPath . '/core/components/commercetheme_red/elements/chunks/footer.tpl',
        'ctred.header' => $componentPath . '/core/components/commercetheme_red/elements/chunks/header.tpl',
    ],
];

if (!createObject('modCategory', [
    'category' => 'CTRed'
], 'category', true)) {
    echo "Error creating category; halting.\n";
    exit(1);
}

$category = $modx->getObject('modCategory', ['category' => 'CTRed']);
$categoryId = $category ? $category->get('id') : 0;

foreach ($elements as $type => $records) {
    $nameFld = $type === 'modTemplate' ? 'templatename' : 'name';
    foreach ($records as $name => $file) {
        if (!createObject($type, [
            $nameFld => $name,
            'static' => true,
            'static_file' => $file,
            'category' => $categoryId,
        ],$nameFld, true)) {
            echo "Error creating {$type} {$name}.\n";
        }
    }
}
//ctred.assets_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.assets_url',
    'value' => '/assets/components/commercetheme_red/'
], 'key', false)) {
    echo "Error creating ctred.assets_url system setting.\n";
}

//ctred.account_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.account_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.account_page_id system setting.\n";
}

//ctred.profile_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.profile_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.profile_page_id system setting.\n";
}

//ctred.password_reset_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.password_reset_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.password_reset_page_id system setting.\n";
}

//ctred.registration_please_activate_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.registration_please_activate_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.registration_please_activate_page_id system setting.\n";
}

//ctred.registration_activation_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.registration_activation_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.registration_activation_page_id system setting.\n";
}

//ctred.registration_thank_you_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.registration_thank_you_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.registration_thank_you_page_id system setting.\n";
}

//ctred.you_are_logout_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.you_are_logout_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.you_are_logout_page_id system setting.\n";
}

//ctred.edit_profile_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.edit_profile_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.edit_profile_page_id system setting.\n";
}

//ctred.account_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.account_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.account_page_id system setting.\n";
}
//ctred.forgot_password_page_id
if (!createObject('modSystemSetting', [
    'key' => 'ctred.forgot_password_page_id',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.forgot_password_page_id system setting.\n";
}

//ctred.footer_header_one
if (!createObject('modSystemSetting', [
    'key' => 'ctred.footer_header_one',
    'value' => 'Pages'
], 'key', false)) {
    echo "Error creating ctred.footer_header_one system setting.\n";
}

//ctred.footer_header_two
if (!createObject('modSystemSetting', [
    'key' => 'ctred.footer_header_two',
    'value' => 'Quick links'
], 'key', false)) {
    echo "Error creating ctred.footer_header_two system setting.\n";
}

//ctred.footer_content
if (!createObject('modSystemSetting', [
    'key' => 'ctred.footer_content',
    'value' => '<p>Theme #1 for Commerce, dubbed "Red" even though its accent color is blue. Bootstrap based.</p>'
], 'key', false)) {
    echo "Error creating ctred.footer_content system setting.\n";
}

//ctred.footer_bottom_row_content
if (!createObject('modSystemSetting', [
    'key' => 'ctred.footer_bottom_row_content',
    'value' => '<p>This is a theme created by ModMore.</p><p>&copy All right Reversed.</p>'
], 'key', false)) {
    echo "Error creating ctred.footer_bottom_row_content system setting.\n";
}

//ctred.quick_link_01_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_01_text',
    'value' => 'Account'
], 'key', false)) {
    echo "Error creating ctred.quick_link_01_text system setting.\n";
}

//ctred.quick_link_01_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_01_url',
    'value' => '[[~[[++ctred.account_page_id]]]]'
], 'key', false)) {
    echo "Error creating ctred.quick_link_01_url system setting.\n";
}

//ctred.quick_link_02_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_02_text',
    'value' => 'Profile'
], 'key', false)) {
    echo "Error creating ctred.quick_link_02_text system setting.\n";
}

//ctred.quick_link_02_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_02_url',
    'value' => '[[~[[++ctred.profile_page_id]]]]'
], 'key', false)) {
    echo "Error creating ctred.quick_link_02_url system setting.\n";
}

//ctred.quick_link_03_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_03_text',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_03_text system setting.\n";
}

//ctred.quick_link_03_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_03_url',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_03_url system setting.\n";
}

//ctred.quick_link_04_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_04_text',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_04_text system setting.\n";
}

//ctred.quick_link_04_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_04_url',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_04_url system setting.\n";
}

//ctred.quick_link_05_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_05_text',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_05_text system setting.\n";
}

//ctred.quick_link_05_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_05_url',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_05_url system setting.\n";
}

//ctred.quick_link_06_text
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_06_text',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_06_text system setting.\n";
}

//ctred.quick_link_06_url
if (!createObject('modSystemSetting', [
    'key' => 'ctred.quick_link_06_url',
    'value' => ''
], 'key', false)) {
    echo "Error creating ctred.quick_link_06_url system setting.\n";
}

if (!createObject('modTemplateVar', [
    'type' => 'commerce_matrix',
    'name' => 'product_matrix',
    'caption' => 'Products',
], 'name', false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

if (!createObject('modTemplateVar', [
    'type' => 'richtext',
    'name' => 'ctred.hero_content',
    'caption' => 'Hero content',
], 'name', false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

if (!createObject('modTemplateVar', [
    'type' => 'image',
    'name' => 'ctred.hero_image',
    'caption' => 'Hero background image',
], 'name', false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

$tv = $modx->getObject('modTemplateVar', ['name' => 'product_matrix']);
$tvId = $tv ? $tv->get('id') : 0;
$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Red - Product']);
$tmplId = $tmpl ? $tmpl->get('id') : 0;
if (!createObject('modTemplateVarTemplate', [
    'tmplvarid' => $tvId,
    'templateid' => $tmplId,
], ['tmplvarid', 'templateid'], false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

$tv = $modx->getObject('modTemplateVar', ['name' => 'ctred.hero_content']);
$tvId = $tv ? $tv->get('id') : 0;
$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Red - Home']);
$tmplId = $tmpl ? $tmpl->get('id') : 0;
if (!createObject('modTemplateVarTemplate', [
    'tmplvarid' => $tvId,
    'templateid' => $tmplId,
], ['tmplvarid', 'templateid'], false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

$tv = $modx->getObject('modTemplateVar', ['name' => 'ctred.hero_image']);
$tvId = $tv ? $tv->get('id') : 0;
$tmpl = $modx->getObject('modTemplate', ['templatename' => 'Red - Home']);
$tmplId = $tmpl ? $tmpl->get('id') : 0;
if (!createObject('modTemplateVarTemplate', [
    'tmplvarid' => $tvId,
    'templateid' => $tmplId,
], ['tmplvarid', 'templateid'], false)) {
    echo "Error creating modTemplateVar system setting.\n";
}

// Clear the cache
$modx->cacheManager->refresh();

echo "Done.\n";


/**
 * Creates an object.
 *
 * @param string $className
 * @param array $data
 * @param string $primaryField
 * @param bool $update
 * @return bool
 */
function createObject ($className = '', array $data = array(), $primaryField = '', $update = true) {
    global $modx;
    /* @var xPDOObject $object */
    $object = null;

    /* Attempt to get the existing object */
    if (!empty($primaryField)) {
        if (is_array($primaryField)) {
            $condition = array();
            foreach ($primaryField as $key) {
                $condition[$key] = $data[$key];
            }
        }
        else {
            $condition = array($primaryField => $data[$primaryField]);
        }
        $object = $modx->getObject($className, $condition);
        if ($object instanceof $className) {
            if ($update) {
                $object->fromArray($data);
                return $object->save();
            } else {
                $condition = $modx->toJSON($condition);
                echo "Skipping {$className} {$condition}: already exists.\n";
                return true;
            }
        }
    }

    /* Create new object if it doesn't exist */
    if (!$object) {
        $object = $modx->newObject($className);
        $object->fromArray($data, '', true);
        return $object->save();
    }

    return false;
}
