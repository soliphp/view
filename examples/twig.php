<?php

use Soli\View;
use Soli\View\Engine\Twig as TwigEngine;

include __DIR__ . "/vendor/autoload.php";

$config = [
    'viewsDir'      => __DIR__ . '/views/twig/',
    'viewsCacheDir' => __DIR__ . '/cache/twig/',
];

$view = new View();
$view->setViewsDir($config['viewsDir']);
$view->setViewExtension('.twig');

// 通过匿名函数来设置模版引擎，延迟对模版引擎的实例化
$view->setEngine(function () use ($config, $view) {
    $engine = new TwigEngine($view);
    // 开启 debug 不进行缓存
    $engine->setDebug(true);
    $engine->setCacheDir($config['viewsCacheDir']);
    // 使用扩展
    // $engine->addExtension(new MyTwigExtension());
    return $engine;
});

$view->setVar('name', 'Soli');

$template = 'home/index';

echo $view->render($template);
