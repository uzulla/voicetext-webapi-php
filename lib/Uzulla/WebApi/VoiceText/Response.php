<?php
namespace Uzulla\WebApi\VoiceText;

use \GuzzleHttp\Message\ResponseInterface as GuzzleResponseInterface;

class Response{
    /** @var number respond status code. */
    public $statusCode;
    /** @var string respond content-type. */
    public $contentType;
    /** @var string respond body(maybe json). If wav respond, this is blank. */
    public $responseRaw;
    /** @var string body saved filename */
    public $tempFileName;

    public function __construct(GuzzleResponseInterface $res){
        $this->statusCode = (int)$res->getStatusCode();
        $this->contentType = $res->getHeader('content-type');

        if($this->statusCode===200 && $this->contentType==='audio/wave'){
            $tmp_file_name = tempnam(sys_get_temp_dir(), 'vt_wav_');
            @file_put_contents($tmp_file_name, $res->getBody());
            $this->tempFileName = $tmp_file_name;
        }else{
            $this->responseRaw = $res->getBody();
        }
    }

    /**
     * check request success or fail.
     * @return bool
     */
    public function isSuccess(){
        if((int)$this->statusCode!==200)
            return false;

        if($this->contentType!=='audio/wave')
            return false;

        if(!file_exists($this->tempFileName) || filesize($this->tempFileName)===0 )
            return false;

        return true;
    }
}
