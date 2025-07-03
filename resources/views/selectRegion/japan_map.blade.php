<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>無題ドキュメント</title>
<link href="{{asset('css/style_map.css')}}" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
<style>
/* タイトルブロック用のスタイル */
.title-container {
  max-width: 777px;   /* 地図と同じ幅 */
  margin: 2rem auto;  /* 中央寄せ & 上下に余白 */
  text-align: center; /* 文字を中央揃え */
}
</style>
</head>

<body>

<!-- タイトル部分 -->
<div class="title-container">
  <h1 class="fs-2 text-primary">天気予報アプリ（テスト）</h1>
  <p class="fs-5 text-secondary">地域を選択してください</p>
</div>

<div id="japan-map" class="clearfix">

<div id="hokkaido-touhoku" class="clearfix">
	<p class="area-title">北海道・東北</p>
	<div class="area">
		<a href="/weather/北海道">
        	<div id="hokkaido">
        		<p>北海道</p>
          	</div>
		</a>
		<a href="/weather/青森">
			<div id="aomori">
				<p>青森</p>
			</div>
		</a>
		<a href="/weather/秋田">
			<div id="akita">
				<p>秋田</p>
			</div>
		</a>
		<a href="/weather/岩手">
			<div id="iwate">
				<p>岩手</p>
			</div>
		</a>
		<a href="/weather/山形">
			<div id="yamagata">
				<p>山形</p>
			</div>
		</a>
		<a href="/weather/宮城">
			<div id="miyagi">
				<p>宮城</p>
			</div>
		</a>
		<a href="/weather/福島">
			<div id="fukushima">
				<p>福島</p>
			</div>
		</a>
	</div>
</div>


<div id="kantou">
	<p class="area-title">関東</p>
	<div class="area">
		<a href="/weather/群馬">
			<div id="gunma">
				<p>群馬</p>
			</div>
		</a>
		<a href="/weather/栃木">
			<div id="tochigi">
				<p>栃木</p>
			</div>
		</a>
		<a href="/weather/茨城">
			<div id="ibaraki">
				<p>茨城</p>
			</div>
		</a>
		<a href="/weather/埼玉">
			<div id="saitama">
				<p>埼玉</p>
			</div>
		</a>
		<a href="/weather/千葉">
			<div id="chiba">
				<p>千葉</p>
			</div>
		</a>
		<a href="/weather/東京">
			<div id="tokyo">
				<p>東京</p>
			</div>
		</a>
		<a href="/weather/神奈川">
			<div id="kanagawa">
				<p>神奈川</p>
			</div>
		</a>
	</div>
</div>


<div id="tyubu" class="clearfix">
	<p class="area-title">中部</p>
	<div class="area">
		<a href="/weather/新潟">
			<div id="niigata">
				<p>新潟</p>
			</div>
		</a>
		<a href="/weather/富山">
			<div id="toyama">
				<p>富山</p>
			</div>
		</a>
		<a href="/weather/石川">
			<div id="ishikawa">
				<p>石川</p>
			</div>
		</a>
		<a href="/weather/福井">
			<div id="fukui">
				<p>福井</p>
			</div>
		</a>
		<a href="/weather/山梨">
			<div id="yamanashi">
				<p>山梨</p>
			</div>
		</a>
		<a href="/weather/長野">
			<div id="nagano">
				<p>長野</p>
			</div>
		</a>
		<a href="/weather/岐阜">
			<div id="gifu">
				<p>岐阜</p>
			</div>
		</a>
		<a href="/weather/静岡">
			<div id="shizuoka">
				<p>静岡</p>
			</div>
		</a>
		<a href="/weather/愛知">
			<div id="aichi">
				<p>愛知</p>
			</div>
		</a>
	</div>
</div>


<div id="kinki" class="clearfix">
	<p class="area-title">近畿</p>
	<div class="area">
		<a href="/weather/三重">
			<div id="mie">
				<p>三重</p>
			</div>
		</a>
		<a href="/weather/滋賀">
			<div id="shiga">
				<p>滋賀</p>
			</div>
		</a>
		<a href="/weather/京都">
			<div id="kyoto">
				<p>京都</p>
			</div>
		</a>
		<a href="/weather/大阪">
			<div id="osaka">
				<p>大阪</p>
			</div>
		</a>
		<a href="/weather/兵庫">
			<div id="hyogo">
				<p>兵庫</p>
			</div>
		</a>
		<a href="/weather/奈良">
			<div id="nara">
				<p>奈良</p>
			</div>
		</a>
		<a href="/weather/和歌山">
			<div id="wakayama">
				<p>和歌山</p>
			</div>
		</a>
	</div>
</div>


<div id="tyugoku" class="clearfix">
	<p class="area-title">中国</p>
	<div class="area">
		<a href="/weather/鳥取">
			<div id="tottori">
				<p>鳥取</p>
			</div>
		</a>
		<a href="/weather/岡山">
			<div id="okayama">
				<p>岡山</p>
			</div>
		</a>
		<a href="/weather/島根">
			<div id="shimane">
				<p>島根</p>
			</div>
		</a>
		<a href="/weather/広島">
			<div id="hiroshima">
				<p>広島</p>
			</div>
		</a>
		<a href="/weather/山口">
			<div id="yamaguchi">
				<p>山口</p>
			</div>
		</a>
	</div>
</div>


<div id="shikoku" class="clearfix">
	<p class="area-title">四国</p>
	<div class="area">
		<a href="/weather/香川">
			<div id="kagawa">
				<p>香川</p>
			</div>
		</a>
		<a href="/weather/愛媛">
			<div id="ehime">
				<p>愛媛</p>
			</div>
		</a>
		<a href="/weather/徳島">
			<div id="tokushima">
				<p>徳島</p>
			</div>
		</a>
		<a href="/weather/高知">
			<div id="kouchi">
				<p>高知</p>
			</div>
		</a>
	</div>
</div>


<div id="kyusyu" class="clearfix">
	<p class="area-title">九州・沖縄</p>
	<div class="area">
		<a href="/weather/福岡">
			<div id="fukuoka">
				<p>福岡</p>
			</div>
		</a>
		<a href="/weather/佐賀">
			<div id="saga">
				<p>佐賀</p>
			</div>
		</a>
		<a href="/weather/長崎">
			<div id="nagasaki">
				<p>長崎</p>
			</div>
		</a>
		<a href="/weather/大分">
			<div id="oita">
				<p>大分</p>
			</div>
		</a>
		<a href="/weather/熊本">
			<div id="kumamoto">
				<p>熊本</p>
			</div>
		</a>
		<a href="/weather/宮崎">
			<div id="miyazaki">
				<p>宮崎</p>
			</div>
		</a>
		<a href="/weather/鹿児島">
			<div id="kagoshima">
				<p>鹿児島</p>
			</div>
		</a>
		<a href="/weather/沖縄">
			<div id="okinawa">
				<p>沖縄</p>
			</div>
		</a>
	</div>
</div>


</div> <!-- japan-map -->

</body>
</html>
