<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd49a6481367bef9229d6c7378321e187
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Library\\' => 8,
        ),
        'A' => 
        array (
            'Applications\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Library\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Lib',
        ),
        'Applications\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd49a6481367bef9229d6c7378321e187::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd49a6481367bef9229d6c7378321e187::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd49a6481367bef9229d6c7378321e187::$classMap;

        }, null, ClassLoader::class);
    }
}
