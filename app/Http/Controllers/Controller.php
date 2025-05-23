<?php

namespace App\Http\Controllers;

use App\Service\Service;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected Service $service;

    //записывается всегда в калсс Controller или в кастомный Однометодный Controller
    public function __construct(Service $service)
    {
        $this->service = $service; // Инициализация свойства $service
    }

}
