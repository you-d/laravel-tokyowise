<?php

class NewsPostSeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('news_post')->delete();
		
		DB::table('news_post')->insert(
			array(
				'id' => '1',
				'post_title' => '代官山 蔦屋書店が「NAVAデザイン」の販売をスタート',
				'primary_img' => 'primary-img-1.jpg',
				'thumbnail_img' => 'thumb-img-1.jpg',
				'post_body' => 'news-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('news_post')->insert(
			array(
				'id' => '2',
				'post_title' => 'オープンダイアルの元祖「ハートビート」フレデリック・コンスタントの限定モデル',
				'primary_img' => 'primary-img-2.jpg',
				'thumbnail_img' => 'thumb-img-2.jpg',
				'post_body' => 'news-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('news_post')->insert(
			array(
				'id' => '3',
				'post_title' => 'マカオ最高級クラスのホテルが今冬誕生',
				'primary_img' => 'primary-img-3.jpg',
				'thumbnail_img' => 'thumb-img-3.jpg',
				'post_body' => 'news-3.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('news_post')->insert(
			array(
				'id' => '4',
				'post_title' => 'キューバの“いま”をポップに活写 HIRO KIMURA写真集『CUBA』',
				'primary_img' => 'primary-img-4.jpg',
				'thumbnail_img' => 'thumb-img-4.jpg',
				'post_body' => 'news-4.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('news_post')->insert(
			array(
				'id' => '5',
				'post_title' => 'シャングリ・ラ ホテル 東京と フォションがおくるアフタヌーンティー',
				'primary_img' => 'primary-img-5.jpg',
				'thumbnail_img' => 'thumb-img-5.jpg',
				'post_body' => 'news-5.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('news_post')->insert(
			array(
				'id' => '6',
				'post_title' => 'ジア・コッポラ監督の長編デビュー作『パロアルト・ストーリー』',
				'primary_img' => 'primary-img-6.jpg',
				'thumbnail_img' => 'thumb-img-6.jpg',
				'post_body' => 'news-6.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
	}
}		