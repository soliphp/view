<?php

use Soli\View;
use Soli\View\Engine\Smarty as SmartyEngine;

include __DIR__ . "/vendor/autoload.php";

$config = [
    'viewsDir'        => __DIR__ . '/views/smarty/',
    'viewsCacheDir'   => __DIR__ . '/cache/templates/',
    'viewsCompileDir' => __DIR__ . '/cache/templates_c/',
];

$view = new View();
$view->setViewsDir($config['viewsDir']);
$view->setViewExtension('.tpl');

// 通过匿名函数来设置模版引擎，延迟对模版引擎的实例化
$view->setEngine(function () use ($config, $view) {
    $engine = new SmartyEngine($view);
    // 开启 debug 不进行缓存
    $engine->setDebug(true);
    $engine->setOptions([
        'compile_dir'     => $config['viewsCompileDir'],
        'cache_dir'       => $config['viewsCacheDir'],
        'caching'         => true,
        'caching_type'    => 'file',
        'cache_lifetime'  => 86400,
        'left_delimiter'  => '{{',
        'right_delimiter' => '}}',
    ]);
    return $engine;
});

$view->setVar('name', 'Soli');

$template = 'home/index';

echo $view->render($template);
