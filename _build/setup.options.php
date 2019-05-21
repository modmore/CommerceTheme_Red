<?php

if (!isset($modx)) {
    require_once dirname(dirname(__DIR__)) . '/config.core.php';
    require_once MODX_CORE_PATH . 'model/modx/modx.class.php';
    $modx = new modX();
    $modx->initialize('mgr');
    $modx->getService('error', 'error.modError', '', '');
    $modx->loadClass('transport.modPackageBuilder', MODX_CORE_PATH, true, true);
    $modx->loadClass('transport.xPDOTransport', XPDO_CORE_PATH, true, true);
}

$commerceAvailable = false;
$corePath = $modx->getOption('commerce.core_path', null, $modx->getOption('core_path') . 'components/commerce/');
if ($commerce = $modx->getService('commerce', 'Commerce', $corePath . 'model/commerce/')) {
    $commerceAvailable = true;
}

if ($options[xPDOTransport::PACKAGE_ACTION] === xPDOTransport::ACTION_UNINSTALL) {
    return '';
}

$def = array_key_exists('theme-definition', $options['attributes']) ? json_decode($options['attributes']['theme-definition'], true) : [];

if (empty($def) || !is_array($def)) {
    return 'Failed to load theme definition: ' . json_encode($options, JSON_PRETTY_PRINT);
}

$flagModified = <<<HTML
<span class="icon icon-warning-sign" title="This element was modified since its initial installation. Choosing to upgrade it will overwrite your modifications.">[modified]</span>
HTML;

$assetsPath = $modx->getOption($def['namespace'] . '.assets_path', null,MODX_ASSETS_PATH . 'components/' . $def['namespace'] . '/', true);

$output = [];
$output[] = <<<HTML
<script type="text/javascript">
setTimeout(function() {
    Ext.getCmp('modx-window-setupoptions').setWidth(window.innerWidth - 200).setPosition(100, 25);
    Ext.getCmp('modx-setupoptions-panel').hide();
}, 50);
</script>
HTML;

$output[] = '<p>Please choose the elements that you would like to create and/or update. For a first installation, choose all options. When updating, choose which modified elements and resources you want to overwrite. </p>';

$attr = file_exists($assetsPath . 'css/main.css') ? '' : 'checked="checked"';
$output[] = <<<HTML
<p>
    <label>
        <input type="checkbox" name="write_assets" value="1" {$attr}>
        <b>Overwrite custom JavaScript/CSS</b>
    </label>
    Theme Red allows you to compile your own styles based on the distribution. Instructions on how to do that can be found in the readme under assets/components/commercetheme_red/. If you want to revert to the defaults, tick this box. It may be necessary to manually apply styling changes if you do not overwrite the custom styling.
</p>
HTML;


$output[] = <<<HTML
<style type="text/css">
.cti .elements-container {
    display: flex;    
}
.cti .element-column {
    flex: 1 0 25%;
}
.cti .element-column h3 {
    border-bottom: solid 3px #38008d;
    font-weight: normal;
    font-size: 1.5rem;
    margin-right: 1rem;
}
.cti .element-meta {
    color: #8d8d8d;
    padding-right: 0.5rem;
}
.cti .element-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
.cti .nested-element {
    padding-left: 1.5rem;
    list-style-type: none;
}
.cti .element {
    padding-right: 0.5rem;    
}
</style>
HTML;

$packages = [];
foreach ($def['packages'] as $provider => $provPackages) {
    $thisPackages = [];
    foreach ($provPackages as $package) {
        $attr = 'disabled="disabled"';
        $thisPackages[] = <<<HTML
    <li class="element">
        <label>
            <input type="checkbox" class="element-checkbox" {$attr}>
            <span class="element-name">{$package}</span>
        </label>
    </li>
HTML;
    }
    $thisPackages = implode("\n", $thisPackages);
    $packages[] = <<<HTML
<p class="element-meta">From {$provider}:</p>
<ul class="element-list">
    {$thisPackages}
</ul>
HTML;
}
$packages = implode("\n", $packages);

$templates = [];
foreach ($def['templates'] as $templateName => $template) {
    $attr = 'checked="checked"';
    $flag = '';
    /** @var modElement $el */
    if ($el = $modx->getObject('modTemplate', $template['primary'])) {
        $props = $el->get('properties');
        $props = is_array($props) ? $props : [];
        $hash = array_key_exists('_theme_hash', $props) ? (string)$props['_theme_hash']['value'] : '';
        if ($hash !== sha1($el->get('content'))) {
            $flag = $flagModified;
            $attr = '';
        }
    }

    $displayName = substr($templateName, strlen($def['template_prefix']));

    $templates[] = <<<HTML
<li class="element">
    <label>
        <input type="checkbox" name="templates[]" value="{$templateName}" class="element-checkbox" {$attr}>
        <span class="element-name">{$displayName}</span>
        <span class="element-flag">{$flag}</span>
    </label>
</li>
HTML;
}
$templates = implode("\n", $templates);

$chunks = [];
foreach ($def['chunks'] as $chunkName => $chunk) {
    $attr = 'checked="checked"';
    $flag = '';
    /** @var modElement $el */
    if ($el = $modx->getObject('modChunk', $chunk['primary'])) {
        $props = $el->get('properties');
        $props = is_array($props) ? $props : [];
        $hash = array_key_exists('_theme_hash', $props) ? (string)$props['_theme_hash']['value'] : '';
        if ($hash !== sha1($el->get('content'))) {
            $flag = $flagModified;
            $attr = '';
        }
    }

    $displayName = substr($chunkName, strlen($def['chunk_prefix']));

    $chunks[] = <<<HTML
<li class="element">
    <label>
        <input type="checkbox" name="chunks[]" value="{$chunkName}" class="element-checkbox" {$attr}>
        <span class="element-name">{$displayName}</span>
        <span class="element-flag">{$flag}</span>
    </label>
</li>
HTML;
}
$chunks = implode("\n", $chunks);


$resources = [];
foreach ($def['resources'] as $alias => $resource) {
    $children = [];
    foreach ($resource['children'] as $childAlias => $childResource) {


        $nestedChildren = [];
        if (is_array($childResource['children'])) {
            foreach ($childResource['children'] as $nestedChildAlias => $nestedChildResource) {
                $displayName = $nestedChildResource['pagetitle'];
                $flag = '';
                $attr = 'checked="checked"';
                $nestedChildren[] = <<<HTML
<li class="element">
    <label>
        <input type="checkbox" name="resources[]" value="{$alias}.{$childAlias}.{$nestedChildAlias}" class="element-checkbox" {$attr}>
        <span class="element-name">{$displayName}</span>
        <span class="element-flag">{$flag}</span>
    </label>
</li>
HTML;
            }
        }
        $nestedChildren = implode("\n", $nestedChildren);
        if (!empty($nestedChildren)) {
            $nestedChildren = <<<HTML
<ul class="nested-element">
    {$nestedChildren}
</ul>
HTML;
        }

        $displayName = $childResource['pagetitle'];
        $flag = '';
        $attr = 'checked="checked"';
        $children[] = <<<HTML
<li class="element">
    <label>
        <input type="checkbox" name="resources[]" value="{$alias}.{$childAlias}" class="element-checkbox" {$attr}>
        <span class="element-name">{$displayName}</span>
        <span class="element-flag">{$flag}</span>
    </label>
    {$nestedChildren}
</li>
HTML;
    }
    $children = implode("\n", $children);
    if (!empty($children)) {
        $children = <<<HTML
<ul class="nested-element">
    {$children}
</ul>
HTML;
    }

    $displayName = $resource['pagetitle'];
    $flag = '';
    $attr = 'checked="checked"';
    $resources[] = <<<HTML
<li class="element">
    <label>
        <input type="checkbox" name="resources[]" value="{$alias}" class="element-checkbox" {$attr}>
        <span class="element-name">{$displayName}</span>
        <span class="element-flag">{$flag}</span>
    </label>
    {$children}
</li>
HTML;
}
$resources = implode("\n", $resources);

$contexts = [];
foreach ($modx->getIterator('modContext', ['key:!=' => 'mgr']) as $ctx) {
    $key = $ctx->get('key');
    $key = htmlentities($key, ENT_QUOTES, 'utf-8');
    $name = $ctx->get('name');
    $name = htmlentities($name, ENT_QUOTES, 'utf-8');
    $contexts[] = '<option value="' . $key . '">' . $name . ' (' . $key . ')</option>';
}
$contexts = implode("\n", $contexts);

$output[] = <<<HTML
<div class="cti">
    <div class="elements-container">
        <div class="element-column">
            <h3>Packages</h3>
            <p class="element-meta">The following (third-party) extras are necessary for the starter pack. Note that these are not yet automatically installed.</p>
            {$packages}
        </div>
        <div class="element-column">
            <h3>Templates</h3>
            <p class="element-meta">Includes TVs. Prefix: "{$def['template_prefix']}"</p>
            <ul class="element-list">
                {$templates}
            </ul>
        </div>
        <div class="element-column">
            <h3>Chunks</h3>
            <p class="element-meta">Prefix: "{$def['chunk_prefix']}"</p>
            <ul class="element-list">
                {$chunks}
            </ul>
        </div>
        <div class="element-column">
            <h3>Resources</h3>
            <div class="element-meta">
                Context: 
                <select name="target_context">
                    {$contexts}
                </select>
                </div>
            <p class="element-meta">
                <b>Important:</b> resources with <b>matching aliases</b> will be modified. Also sets relevant (context) settings.<br>
            </p>
            <ul class="element-list">
                {$resources}
            </ul>
        </div>
    </div>
</div>
HTML;

return implode('', $output);