<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/* Features */
		Schema::create('feature_category', function(Blueprint $table) {
			$table->increments ('id');
			$table->string ('category_name');
			$table->string ('group_img');
			$table->string ('icon_img');
			$table->text ('highlight_desc');
			$table->timestamps ();
		});
		Schema::create('feature_post', function(Blueprint $table) {
			$table->increments ('id');
			$table->integer ('category_id')->unsigned ();
			$table->foreign ('category_id')->references ('id')
										   ->on ('feature_category')
										   ->onDelete('cascade');
			$table->string ('post_id');
			$table->string ('post_title');
			$table->string ('header_img');
			$table->string ('primary_img');
			$table->string ('thumbnail_img');
			$table->string ('post_body');
			$table->datetime ('posting_date');
			$table->timestamps ();
		});

		/* Rensai */
		Schema::create('rensai_category', function(Blueprint $table) {
			$table->increments ('id');
			$table->string ('category_name');
			$table->string ('group_img');
			$table->string ('header_img');
			$table->string ('icon_img');
			$table->text ('group_desc');
			$table->timestamps ();
		});
		Schema::create('rensai_post', function(Blueprint $table) {
			$table->increments ('id');
			$table->integer ('category_id')->unsigned ();
			$table->foreign ('category_id')->references ('id')
										   ->on ('rensai_category')
										   ->onDelete('cascade');
			$table->string ('post_id');
			$table->string ('post_title');
			$table->string ('primary_img');
			$table->string ('thumbnail_img');
			$table->string ('post_body');
			$table->datetime ('posting_date');
			$table->timestamps ();
		});

		/* News */
		Schema::create('news_post', function(Blueprint $table) {
			$table->increments ('id');
			$table->string ('post_title');
			$table->string ('primary_img');
			$table->string ('thumbnail_img');
			$table->string ('post_body');
			$table->datetime ('posting_date');
			$table->timestamps ();
		});

		/* Gadgets */
		Schema::create('gadgets_post', function(Blueprint $table) {
			$table->increments ('id');
			$table->string ('post_title');
			$table->string ('primary_img');
			$table->string ('thumbnail_img');
			$table->text ('primary_img_desc');
			$table->string ('post_body');
			$table->datetime ('posting_date');
			$table->timestamps ();
		});

		/* Register the web admin into the system */
		Sentry::createUser(array('email' => 'john.doe@example.com',
							     											'password' => 'password',
																		    'activated' => true,
																		    'first_name' => 'John',
																		    'last_name' => 'Doe'));

		/* Table seeding */
		/* Feature Category */
		FeatureCategory::create(array(
					'category_name' => 'Vol.5 TOKYO STANDARD',
					'group_img' => 'group-img-vol5.png',
					'icon_img' => 'icon-img-vol5.png',
					'highlight_desc' => 'V5 東京は慌ただしい。東京は乾いている。そこに愛はあるのか？純愛、
										 					偏愛とりまぜて、東京に確かに存在する新しい”愛”のカタチをTOKYOWISEならではの視点で考えてみた。'
		));
		FeatureCategory::create(array(
					'category_name' => 'Vol.6 TOKYO LOVE',
					'group_img' => 'group-img-vol6.png',
					'icon_img' => 'icon-img-vol6.png',
					'highlight_desc' => 'V6 東京は慌ただしい。東京は乾いている。そこに愛はあるのか？純愛、
															偏愛とりまぜて、東京に確かに存在する新しい”愛”のカタチをTOKYOWISEならではの視点で考えてみた。'
		));
		
		/* Feature Post */
		FeaturePost::create(array(
					'category_id' => '1',
					'post_id' => '5-1',
					'post_title' => '東京的オトナ遊び 昼下がりの蕎麦屋',
					'header_img' => 'header-img-vol5-1.png',
					'primary_img' => 'primary-img-vol5-1.jpg',
					'thumbnail_img' => 'thumb-img-vol5-1.jpg',
					'post_body' => 'feature-vol5-1.html',
					'posting_date' => date('Y-m-d H:i:s')
		));
		FeaturePost::create(array(
					'category_id' => '1',
					'post_id' => '5-2',
					'post_title' => '教えて外国人！ドン・キホーテ＆ザ・ダイソーで何買ってるんですか？What Do You Buy in Japan？',
					'header_img' => 'header-img-vol5-2.png',
					'primary_img' => 'primary-img-vol5-2.jpg',
					'thumbnail_img' => 'thumb-img-vol5-2.jpg',
					'post_body' => 'feature-vol5-2.html',
					'posting_date' => date('Y-m-d H:i:s')
		));
		FeaturePost::create(array(
				'category_id' => '1',
				'post_id' => '5-3',
				'post_title' => '外国人を連れて行きたい！ 新・東京観光スポット“Mu Sa Ko”とは？ Tokyo Hotspot Mu Sa Ko',
				'header_img' => 'header-img-vol5-3.png',
				'primary_img' => 'primary-img-vol5-3.jpg',
				'thumbnail_img' => 'thumb-img-vol5-3.jpg',
				'post_body' => 'feature-vol5-3.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		FeaturePost::create(array(
				'category_id' => '1',
				'post_id' => '5-4',
				'post_title' => 'スターバックスの秘密兵器「クローバー」とは！？What’s Clover?',
				'header_img' => 'header-img-vol5-4.png',
				'primary_img' => 'primary-img-vol5-4.jpg',
				'thumbnail_img' => 'thumb-img-vol5-4.jpg',
				'post_body' => 'feature-vol5-4.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		FeaturePost::create(array(
				'category_id' => '2',
				'post_id' => '6-1',
				'post_title' => '女子がウンザリした、東京NGデート No More Terrible Dating!',
				'header_img' => 'header-img-vol6-1.png',
				'primary_img' => 'primary-img-vol6-1.jpg',
				'thumbnail_img' => 'thumb-img-vol6-1.jpg',
				'post_body' => 'feature-vol6-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		FeaturePost::create(array(
				'category_id' => '2',
				'post_id' => '6-2',
				'post_title' => '5000人の女の子たちが教えてくれたこと〜ある男の合コン手記～',
				'header_img' => 'header-img-vol6-2.png',
				'primary_img' => 'primary-img-vol6-2.jpg',
				'thumbnail_img' => 'thumb-img-vol6-2.jpg',
				'post_body' => 'feature-vol6-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));

		/* Rensai Category */
		RensaiCategory::create(array(
				'category_name' => 'Tokyo Pop Culture Graffiti',
				'group_img' => 'group-img-1.png',
				'header_img' => 'header-img-1.png',
				'icon_img' => 'icon-img-1.png',
				'group_desc' => '時代と世代から生まれる新しいカルチャー＝東京のポップカルチャーの歴史とその真相を解き明かす。'
		));

		RensaiCategory::create(array(
				'category_name' => 'TOKYO ACOUSTIC STYLE',
				'group_img' => 'group-img-2.png',
				'header_img' => 'header-img-2.png',
				'icon_img' => 'icon-img-2.png',
				'group_desc' => 'シンプルでナチュラル。でもそれだけじゃない何かを探して。
												 東京に最もふさわしい”アコースティック”な気分を見つけよう。'
		));

		RensaiCategory::create(array(
				'category_name' => 'Birthday Stories',
				'group_img' => 'group-img-3.png',
				'header_img' => 'header-img-3.png',
				'icon_img' => 'icon-img-3.png',
				'group_desc' => 'それぞれの、誕生日にまつわる小さな出来事。そこから始まる何かに期待を寄せて。
								今をときめく新進気鋭の作家たちが描く、珠玉のショートストーリー。'
		));

		RensaiCategory::create(array(
			'category_name' => 'Compass For',
			'group_img' => 'group-img-4.png',
			'header_img' => 'header-img-4.png',
			'icon_img' => 'icon-img-4.png',
			'group_desc' => '３ヶ月かけて世界一周の旅に出たTOKYOWISEのデザイナー。
											 その審美眼で切り撮る世界の色とデザインを覗いてみよう。'
		));

		/* Rensai Post */
		// Category #1 - Tokyo Pop Culture Graffiti
		RensaiPost::create(array(
				'category_id' => '1',
				'post_id' => '1-1',
				'post_title' => 'バブル80’sのディスコカルチャー〜普通の女の子でも遠慮なく遊べた時代 [Tokyo Pop Culture Graffiti episode #01]',
				'primary_img' => 'primary-img-1-1.jpg',
				'thumbnail_img' => 'thumb-img-1-1.jpg',
				'post_body' => 'rensai-1-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		RensaiPost::create(array(
				'category_id' => '1',
				'post_id' => '1-2',
				'post_title' => 'ジュリアナ東京と最後のパーティ～奇妙でロマンチックな3年間 [Tokyo Pop Culture Graffiti episode#02]',
				'primary_img' => 'primary-img-1-2.jpg',
				'thumbnail_img' => 'thumb-img-1-2.jpg',
				'post_body' => 'rensai-1-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		// Category #2 - Tokyo Acoustic Style
		RensaiPost::create(array(
				'category_id' => '2',
				'post_id' => '2-1',
				'post_title' => 'And Sneakers Goes On! [Tokyo Acoustic Style Vol.1]',
				'primary_img' => 'primary-img-2-1.jpg',
				'thumbnail_img' => 'thumb-img-2-1.jpg',
				'post_body' => 'rensai-2-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		RensaiPost::create(array(
				'category_id' => '2',
				'post_id' => '2-2',
				'post_title' => 'これまでにない、東京的ヨガウェアとは？[Tokyo Acoustic Style Vol.2]',
				'primary_img' => 'primary-img-2-2.jpg',
				'thumbnail_img' => 'thumb-img-2-2.jpg',
				'post_body' => 'rensai-2-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		// Category #3 - Birthday Stories
		RensaiPost::create(array(
				'category_id' => '3',
				'post_id' => '3-1',
				'post_title' => '尾形 真理子 | あなたと旅したひとり旅 [Birthday Stories Vol.1]',
				'primary_img' => 'primary-img-3-1.jpg',
				'thumbnail_img' => 'thumb-img-3-1.jpg',
				'post_body' => 'rensai-3-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		RensaiPost::create(array(
				'category_id' => '3',
				'post_id' => '3-2',
				'post_title' => '狗飼恭子 | 今夜、きっといい夢を見る [Birthday Stories Vol.2]',
				'primary_img' => 'primary-img-3-2.jpg',
				'thumbnail_img' => 'thumb-img-3-2.jpg',
				'post_body' => 'rensai-3-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		// Category #4 - Compass For
		RensaiPost::create(array(
				'category_id' => '4',
				'post_id' => '4-1',
				'post_title' => 'かつて”東京”と呼ばれた、古都ハノイへ。 〜VIETNAM〜 [Compass for vol.01-女子デザイナー、世界一周一人旅]',
				'primary_img' => 'primary-img-4-1.jpg',
				'thumbnail_img' => 'thumb-img-4-1.jpg',
				'post_body' => 'rensai-4-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		RensaiPost::create(array(
				'category_id' => '4',
				'post_id' => '4-2',
				'post_title' => 'ラオスには何もない幸せがあった。 〜LAOS〜 [Compass for vol.02-女子デザイナー、世界一周一人旅]',
				'primary_img' => 'primary-img-4-2.jpg',
				'thumbnail_img' => 'thumb-img-4-2.jpg',
				'post_body' => 'rensai-4-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));

		/* News Post */
		NewsPost::create(array(
				'post_title' => '代官山 蔦屋書店が「NAVAデザイン」の販売をスタート',
				'primary_img' => 'primary-img-1.jpg',
				'thumbnail_img' => 'thumb-img-1.jpg',
				'post_body' => 'news-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		NewsPost::create(array(
				'post_title' => 'オープンダイアルの元祖「ハートビート」フレデリック・コンスタントの限定モデル',
				'primary_img' => 'primary-img-2.jpg',
				'thumbnail_img' => 'thumb-img-2.jpg',
				'post_body' => 'news-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		NewsPost::create(array(
				'post_title' => 'マカオ最高級クラスのホテルが今冬誕生',
				'primary_img' => 'primary-img-3.jpg',
				'thumbnail_img' => 'thumb-img-3.jpg',
				'post_body' => 'news-3.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		NewsPost::create(array(
				'post_title' => 'キューバの“いま”をポップに活写 HIRO KIMURA写真集『CUBA』',
				'primary_img' => 'primary-img-4.jpg',
				'thumbnail_img' => 'thumb-img-4.jpg',
				'post_body' => 'news-4.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		NewsPost::create(array(
				'post_title' => 'シャングリ・ラ ホテル 東京と フォションがおくるアフタヌーンティー',
				'primary_img' => 'primary-img-5.jpg',
				'thumbnail_img' => 'thumb-img-5.jpg',
				'post_body' => 'news-5.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		NewsPost::create(array(
				'post_title' => 'ジア・コッポラ監督の長編デビュー作『パロアルト・ストーリー』',
				'primary_img' => 'primary-img-6.jpg',
				'thumbnail_img' => 'thumb-img-6.jpg',
				'post_body' => 'news-6.html',
				'posting_date' => date('Y-m-d H:i:s')
		));

		/* Gadgets Post */
		GadgetsPost::create(array(
				'post_title' => '豪徳寺<br>まねき猫',
				'primary_img' => 'primary-1.png',
				'thumbnail_img' => 'thumb-1.png',
				'primary_img_desc' => '公式招き猫は境内で販売されている。<br>
										300円から3,000円まで。各サイズあり。<br>
										写真の物は1,800円で高さ約15cm。',
				'post_body' => 'gadget-1.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'EFFECTOR<br>眼鏡',
				'primary_img' => 'primary-2.png',
				'thumbnail_img' => 'thumb-2.png',
				'primary_img_desc' => '',
				'post_body' => 'gadget-2.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => '工房HOSONO<br>トートバッグ',
				'primary_img' => 'primary-3.png',
				'thumbnail_img' => 'thumb-3.png',
				'primary_img_desc' => '',
				'post_body' => 'gadget-3.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => '漆芸中島<br>江戸八角箸',
				'primary_img' => 'primary-4.png',
				'thumbnail_img' => 'thumb-4.png',
				'primary_img_desc' => '',
				'post_body' => 'gadget-4.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'マヤコフスキー<br>ズボンをはいた雲',
				'primary_img' => 'primary-5.png',
				'thumbnail_img' => 'thumb-5.png',
				'primary_img_desc' => '',
				'post_body' => 'gadget-5.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'ボーン トゥ<br>ビオ シャワージェル',
				'primary_img' => 'primary-6.jpg',
				'thumbnail_img' => 'thumb-6.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-6.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'ROTHCO<br>ハイグロス オックスフォード<br>ドレスシューズ #5055',
				'primary_img' => 'primary-7.jpg',
				'thumbnail_img' => 'thumb-7.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-7.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'スターバックス<br>炭彩マグAROMA',
				'primary_img' => 'primary-8.jpg',
				'thumbnail_img' => 'thumb-8.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-8.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'イザベル・マラン<br>Good Morning Tokyo スウェット',
				'primary_img' => 'primary-9.jpg',
				'thumbnail_img' => 'thumb-9.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-9.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
		GadgetsPost::create(array(
				'post_title' => 'Monrõ<br>Helinox Elite Chair SP KOLLSHE',
				'primary_img' => 'primary-10.png',
				'thumbnail_img' => 'thumb-10.png',
				'primary_img_desc' => '',
				'post_body' => 'gadget-10.html',
				'posting_date' => date('Y-m-d H:i:s')
		));
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('feature_post');
		Schema::drop('feature_category');
		Schema::drop('rensai_post');
		Schema::drop('rensai_category');
		Schema::drop('news_post');
		Schema::drop('gadgets_post');
	}

}
