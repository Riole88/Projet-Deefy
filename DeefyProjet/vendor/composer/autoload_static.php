<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit57ff263d814464f9a51cd0e0850c38db
{
    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'deefyprojet\\conf\\' => 17,
            'deefyprojet\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'deefyprojet\\conf\\' => 
        array (
            0 => __DIR__ . '/../..' . '/conf',
        ),
        'deefyprojet\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit57ff263d814464f9a51cd0e0850c38db::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit57ff263d814464f9a51cd0e0850c38db::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit57ff263d814464f9a51cd0e0850c38db::$classMap;

        }, null, ClassLoader::class);
    }
}
