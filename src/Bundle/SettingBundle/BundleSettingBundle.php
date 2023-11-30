<?php  
         
namespace App\Bundle\SettingBundle;
                
use Symfony\Component\HttpKernel\Bundle\Bundle;
                
class BundleSettingBundle extends Bundle
{
    public function getParent(): string
    {
        return static::class;
    }
}