<?php

$settingSource = include __DIR__ . '/settings.php';

$settings = [];

/**
 * Loop over setting stuff to interpret the xtype and to create the modSystemSetting object for the package.
 */
foreach ($settingSource as $key => $options) {
    $val = $options['value'];

    if (isset($options['xtype'])) $xtype = $options['xtype'];
    elseif (is_int($val)) $xtype = 'numberfield';
    elseif (is_bool($val)) $xtype = 'modx-combo-boolean';
    else $xtype = 'textfield';

    /** @var modSystemSetting */
    $settings[$key] = $modx->newObject('modSystemSetting');
    $settings[$key]->fromArray([
        'key' => 'ctred.' . $key,
        'xtype' => $xtype,
        'value' => $options['value'],
        'namespace' => 'commercetheme_red',
        'area' => $options['area'],
        'editedon' => time(),
    ], '', true, true);
}



return $settings;
