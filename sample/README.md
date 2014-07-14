サンプルコード
============

指定したテキストのwavをダウンロードするツールです


SETUP
========

```
$ composer install
```

APIキーをVoiceText WEB APIのサイトから取得してください。


EXEC
========

```
$ php ./exec.php あなたのAPIキー "こんにちは"
request こんにちは
saved wav file to /path/to/1405344731.wav
```

上の例なら`1405344731.wav`にDLされています。

