<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaf8a197275453a1c6537bf846dee1fd0
{
    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'chriskacerguis\\RestServer\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'chriskacerguis\\RestServer\\' => 
        array (
            0 => __DIR__ . '/..' . '/chriskacerguis/codeigniter-restserver/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitaf8a197275453a1c6537bf846dee1fd0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaf8a197275453a1c6537bf846dee1fd0::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
