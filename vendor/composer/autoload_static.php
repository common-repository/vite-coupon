<?php



namespace Composer\Autoload;

class ComposerStaticInit6f9f6fa2db0331bc4285613cd308da9d
{
    public static $files = array (
        'a19e8cd3aa4160abcc3f6edf7cd368e2' => __DIR__ . '/..' . '/appsbd-wp/appsbd-lite/appsbd_lite/v2/core/class-kernel-lite.php',
        'c2ee1676bdaff559695ea41431ae0b67' => __DIR__ . '/..' . '/appsbd-wp/appsbd-lite/appsbd_lite/v2/helper/base-helper.php',
        'a03e5234ebd45587a6f73c67b6bae94a' => __DIR__ . '/../..' . '/vite_coupon_lite/core/class-vite-coupon-lite.php',
        '6c67b8a63623b91d3c8ea5cd1ee0de86' => __DIR__ . '/../..' . '/vite_coupon_lite/helper/global-helper.php',
        'a74fe630eab20700c68b2768af4e3b36' => __DIR__ . '/../..' . '/vite_coupon_lite/helper/plugin-helper.php',
        '1c2274f5fb29a0b1eee729c1beaac7a8' => __DIR__ . '/../..' . '/vite_coupon_lite/libs/class-vite-coupon-loader.php',
    );

    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Vite_Coupon_Lite\\' => 17,
        ),
        'A' => 
        array (
            'Appsbd_Lite\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Vite_Coupon_Lite\\' => 
        array (
            0 => __DIR__ . '/../..' . '/vite_coupon_lite',
        ),
        'Appsbd_Lite\\' => 
        array (
            0 => __DIR__ . '/..' . '/appsbd-wp/appsbd-lite/appsbd_lite',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6f9f6fa2db0331bc4285613cd308da9d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6f9f6fa2db0331bc4285613cd308da9d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6f9f6fa2db0331bc4285613cd308da9d::$classMap;

        }, null, ClassLoader::class);
    }
}
