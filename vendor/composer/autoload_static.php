<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit18992897200fb908f6cacf2e42c01e4c
{
    public static $files = array (
        'ce89ac35a6c330c55f4710717db9ff78' => __DIR__ . '/..' . '/kriswallsmith/assetic/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Process\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Process\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/process',
        ),
    );

    public static $prefixesPsr0 = array (
        'A' => 
        array (
            'Assetic' => 
            array (
                0 => __DIR__ . '/..' . '/kriswallsmith/assetic/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit18992897200fb908f6cacf2e42c01e4c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit18992897200fb908f6cacf2e42c01e4c::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit18992897200fb908f6cacf2e42c01e4c::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
