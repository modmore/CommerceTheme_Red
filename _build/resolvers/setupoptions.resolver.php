<?php
/**
 * @var $param
 * @var modX $modx
 * @var array $options
 */


// Convenience access to $modx
/** @var modX $modx */
if (!isset($modx) && isset($object) && isset($object->xpdo)) {
    $modx = $object->xpdo;
}

$def = array_key_exists('theme-definition', $options) ? json_decode($options['theme-definition'], true) : [];

if (empty($def) || !is_array($def)) {
    $modx->log(modX::LOG_LEVEL_ERROR, 'Failed to load theme definition');
    return false;
}

$static = false;

$category = $modx->getObject('modCategory', ['category' => $def['category']]);
if (!$category) {
    $category = $modx->newObject('modCategory');
    $category->set('category', $def['category']);
    $category->save();
}

foreach ($options['templates'] as $templateName) {
    $template = array_key_exists($templateName, $def['templates']) ? $def['templates'][$templateName] : null;
    if (!is_array($template)) {
        $modx->log(modX::LOG_LEVEL_ERROR, 'Template "' . $templateName . '" not found');
        continue;
    }

    $verb = 'Updated';
    $el = $modx->getObject('modTemplate', [
        'templatename' => $templateName
    ]);
    if (!$el) {
        $el = $modx->newObject('modTemplate');
        $el->set('templatename', $templateName);
        $verb = 'Created';
    }
    $el->set('category', $category->get('id'));
    $el->set('content', $template['content']);
    if ($static) {
        $el->set('static', true);
        $el->set('static_file', $template['file']);
    }
    $el->setProperties(['_theme_hash' => $template['hash']], true);
    if ($el->save()) {
        $modx->log(modX::LOG_LEVEL_INFO, "{$verb} template {$templateName}");

        if (!empty($template['setting'])) {
            $setting = $modx->getObject('modSystemSetting', ['key' => $template['setting']]);
            if (!$setting) {
                $setting = $modx->newObject('modSystemSetting');
                $setting->set('key', $template['setting']);
                $setting->set('namespace', $def['namespace']);
                $setting->set('xtype', 'textfield');
            }
            $setting->set('value', $el->get('id'));
            $setting->save();
        }

        if (!array_key_exists('template_variables', $template)) {
            continue;
        }
        foreach ($template['template_variables'] as $tvName => $tvInfo) {
            /** @var modTemplateVar $tv */
            $tv = $modx->getObject('modTemplateVar', ['name' => $tvName]);
            if (!$tv) {
                $tv = $modx->newObject('modTemplateVar');
                $tv->set('name', $tvName);
            }
            $tv->set('type', $tvInfo['type']);
            $tv->set('caption', $tvInfo['caption']);
            $tv->set('category', $category->get('id'));
            if ($tv->save()) {
                /** @var modTemplateVarTemplate $templateVarTemplate */
                $templateVarTemplate = $modx->getObject('modTemplateVarTemplate', [
                    'tmplvarid' => $tv->get('id'),
                    'templateid' => $el->get('id'),
                ]);
                if (!$templateVarTemplate) {
                    $templateVarTemplate = $modx->newObject('modTemplateVarTemplate');
                    $templateVarTemplate->fromArray([
                        'tmplvarid' => $tv->get('id'),
                        'templateid' => $el->get('id'),
                    ], '', true);
                    if ($templateVarTemplate->save()) {
                        $modx->log(modX::LOG_LEVEL_INFO, "- Added modTemplateVarTemplate for {$tv->get('name')} on {$el->get('templatename')}");
                    }
                    else {
                        $modx->log(modX::LOG_LEVEL_ERROR, "- Failed creating modTemplateVarTemplate for {$tv->get('name')} on {$el->get('templatename')}");

                    }
                }
                else {
                    $modx->log(modX::LOG_LEVEL_INFO, "- modTemplateVarTemplate already exists for {$tv->get('name')} on {$el->get('templatename')}");

                }
            }
            else {
                $modx->log(modX::LOG_LEVEL_ERROR, "- Failed saving modTemplateVar {$tv->get('name')}");
            }
        }
    }
    else {
        $modx->log(modX::LOG_LEVEL_ERROR, "Couldn't save template {$templateName}");
    }
}
foreach ($options['chunks'] as $chunkName) {
    $chunk = array_key_exists($chunkName, $def['chunks']) ? $def['chunks'][$chunkName] : null;
    if (!is_array($chunk)) {
        echo 'Chunk "' . $chunkName . '" not found ';
    }
    else {
        $verb = 'Updated';
        $el = $modx->getObject('modChunk', [
            'name' => $chunkName
        ]);
        if (!$el) {
            $el = $modx->newObject('modChunk');
            $el->set('name', $chunkName);
            $verb = 'Created';
        }
        $el->set('category', $category->get('id'));
        $el->set('content', $chunk['content']);
        if ($static) {
            $el->set('static', true);
            $el->set('static_file', $chunk['file']);
        }
        $el->setProperties(['_theme_hash' => $chunk['hash']], true);
        if ($el->save()) {
            $modx->log(modX::LOG_LEVEL_INFO, "{$verb} chunk {$chunkName}");
        }
        else {
            $modx->log(modX::LOG_LEVEL_ERROR, "Couldn't save chunk {$chunkName}");
        }
    }
}

$targetCtx = array_key_exists('target_context', $options) ? (string)$options['target_context'] : 'web';
foreach ($options['resources'] as $path) {
    $parts = explode('.', $path);
    $resourceDefs = ['children' => $def['resources']];
    $alias = false;
    $parent = false;
    $parentAlias = false;
    foreach ($parts as $part) {
        if (array_key_exists($part, $resourceDefs['children'])) {
            if (array_key_exists('pagetitle', $resourceDefs)) {
                $parent = $resourceDefs;
                $parentAlias = $alias;
            }
            $alias = $part;
            $resourceDefs = $resourceDefs['children'][$part];
        }
    }
    if (!array_key_exists('pagetitle', $resourceDefs)) {
        $modx->log(modX::LOG_LEVEL_ERROR, "Couldn't find resource {$path} in definition");
        continue;
    }

    $verb = 'Updated';
    /** @var modResource $r */
    $r = $modx->getObject('modResource', [
        'context_key' => $targetCtx,
        'alias' => $alias,
    ]);
    if (!$r) {
        $verb = 'Created';
        $r = $modx->newObject('modResource');
        $r->set('context_key', $targetCtx);
        $r->set('alias', $alias);
    }
    $r->set('pagetitle', $resourceDefs['pagetitle']);

    if ($parentAlias) {
        $parent = $modx->getObject('modResource', [
            'context_key' => $targetCtx,
            'alias' => $parentAlias,
        ]);
        if ($parent instanceof modResource) {
            $r->set('parent', $parent->get('id'));
        }
    }

    $template = $modx->getObject('modTemplate', [
        'templatename' => $resourceDefs['template']
    ]);
    if ($template instanceof modTemplate) {
        $r->set('template', $template->get('id'));
    }
    else {
        $modx->log(modX::LOG_LEVEL_ERROR, "Couldn't find template {$resourceDefs['template']} for {$path}");
    }

    $r->set('hidemenu', array_key_exists('hidemenu', $resourceDefs) ? $resourceDefs['hidemenu'] : false);
    $r->set('published', array_key_exists('published', $resourceDefs) ? $resourceDefs['published'] : true);

    if (!empty($resourceDefs['content'])) {
        $previous = $r->get('content');
        if (!empty($previous)) {
            $r->setProperty('content', $previous, '_backup');
        }
        $r->set('content', $resourceDefs['content']);
    }

    if ($r->save()) {
        $modx->log(modX::LOG_LEVEL_INFO, "{$verb} resource {$path}");
        if (!empty($resourceDefs['setting'])) {
            if ($targetCtx === 'web') {
                $setting = $modx->getObject('modSystemSetting', ['key' => $resourceDefs['setting']]);
                if (!$setting) {
                    $setting = $modx->newObject('modSystemSetting');
                    $setting->set('key', $resourceDefs['setting']);
                    $setting->set('xtype', 'textfield');
                    $setting->set('namespace', $def['namespace']);
                }
                $setting->set('value', $r->get('id'));
                $setting->save();
            }
            else {
                $setting = $modx->getObject('modContextSetting', [
                    'key' => $resourceDefs['setting'],
                    'context_key' => $targetCtx,
                ]);
                if (!$setting) {
                    $setting = $modx->newObject('modContextSetting');
                    $setting->set('key', $resourceDefs['setting']);
                    $setting->set('context_key', $targetCtx);
                    $setting->set('xtype', 'textfield');
                }
                $setting->set('value', $r->get('id'));
                $setting->save();
            }
        }
    }
    else {
        $modx->log(modX::LOG_LEVEL_ERROR, "Error: couldn't save resource {$path}.");
    }
}

$assetsPath = $modx->getOption($def['namespace'] . '.assets_path', null, MODX_ASSETS_PATH . 'components/' . $def['namespace'] . '/', true);
$css = $assetsPath . 'css/main.css';
if (array_key_exists('write_assets', $options) || !file_exists($css)) {
    if (!is_dir($assetsPath . 'css/')) {
        mkdir($assetsPath . 'css/', 0755);
    }
    if (!is_dir($assetsPath . 'scss/')) {
        mkdir($assetsPath . 'scss/', 0755);
    }
    $files = [
        'dist/css/main.css' => 'css/main.css',
        'dist/scss/main.scss' => 'scss/main.scss',
    ];

    foreach ($files as $dist => $target) {
        if (file_exists($assetsPath . $target)) {
            rename($assetsPath . $target, $assetsPath . $target . '.backup_' . date('Y_m_d-H_i_s'));
        }
        copy($assetsPath . $dist, $assetsPath . $target);
    }
}

$modx->getCacheManager()->refresh();

return true;
