<?php

class RensaiPostSeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('rensai_post')->delete();
		
		// Category #1 - Tokyo Pop Culture Graffiti
		DB::table('rensai_post')->insert(
			array(
				'id' => '1',
				'category_id' => '1',
				'post_id' => '1-1',
				'post_title' => 'バブル80’sのディスコカルチャー〜普通の女の子でも遠慮なく遊べた時代 [Tokyo Pop Culture Graffiti episode #01]',
				'primary_img' => 'primary-img-1-1.jpg',
				'thumbnail_img' => 'thumb-img-1-1.jpg',
				'post_body' => 'rensai-1-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('rensai_post')->insert(
			array(
				'id' => '2',
				'category_id' => '1',
				'post_id' => '1-2',
				'post_title' => 'ジュリアナ東京と最後のパーティ～奇妙でロマンチックな3年間 [Tokyo Pop Culture Graffiti episode#02]',
				'primary_img' => 'primary-img-1-2.jpg',
				'thumbnail_img' => 'thumb-img-1-2.jpg',
				'post_body' => 'rensai-1-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		// Category #2 - Tokyo Acoustic Style
		DB::table('rensai_post')->insert(
			array(
				'id' => '3',
				'category_id' => '2',
				'post_id' => '2-1',
				'post_title' => 'And Sneakers Goes On! [Tokyo Acoustic Style Vol.1]',
				'primary_img' => 'primary-img-2-1.jpg',
				'thumbnail_img' => 'thumb-img-2-1.jpg',
				'post_body' => 'rensai-2-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('rensai_post')->insert(
			array(
				'id' => '4',
				'category_id' => '2',
				'post_id' => '2-2',
				'post_title' => 'これまでにない、東京的ヨガウェアとは？[Tokyo Acoustic Style Vol.2]',
				'primary_img' => 'primary-img-2-2.jpg',
				'thumbnail_img' => 'thumb-img-2-2.jpg',
				'post_body' => 'rensai-2-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		// Category #3 - Birthday Stories
		DB::table('rensai_post')->insert(
			array(
				'id' => '5',
				'category_id' => '3',
				'post_id' => '3-1',
				'post_title' => '尾形 真理子 | あなたと旅したひとり旅 [Birthday Stories Vol.1]',
				'primary_img' => 'primary-img-3-1.jpg',
				'thumbnail_img' => 'thumb-img-3-1.jpg',
				'post_body' => 'rensai-3-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('rensai_post')->insert(
			array(
				'id' => '6',
				'category_id' => '3',
				'post_id' => '3-2',
				'post_title' => '狗飼恭子 | 今夜、きっといい夢を見る [Birthday Stories Vol.2]',
				'primary_img' => 'primary-img-3-2.jpg',
				'thumbnail_img' => 'thumb-img-3-2.jpg',
				'post_body' => 'rensai-3-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		// Category #4 - Compass For
		DB::table('rensai_post')->insert(
			array(
				'id' => '7',
				'category_id' => '4',
				'post_id' => '4-1',
				'post_title' => 'かつて”東京”と呼ばれた、古都ハノイへ。 〜VIETNAM〜 [Compass for vol.01-女子デザイナー、世界一周一人旅]',
				'primary_img' => 'primary-img-4-1.jpg',
				'thumbnail_img' => 'thumb-img-4-1.jpg',
				'post_body' => 'rensai-4-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('rensai_post')->insert(
			array(
				'id' => '8',
				'category_id' => '4',
				'post_id' => '4-2',
				'post_title' => 'ラオスには何もない幸せがあった。 〜LAOS〜 [Compass for vol.02-女子デザイナー、世界一周一人旅]',
				'primary_img' => 'primary-img-4-2.jpg',
				'thumbnail_img' => 'thumb-img-4-2.jpg',
				'post_body' => 'rensai-4-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);	
	}
}