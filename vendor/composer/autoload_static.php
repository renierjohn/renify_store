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
        'Functions\\renify\\Controller' => __DIR__ . '/../..' . '/functions/Controller.php',
        'Functions\\renify\\Render' => __DIR__ . '/../..' . '/functions/Render.php',
        'Functions\\renify\\SEO' => __DIR__ . '/../..' . '/functions/SEO.php',
        'Klein\\AbstractResponse' => __DIR__ . '/..' . '/klein/klein/src/Klein/AbstractResponse.php',
        'Klein\\AbstractRouteFactory' => __DIR__ . '/..' . '/klein/klein/src/Klein/AbstractRouteFactory.php',
        'Klein\\App' => __DIR__ . '/..' . '/klein/klein/src/Klein/App.php',
        'Klein\\DataCollection\\DataCollection' => __DIR__ . '/..' . '/klein/klein/src/Klein/DataCollection/DataCollection.php',
        'Klein\\DataCollection\\HeaderDataCollection' => __DIR__ . '/..' . '/klein/klein/src/Klein/DataCollection/HeaderDataCollection.php',
        'Klein\\DataCollection\\ResponseCookieDataCollection' => __DIR__ . '/..' . '/klein/klein/src/Klein/DataCollection/ResponseCookieDataCollection.php',
        'Klein\\DataCollection\\RouteCollection' => __DIR__ . '/..' . '/klein/klein/src/Klein/DataCollection/RouteCollection.php',
        'Klein\\DataCollection\\ServerDataCollection' => __DIR__ . '/..' . '/klein/klein/src/Klein/DataCollection/ServerDataCollection.php',
        'Klein\\Exceptions\\DispatchHaltedException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/DispatchHaltedException.php',
        'Klein\\Exceptions\\DuplicateServiceException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/DuplicateServiceException.php',
        'Klein\\Exceptions\\HttpException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/HttpException.php',
        'Klein\\Exceptions\\HttpExceptionInterface' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/HttpExceptionInterface.php',
        'Klein\\Exceptions\\KleinExceptionInterface' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/KleinExceptionInterface.php',
        'Klein\\Exceptions\\LockedResponseException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/LockedResponseException.php',
        'Klein\\Exceptions\\RegularExpressionCompilationException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/RegularExpressionCompilationException.php',
        'Klein\\Exceptions\\ResponseAlreadySentException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/ResponseAlreadySentException.php',
        'Klein\\Exceptions\\RoutePathCompilationException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/RoutePathCompilationException.php',
        'Klein\\Exceptions\\UnhandledException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/UnhandledException.php',
        'Klein\\Exceptions\\UnknownServiceException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/UnknownServiceException.php',
        'Klein\\Exceptions\\ValidationException' => __DIR__ . '/..' . '/klein/klein/src/Klein/Exceptions/ValidationException.php',
        'Klein\\HttpStatus' => __DIR__ . '/..' . '/klein/klein/src/Klein/HttpStatus.php',
        'Klein\\Klein' => __DIR__ . '/..' . '/klein/klein/src/Klein/Klein.php',
        'Klein\\Request' => __DIR__ . '/..' . '/klein/klein/src/Klein/Request.php',
        'Klein\\Response' => __DIR__ . '/..' . '/klein/klein/src/Klein/Response.php',
        'Klein\\ResponseCookie' => __DIR__ . '/..' . '/klein/klein/src/Klein/ResponseCookie.php',
        'Klein\\Route' => __DIR__ . '/..' . '/klein/klein/src/Klein/Route.php',
        'Klein\\RouteFactory' => __DIR__ . '/..' . '/klein/klein/src/Klein/RouteFactory.php',
        'Klein\\ServiceProvider' => __DIR__ . '/..' . '/klein/klein/src/Klein/ServiceProvider.php',
        'Klein\\Validator' => __DIR__ . '/..' . '/klein/klein/src/Klein/Validator.php',
        'League\\Plates\\Engine' => __DIR__ . '/..' . '/league/plates/src/Engine.php',
        'League\\Plates\\Extension\\Asset' => __DIR__ . '/..' . '/league/plates/src/Extension/Asset.php',
        'League\\Plates\\Extension\\ExtensionInterface' => __DIR__ . '/..' . '/league/plates/src/Extension/ExtensionInterface.php',
        'League\\Plates\\Extension\\URI' => __DIR__ . '/..' . '/league/plates/src/Extension/URI.php',
        'League\\Plates\\Template\\Data' => __DIR__ . '/..' . '/league/plates/src/Template/Data.php',
        'League\\Plates\\Template\\Directory' => __DIR__ . '/..' . '/league/plates/src/Template/Directory.php',
        'League\\Plates\\Template\\FileExtension' => __DIR__ . '/..' . '/league/plates/src/Template/FileExtension.php',
        'League\\Plates\\Template\\Folder' => __DIR__ . '/..' . '/league/plates/src/Template/Folder.php',
        'League\\Plates\\Template\\Folders' => __DIR__ . '/..' . '/league/plates/src/Template/Folders.php',
        'League\\Plates\\Template\\Func' => __DIR__ . '/..' . '/league/plates/src/Template/Func.php',
        'League\\Plates\\Template\\Functions' => __DIR__ . '/..' . '/league/plates/src/Template/Functions.php',
        'League\\Plates\\Template\\Name' => __DIR__ . '/..' . '/league/plates/src/Template/Name.php',
        'League\\Plates\\Template\\Template' => __DIR__ . '/..' . '/league/plates/src/Template/Template.php',
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
