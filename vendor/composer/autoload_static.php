<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfcf058cab7a04fbf1ddfd74c87f61e9a
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'League\\Plates\\' => 14,
        ),
        'K' => 
        array (
            'Klein\\' => 6,
        ),
        'F' => 
        array (
            'Functions\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'League\\Plates\\' => 
        array (
            0 => __DIR__ . '/..' . '/league/plates/src',
        ),
        'Klein\\' => 
        array (
            0 => __DIR__ . '/..' . '/klein/klein/src/Klein',
        ),
        'Functions\\' => 
        array (
            0 => __DIR__ . '/../..' . '/functions',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Firebase\\Error' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseError.php',
        'Firebase\\FirebaseInterface' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseInterface.php',
        'Firebase\\FirebaseLib' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseLib.php',
        'Firebase\\FirebaseStub' => __DIR__ . '/..' . '/ktamas77/firebase-php/src/firebaseStub.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfcf058cab7a04fbf1ddfd74c87f61e9a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfcf058cab7a04fbf1ddfd74c87f61e9a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitfcf058cab7a04fbf1ddfd74c87f61e9a::$classMap;

        }, null, ClassLoader::class);
    }
}
