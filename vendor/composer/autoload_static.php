<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc417925c7224c9f9f53eb61606713bd
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
            1 => __DIR__ . '/../..' . '/app/user',
            2 => __DIR__ . '/../..' . '/app/classes/comments',
            3 => __DIR__ . '/../..' . '/app/classes/main-page',
            4 => __DIR__ . '/../..' . '/app/classes/posts',
            5 => __DIR__ . '/../..' . '/app/classes/topics',
            6 => __DIR__ . '/../..' . '/app/classes/users',
            7 => __DIR__ . '/../..' . '/app/classes/pagination',
            8 => __DIR__ . '/../..' . '/app/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc417925c7224c9f9f53eb61606713bd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc417925c7224c9f9f53eb61606713bd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc417925c7224c9f9f53eb61606713bd::$classMap;

        }, null, ClassLoader::class);
    }
}
