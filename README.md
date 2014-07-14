VoiceText Web API library for PHP
=================================

VoiceText Web APIをPHPから利用するためのライブラリです。

This library for VoiceText Web API.


VoiceText Web APIは、入力したテキストを音声ファイル（Wav形式）でダウンロードできるものです。

VoiceText is Text-To-Speech software, that API generate wave audio file.


> VoiceText Web API は HOYAサービス株式会社様が提供するWEB APIです

> VoiceText Web API provided by HOYA Service Corporation.


詳細はこちら [VoiceText Web API](https://cloud.voicetext.jp/webapi)

Detail here. [VoiceText Web API](https://cloud.voicetext.jp/webapi)


# REQUIRE

- PHP>=5.4
- Composer


# SETUP

composerでuzulla/voicetext-apiをrequireしてください。

# SYNOPSIS(利用例)

```
<?php
require_once('vendor/autoload.php');

use \Uzulla\WebApi\VoiceText\Request as VTR;
use \Uzulla\WebApi\VoiceText\Query as VTQ;

// setup
\Uzulla\WebApi\VoiceText\Query::$defaultApiKey = 'YOUR API KEY';

// build query
$query = new VTQ;
$query->text = 'hello';

// request
$res = VTR::getResponse($query);

if($res->isSuccess()){
  $downloaded_wav_file_name = $res->tempFileName;
}else{
  echo "request fail.";
  var_dump($response);
}

```

also ...

```
// ...

// build query
$query = new VTQ;
$query->text = 'こんにちは';
$query->speaker = 'haruka';
$query->emotion = 'happiness';
$query->emotion_level = 2;
$query->pitch = 100;
$query->speed = 100;
$query->volume = 100;

$error_list = $query->validate();

if(!empty($error_list)){
  // query is invalid(local validation). use correct data.
  var_dump($error_list);
  /*
  array(1) {
    'emotion' =>
    string(35) "specify speaker not support emotion"
  }
  */

}else{
  // request
  $res = VTR::getResponse($query);

  if($res->isSuccess()){
    $downloaded_wav_file_name = $res->tempFileName;
  }else{
    echo "request fail.";
    var_dump($response);
  }
}
```

# LICENSE

MIT

# SEE ALSO

- VoiceText Web API [https://cloud.voicetext.jp/webapi](https://cloud.voicetext.jp/webapi)
