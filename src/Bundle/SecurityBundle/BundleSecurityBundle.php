<?php  
         
namespace App\Bundle\SecurityBundle;
                
use Symfony\Component\HttpKernel\Bundle\Bundle;
                
class BundleSecurityBundle extends Bundle
{
    public function getParent(): string
    {
        return static::class;
    }
}