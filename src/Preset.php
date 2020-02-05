<?php


namespace malshan1993\InertiaPreset;

use Illuminate\Foundation\Console\Presets\Preset as PresetsPreset;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class Preset extends PresetsPreset
{

    public static function install(){
        static::cleanSassDirectory();
        static::cleanJsDirectory();
        static::updatePackages();
        static::updateMix();
        static::updateScripts();
        static::updateAssets();
    }

    public static function cleanSassDirectory(){
        File::cleanDirectory(resource_path('sass'));
    }

    public static function cleanJsDirectory(){
        File::cleanDirectory(resource_path('js'));
    }

    public static function updatePackageArray($packages){
        return array_merge([
            'mix-tailwindcss'=>'^1.2.0',
            '@inertiajs/inertia'=>'^0.1.7',
            '@inertiajs/inertia-vue'=>'^0.1.2'
        ], Arr::except($packages,[
            'popper.js',
            'lodash',
            'jquery',
            'bootstrap'
        ]));
    }

    public static function updateMix(){
        copy(__DIR__.'/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    public static function updateScripts(){
        copy(__DIR__.'/stubs/app.js', resource_path('js/app.js'));
        copy(__DIR__.'/stubs/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    public static function updateAssets(){
        File::makeDirectory(resource_path('js/Pages'));
        File::makeDirectory(resource_path('js/Share'));
        copy(__DIR__.'/stubs/Pages/Welcome.vue', resource_path('js/Pages/Welcome.vue'));
        copy(__DIR__.'/stubs/Share/Layout.vue', resource_path('js/Share/Layout.vue'));
    }
}
