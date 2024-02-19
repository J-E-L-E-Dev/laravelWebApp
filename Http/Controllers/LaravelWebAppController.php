<?php

namespace LaravelWebApp\Http\Controllers;

use Exception;
use Illuminate\Routing\Controller;
use LaravelWebApp\Services\ManifestService;

class LaravelWebAppController extends Controller
{
    public function manifestJson()
    {
        $output = (new ManifestService)->generate();
        return response()->json($output);
    }

    public function offline(){
        return view('laravelwebapp::offline');
    }
}
