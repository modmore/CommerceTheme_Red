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
        'Red - Cart' => $componentPath . '/core/components/commercetheme_red/elements/templates/cart.tpl',
        'Red - Category' => $componentPath . '/core/components/commercetheme_red/elements/templates/category.tpl',
        'Red - Checkout' => $componentPath . '/core/components/commercetheme_red/elements/templates/checkout.tpl',
        'Red - Product' => $componentPath . '/core/components/commercetheme_red/elements/templates/product.tpl',
    ],

    'modChunk' => [
        'ctred.category_list' => $componentPath . '/core/components/commercetheme_red/elements/chunks/category_list.tpl',
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


if (!createObject('modTemplateVar', [
    'type' => 'commerce_matrix',
    'name' => 'product_matrix',
    'caption' => 'Products',
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
