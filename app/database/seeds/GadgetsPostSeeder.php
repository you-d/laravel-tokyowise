<?php

class GadgetsPostSeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('gadgets_post')->delete();
	
		DB::table('gadgets_post')->insert(
			array(
				'id' => '1',
				'post_title' => '豪徳寺<br>まねき猫',
				'primary_img' => 'primary-1.jpg',
				'thumbnail_img' => 'thumb-1.jpg',
				'primary_img_desc' => '公式招き猫は境内で販売されている。<br>
									   300円から3,000円まで。各サイズあり。<br>
									   写真の物は1,800円で高さ約15cm。',
				'post_body' => 'gadget-1.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '2',
				'post_title' => 'EFFECTOR<br>眼鏡',
				'primary_img' => 'primary-2.jpg',
				'thumbnail_img' => 'thumb-2.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-2.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '3',
				'post_title' => '工房HOSONO<br>トートバッグ',
				'primary_img' => 'primary-3.jpg',
				'thumbnail_img' => 'thumb-3.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-3.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '4',
				'post_title' => '漆芸中島<br>江戸八角箸',
				'primary_img' => 'primary-4.jpg',
				'thumbnail_img' => 'thumb-4.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-4.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '5',
				'post_title' => 'マヤコフスキー<br>ズボンをはいた雲',
				'primary_img' => 'primary-5.jpg',
				'thumbnail_img' => 'thumb-5.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-5.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '6',
				'post_title' => 'ボーン トゥ<br>ビオ シャワージェル',
				'primary_img' => 'primary-6.jpg',
				'thumbnail_img' => 'thumb-6.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-6.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '7',
				'post_title' => 'ROTHCO<br>ハイグロス オックスフォード<br>ドレスシューズ #5055',
				'primary_img' => 'primary-7.jpg',
				'thumbnail_img' => 'thumb-7.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-7.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '8',
				'post_title' => 'スターバックス<br>炭彩マグAROMA',
				'primary_img' => 'primary-8.jpg',
				'thumbnail_img' => 'thumb-8.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-8.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '9',
				'post_title' => 'イザベル・マラン<br>Good Morning Tokyo スウェット',
				'primary_img' => 'primary-9.jpg',
				'thumbnail_img' => 'thumb-9.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-9.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
		DB::table('gadgets_post')->insert(
			array(
				'id' => '10',
				'post_title' => 'Monrõ<br>Helinox Elite Chair SP KOLLSHE',
				'primary_img' => 'primary-10.jpg',
				'thumbnail_img' => 'thumb-10.jpg',
				'primary_img_desc' => '',
				'post_body' => 'gadget-10.html',
				'posting_date' => date('Y-m-d H:i:s')
			)
		);
	}
}		