<?php

namespace App\Service\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface UrlInterface
{
    public function getUrl(Request $request):string;
}