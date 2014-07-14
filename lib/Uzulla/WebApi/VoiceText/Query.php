<?php
namespace Uzulla\WebApi\VoiceText;

class Query{

    static $defaultApiKey = null;
    static $defaultText = null;
    static $defaultSpeaker = 'takeru';
    static $defaultEmotion = null;
    static $defaultEmotionLevel = null;
    static $defaultPitch = 100;
    static $defaultSpeed = 100;
    static $defaultVolume = 100;

    public $apiKey;
    public $text;
    public $speaker;
    public $emotion;
    public $emotionLevel;
    public $pitch;
    public $speed;
    public $volume;

    public function __construct(){
        $this->apiKey = self::$defaultApiKey;
        $this->text = self::$defaultText;
        $this->speaker = self::$defaultSpeaker;
        $this->emotion = self::$defaultEmotion;
        $this->emotionLevel = self::$defaultEmotionLevel;
        $this->pitch = self::$defaultPitch;
        $this->speed = self::$defaultSpeed;
        $this->volume = self::$defaultVolume;
    }

    public function validate(){
        $error_list = [];

        if(is_null($this->apiKey)){
            $error_list['apiKey'] = 'must set api key';
        }

        if(!mb_check_encoding($this->text,'UTF-8')){
            $error_list['text'] = 'text must be UTF-8 encoding';
        }

        if(mb_strlen($this->text)<1 || mb_strlen($this->text)>200 ){
            $error_list['text'] = 'text length must be between 1-200';
        }

        if(
            $this->speaker!=='show' &&
            $this->speaker!=='haruka' &&
            $this->speaker!=='hikari' &&
            $this->speaker!=='takeru'
        ){
            $error_list['speaker'] = 'unknown speaker';
        }

        if(!is_null($this->emotion)){
            if(
                $this->speaker !== 'haruka' &&
                $this->speaker !== 'hikari' &&
                $this->speaker !== 'takeru'
            ){
                $error_list['emotion'] = 'specify speaker not support emotion';
            }else if(
                $this->emotion !== 'happiness' &&
                $this->speaker !== 'anger' &&
                $this->speaker !== 'sadness'
            ){
                $error_list['emotion'] = 'unknown emotion';
            }
        }

        if(!is_null($this->emotionLevel) && !preg_match('/\A[12]\z/u', $this->emotionLevel)){
            $error_list['emotionLevel'] = 'emotion level must 1 or 2';
        }

        if(!is_int($this->pitch) || $this->pitch<50 || $this->pitch>200 ){
            $error_list['pitch'] = 'pitch must set between 50-200';
        }

        if(!is_int($this->speed) || $this->speed<50 || $this->speed>400 ){
            $error_list['speed'] = 'speed must set between 50-400';
        }

        if(!is_int($this->volume) || $this->volume<50 || $this->volume>400 ){
            $error_list['volume'] = 'volume must set between 50-200';
        }

        return $error_list;
    }

    public function isOk(){
        $result = $this->validate();
        return empty($result);
    }

    public function generateParamsHash(){
        if(!$this->isOk())
            throw new \InvalidArgumentException('query is not ok');

        $query = [];
        $query['text'] = $this->text;
        $query['speaker'] = $this->speaker;
        $query['emotion'] = (is_null($this->emotion))?null:$this->emotion;
        $query['emotionLevel'] = (is_null($this->emotionLevel))?null:$this->emotionLevel;
        $query['pitch'] = $this->pitch;
        $query['speed'] = $this->speed;
        $query['volume'] = $this->volume;
        return $query;
    }


}