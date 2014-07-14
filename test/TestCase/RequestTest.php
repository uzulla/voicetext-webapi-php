<?php
namespace TestCase;

use \Uzulla\WebApi\VoiceText\Request as VTR;
use \Uzulla\WebApi\VoiceText\Query as VTQ;

class RequestTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $query = new VTQ;
        $query->text = 'hello';

        $res = VTR::getResponse($query);

        $this->assertTrue($res->isSuccess());
    }

    public function testComplex()
    {
        $query = new VTQ;
        $query->text = 'こんにちは';
        $query->speaker = 'haruka';
        $query->emotion = 'happiness';
        $query->emotion_level = 2;
        $query->pitch = 100;
        $query->speed = 100;
        $query->volume = 100;
//        var_dump($query->validate());

        $res = VTR::getResponse($query);

        $this->assertTrue($res->isSuccess());
    }
}
