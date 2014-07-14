<?php
namespace Uzulla\WebApi\VoiceText;

use GuzzleHttp\Client as Guzzle;

class Request
{

    /**
     * send query to VoiceTextAPI and get Response
     * @param Query $query
     * @return Response
     */
    public static function getResponse(Query $query)
    {
        $query_params = $query->generateParamsHash();

        $client = new Guzzle();
        try{
            $res = $client->post('https://api.voicetext.jp/v1/tts', [
                'auth' => [$query->apiKey, ''],
                'query' => $query_params
            ]);
            return new Response($res);
        }catch(\GuzzleHttp\Exception\ClientException $e){
            // ...
            $res = new Response();
            $res->statusCode = (int)$e->getResponse()->getStatusCode();
            $res->contentType = $e->getResponse()->getHeader('content-type');
            $res->responseRaw = $e->getResponse()->getBody();
            return $res;
        }
    }
}
