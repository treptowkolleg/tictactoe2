<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite64322cb16e301bb10d569e343c15e16
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInite64322cb16e301bb10d569e343c15e16', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite64322cb16e301bb10d569e343c15e16', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite64322cb16e301bb10d569e343c15e16::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
