<?php


namespace App\TwigTools;



use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class MyTwigFilters extends AbstractExtension
{
    public function getFilters()
    {
        return array(
          new TwigFilter('defaultImage', [$this, 'defaultImage'])
        );
    }

    public function defaultImage($path) {

        $pathToImage =  __DIR__.'/../../public';
        $fullPath = $pathToImage.$path;
        if($path == "" || $path == "/" || !file_exists($fullPath)) {
            return '/images/default.png';
        }
        return $path;
    }
}