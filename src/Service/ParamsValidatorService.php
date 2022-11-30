<?php

namespace App\Service;

use BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use App\Service\Interfaces\ValidationInterface;

class ParamsValidatorService implements ValidationInterface
{
    public function validate(Request $request):bool {
        
        $taggedParam = $request->query->get('tagged', false);
        $fromDateParam =  $request->query->get('fromdate', false);
        $todateParam =  $request->query->get('todate', false);

        if(!$taggedParam){
            throw new BadRequestException('Tagged param is mandatory');
        }

        if($fromDateParam && strtotime($fromDateParam) === false){
            throw new BadRequestException('Malformed fromdate param');
        }

        if($todateParam && strtotime($todateParam) === false){
            throw new BadRequestException('Malformed todate param');
        }
        

        return $taggedParam;
    }
}