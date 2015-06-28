<?php

class FeatureCategorySeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('feature_post')->delete();
		Db::table('feature_category')->delete();
		
		DB::table('feature_category')->insert(
			array(
				'id' => '1',
				'category_name' => 'Vol.5 TOKYO STANDARD',
				'group_img' => 'group-img-vol5.png',
				'icon_img' => 'icon-img-vol5.png',
				'highlight_desc' => 'V5 東京は慌ただしい。東京は乾いている。そこに愛はあるのか？純愛、
									 偏愛とりまぜて、東京に確かに存在する新しい”愛”のカタチをTOKYOWISEならではの視点で考えてみた。'
			)
		);
		DB::table('feature_category')->insert(
			array(
				'id' => '2',
				'category_name' => 'Vol.6 TOKYO LOVE',
				'group_img' => 'group-img-vol6.png',
				'icon_img' => 'icon-img-vol6.png',
				'highlight_desc' => 'V6 東京は慌ただしい。東京は乾いている。そこに愛はあるのか？純愛、
									 偏愛とりまぜて、東京に確かに存在する新しい”愛”のカタチをTOKYOWISEならではの視点で考えてみた。'
			)
		);
	}
}