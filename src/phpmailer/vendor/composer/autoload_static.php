<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67d4298a9c459e8a1ad22f6d441a4f48
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit67d4298a9c459e8a1ad22f6d441a4f48::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit67d4298a9c459e8a1ad22f6d441a4f48::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit67d4298a9c459e8a1ad22f6d441a4f48::$classMap;

        }, null, ClassLoader::class);
    }
}
