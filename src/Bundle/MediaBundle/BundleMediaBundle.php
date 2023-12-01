<?php  
         
namespace App\Bundle\MediaBundle;
                
use Symfony\Component\HttpKernel\Bundle\Bundle;
                
class BundleMediaBundle extends Bundle
{
    public function getParent(): string
    {
        return static::class;
    }
}