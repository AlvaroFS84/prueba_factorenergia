<?php

namespace App\Service;

use App\Service\Interfaces\UrlInterface;
use Symfony\Component\HttpFoundation\Request;

class UrlContructorService implements UrlInterface
{
    const URL = "https://api.stackexchange.com/2.3/questions?site=stackoverflow";

    public function getUrl(Request $request):string {
        $final_url = self::URL."&tagged=".$request->query->get('tagged');
        $fromDate = $request->query->get('fromdate');
        $toDate = $request->query->get('todate');

        if($fromDate){
            $final_url .= "&fromdate=".strtotime($fromDate);
        }

        if($toDate){
            $final_url .= "&fromdate=".strtotime($toDate);
        }   

        return $final_url;
    }
}