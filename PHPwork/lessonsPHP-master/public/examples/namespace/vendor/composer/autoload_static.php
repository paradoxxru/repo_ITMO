<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita5e8e044b929db76a54a9d8ffe4c5610
{
    public static $prefixLengthsPsr4 = array (
        'X' => 
        array (
            'XForms\\' => 7,
        ),
        'P' => 
        array (
            'Pack1\\Pack3\\' => 12,
            'Pack1\\Pack2\\' => 12,
            'Pack1\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'XForms\\' => 
        array (
            0 => __DIR__ . '/../..' . '/XForms',
        ),
        'Pack1\\Pack3\\' => 
        array (
            0 => __DIR__ . '/../..' . '/pack1/pack3',
        ),
        'Pack1\\Pack2\\' => 
        array (
            0 => __DIR__ . '/../..' . '/pack1/pack2',
        ),
        'Pack1\\' => 
        array (
            0 => __DIR__ . '/../..' . '/pack1',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita5e8e044b929db76a54a9d8ffe4c5610::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita5e8e044b929db76a54a9d8ffe4c5610::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
