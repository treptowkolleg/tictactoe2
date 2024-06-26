<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite64322cb16e301bb10d569e343c15e16
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Btinet\\Tictactoe\\' => 17,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Btinet\\Tictactoe\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite64322cb16e301bb10d569e343c15e16::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite64322cb16e301bb10d569e343c15e16::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite64322cb16e301bb10d569e343c15e16::$classMap;

        }, null, ClassLoader::class);
    }
}
