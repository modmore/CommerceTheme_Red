<?php

/**
 * @param string $filename The name of the file.
 * @return string The file's content
 * @by splittingred
 */
function getSnippetContent($filename = '') {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tstart = $mtime;
set_time_limit(0);

if (!defined('MOREPROVIDER_BUILD')) {
    /* define version */
    define('PKG_NAME','CommerceTheme Red');
    define('PKG_NAMESPACE','commercetheme_red');
    define('PKG_VERSION','1.1.0');
    define('PKG_RELEASE','pl');

    /* load modx */
    require_once dirname(dirname(__FILE__)) . '/config.core.php';
    require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
    $modx= new modX();
    $modx->initialize('mgr');
    $modx->setLogLevel(modX::LOG_LEVEL_INFO);
    $modx->setLogTarget('ECHO');


    echo '<pre>';
    flush();
    $targetDirectory = dirname(dirname(__FILE__)) . '/_packages/';
}
else {
    $targetDirectory = MOREPROVIDER_BUILD_TARGET;
}


$root = dirname(dirname(__FILE__)).'/';
$sources= array (
    'root' => $root,
    'build' => $root .'_build/',
    'events' => $root . '_build/events/',
    'resolvers' => $root . '_build/resolvers/',
    'validators' => $root . '_build/validators/',
    'data' => $root . '_build/data/',
    'plugins' => $root.'_build/elements/plugins/',
    'snippets' => $root.'_build/elements/snippets/',
    'source_core' => $root.'core/components/'.PKG_NAMESPACE,
    'source_assets' => $root.'assets/components/'.PKG_NAMESPACE,
    'lexicon' => $root . 'core/components/'.PKG_NAMESPACE.'/lexicon/',
    'docs' => $root.'core/components/'.PKG_NAMESPACE.'/docs/',
    'model' => $root.'core/components/'.PKG_NAMESPACE.'/model/',
);
unset($root);

$modx->loadClass('transport.modPackageBuilder','',false, true);
$builder = new modPackageBuilder($modx);
$builder->directory = $targetDirectory;
$builder->createPackage(PKG_NAMESPACE,PKG_VERSION,PKG_RELEASE);
$builder->registerNamespace(PKG_NAMESPACE,false,true,'{core_path}components/'.PKG_NAMESPACE.'/', '{assets_path}components/'.PKG_NAMESPACE.'/');


$builder->package->put(
    array(
        'source' => $sources['source_core'],
        'target' => "return MODX_CORE_PATH . 'components/';",
    ),
    array(
        xPDOTransport::ABORT_INSTALL_ON_VEHICLE_FAIL => true,
        'vehicle_class' => 'xPDOFileVehicle',
        'validate' => array(
            array(
                'type' => 'php',
                'source' => $sources['validators'] . 'requirements.script.php'
            )
        )
    )
);

if (file_exists($sources['source_assets'] . '/node_modules/')) {
    $modx->log(modX::LOG_LEVEL_INFO,'Temporarily moving node_modules to keep package size down...'); flush();
    rename($sources['source_assets'] . '/node_modules/', dirname($sources['source_assets'])  . '/node_modules/');
}
$builder->package->put(
    array(
        'source' => $sources['source_assets'],
        'target' => "return MODX_ASSETS_PATH . 'components/';",
    ),
    array(
        'vehicle_class' => 'xPDOFileVehicle',
    )
);
if (file_exists(dirname($sources['source_assets']) . '/node_modules/')) {
    $modx->log(modX::LOG_LEVEL_INFO,'Moving node modules back...'); flush();
    rename(dirname($sources['source_assets']) . '/node_modules/', $sources['source_assets'] . '/node_modules/');
}
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in files and validator.'); flush();

/* Settings */
$settings = include $sources['data'] . 'transport.settings.php';
$attributes= array(
    xPDOTransport::UNIQUE_KEY => 'key',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => false,
);
if (is_array($settings)) {
    foreach ($settings as $setting) {
        $vehicle = $builder->createVehicle($setting,$attributes);
        $builder->putVehicle($vehicle);
    }
    $modx->log(modX::LOG_LEVEL_INFO,'Packaged in ' . count($settings) . ' system settings.'); flush();
    unset($settings,$setting,$attributes);
}


/** @var $category modCategory */
$category = $modx->newObject('modCategory');
$category->set('category','Red');

/* create category vehicle */
$attr = array(
    xPDOTransport::UNIQUE_KEY => 'category',
    xPDOTransport::PRESERVE_KEYS => true,
    xPDOTransport::UPDATE_OBJECT => true,
    xPDOTransport::RELATED_OBJECTS => false,
);

$vehicle = $builder->createVehicle($category,$attr);
$vehicle->resolve('php',array(
    'source' => $sources['resolvers'] . 'setupoptions.resolver.php',
));

$modx->log(modX::LOG_LEVEL_INFO,'Packaged in category plus resolvers.'); flush();
$builder->putVehicle($vehicle);

/* now pack in the license file, readme and setup options */
$builder->setPackageAttributes(array(
    'license' => file_get_contents($sources['docs'] . 'license.txt'),
    'readme' => file_get_contents($sources['docs'] . 'readme.txt'),
    'changelog' => file_get_contents($sources['docs'] . 'changelog.txt'),
    'setup-options' => array(
        'source' => $sources['build'] . 'setup.options.php',
    ),
    'theme-definition' => json_encode(include __DIR__ . '/data/theme.inc.php')
));
$modx->log(modX::LOG_LEVEL_INFO,'Packaged in package attributes.'); flush();

$modx->log(modX::LOG_LEVEL_INFO,'Packing...'); flush();
$builder->pack();

$mtime = microtime();
$mtime = explode(" ", $mtime);
$mtime = $mtime[1] + $mtime[0];
$tend = $mtime;
$totalTime = ($tend - $tstart);
$totalTime = sprintf("%2.4f s", $totalTime);

$modx->log(modX::LOG_LEVEL_INFO,"\n<br />Package Built.<br />\nExecution time: {$totalTime}\n");

