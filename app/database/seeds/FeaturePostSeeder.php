<?php

class FeaturePostSeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('feature_post')->delete();
		
		DB::table('feature_post')->insert(
			array(
				'id' => '1',
				'category_id' => '1',
				'post_id' => '5-1',
				'post_title' => '東京的オトナ遊び 昼下がりの蕎麦屋',
				'header_img' => 'header-img-vol5-1.png',
				'primary_img' => 'primary-img-vol5-1.jpg',
				'thumbnail_img' => 'thumb-img-vol5-1.jpg',
				'post_body' => 'feature-vol5-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('feature_post')->insert(
			array(
				'id' => '2',
				'category_id' => '1',
				'post_id' => '5-2',
				'post_title' => '教えて外国人！ドン・キホーテ＆ザ・ダイソーで何買ってるんですか？What Do You Buy in Japan？',
				'header_img' => 'header-img-vol5-2.png',
				'primary_img' => 'primary-img-vol5-2.jpg',
				'thumbnail_img' => 'thumb-img-vol5-2.jpg',
				'post_body' => 'feature-vol5-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('feature_post')->insert(
			array(
				'id' => '3',
				'category_id' => '1',
				'post_id' => '5-3',
				'post_title' => '外国人を連れて行きたい！ 新・東京観光スポット“Mu Sa Ko”とは？ Tokyo Hotspot Mu Sa Ko',
				'header_img' => 'header-img-vol5-3.png',
				'primary_img' => 'primary-img-vol5-3.jpg',
				'thumbnail_img' => 'thumb-img-vol5-3.jpg',
				'post_body' => 'feature-vol5-3.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('feature_post')->insert(
			array(
				'id' => '4',
				'category_id' => '1',
				'post_id' => '5-4',
				'post_title' => 'スターバックスの秘密兵器「クローバー」とは！？What’s Clover?',
				'header_img' => 'header-img-vol5-4.png',
				'primary_img' => 'primary-img-vol5-4.jpg',
				'thumbnail_img' => 'thumb-img-vol5-4.jpg',
				'post_body' => 'feature-vol5-4.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('feature_post')->insert(
			array(
				'id' => '5',
				'category_id' => '2',
				'post_id' => '6-1',
				'post_title' => '女子がウンザリした、東京NGデート No More Terrible Dating!',
				'header_img' => 'header-img-vol6-1.png',
				'primary_img' => 'primary-img-vol6-1.jpg',
				'thumbnail_img' => 'thumb-img-vol6-1.jpg',
				'post_body' => 'feature-vol6-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('feature_post')->insert(
			array(
				'id' => '6',
				'category_id' => '2',
				'post_id' => '6-2',
				'post_title' => '5000人の女の子たちが教えてくれたこと〜ある男の合コン手記～',
				'header_img' => 'header-img-vol6-2.png',
				'primary_img' => 'primary-img-vol6-2.jpg',
				'thumbnail_img' => 'thumb-img-vol6-2.jpg',
				'post_body' => 'feature-vol6-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
	}
}