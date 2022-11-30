<?php

namespace App\Service\Interfaces;

use Symfony\Component\HttpFoundation\Request;

interface ValidationInterface
{
    public function validate(Request $request):bool;
}