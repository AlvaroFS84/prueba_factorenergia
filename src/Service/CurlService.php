<?php

namespace App\Service;

use App\Service\Interfaces\GetDataInterface;

class CurlService implements GetDataInterface
{
    
    public function getData($url):string
    {
        $client = curl_init();
        curl_setopt($client, CURLOPT_URL, $url);
        curl_setopt($client, CURLOPT_ENCODING , 'gzip');
        curl_setopt($client, CURLOPT_RETURNTRANSFER, true); 

        $content= curl_exec($client);
        curl_close($client);

        return $content;
    }
}