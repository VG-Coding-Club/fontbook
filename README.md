# Font Book
```
{
  "org": "___",
  "name": "___",
  "class": "___",
  "by": "___",
  "link": "___",
  "description": "___"
}
```

[@font-face](https://developer.mozilla.org/ja/docs/Web/CSS/@font-face)
独自フォントを指定するCSS

```
@font-face {
  font-family: "フォント名";
  src: url("../family/") format("woff2"),
    url("../family/") format("opentype"),
    url("../family/") format("truetype");
}

.class {
  font-family: "フォント名";
}
```
フォントはリモートサーバーまたはユーザー自身のコンピューターにローカルにインストールされたフォントのどちらかから読み込むことができます。
利用可能なフォント形式（format）は、"woff", "woff2", "truetype", "opentype", "embedded-opentype", "svg"
