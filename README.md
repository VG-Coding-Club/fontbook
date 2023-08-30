# fontbook

[@font-face](https://developer.mozilla.org/ja/docs/Web/CSS/@font-face)
独自フォントを指定するCSS

```
@font-face {
  font-family: "フォント名";
  src: url("フォント URL") format("opentype"),
  url("フォント URL") format("woff2");
}
```
フォントはリモートサーバーまたはユーザー自身のコンピューターにローカルにインストールされたフォントのどちらかから読み込むことができます。
利用可能なフォント形式（format）は、"woff", "woff2", "truetype", "opentype", "embedded-opentype", "svg"
