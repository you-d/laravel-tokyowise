@extends('layout')
@section('content')
<article role="main" id="main">
	<div id="main-body">
    <div class="centre-container">
      <h1>[Home Page]</h1>
      <hr>
      How to replace the top header image?
      <br>
      <div class="howto-videoframe">
        <div id="video1"><div class="now-loading-text">Loading the player...</div></div>
      </div>
      <br><br>
      <h1>[Rensai Page]</h1>
      <hr>
      How to create, edit, and delete a category and its post?
      <br>
      <div class="howto-videoframe">
        <div id="video2"><div class="now-loading-text">Loading the player...</div></div>
      </div>
    </div>
    <script type="text/javascript">
        jwplayer("video1").setup({
            file: "videos/home-replace-header-img.mp4",
            aspectratio: "16:9",
            width: "100%",
            skin: "jwplayer/skins/five.xml"
        });
    </script>
    <script type="text/javascript">
        jwplayer("video2").setup({
            file: "videos/rensai-cms-demo.mp4",
            aspectratio: "16:9",
            width: "100%",
            skin: "jwplayer/skins/five.xml"
        });
    </script>
</article>
@stop
