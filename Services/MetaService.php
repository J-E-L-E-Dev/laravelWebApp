<?php
/**
 * Created by PhpStorm.
 * User: Edwin Villegas
 * Date: 18/02/2024
 * Time: 10:25
 */

namespace LaravelWebApp\Services;


class MetaService
{
    public function render()
    {
        return "<?php \$config = (new \LaravelWebApp\Services\ManifestService)->generate(); echo \$__env->make( 'laravelwebapp::meta' , ['config' => \$config])->render(); ?>";
    }

}