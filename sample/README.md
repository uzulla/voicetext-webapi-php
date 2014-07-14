SAMPLE CODE
============

指定したテキストのwavをダウンロードするツールです


SETUP
========

```
$ composer install
```

APIキーをVoiceText WEB APIのサイトから取得してください。

- VoiceText Web API [https://cloud.voicetext.jp/webapi](https://cloud.voicetext.jp/webapi)


EXEC
========

```
$ php ./exec.php あなたのAPIキー "こんにちは"
request こんにちは
saved wav file to /path/to/1405344731.wav
```

上の例なら`1405344731.wav`にDLされています。

