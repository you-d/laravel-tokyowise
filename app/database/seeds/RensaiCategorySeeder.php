<?php

class RensaiCategorySeeder extends Seeder {
	public function run() {
		// Clear our database 
		Db::table('rensai_post')->delete();
		Db::table('rensai_category')->delete();		
		
		DB::table('rensai_category')->insert(
			array(
				'id' => '1',
				'category_name' => 'Tokyo Pop Culture Graffiti',
				'group_img' => 'group-img-1.png',
				'header_img' => 'header-img-1.png',
				'icon_img' => 'icon-img-1.png',
				'group_desc' => '時代と世代から生まれる新しいカルチャー＝東京のポップカルチャーの歴史とその真相を解き明かす。'
			)
		);
		DB::table('rensai_category')->insert(
			array(
				'id' => '2',
				'category_name' => 'TOKYO ACOUSTIC STYLE',
				'group_img' => 'group-img-2.png',
				'header_img' => 'header-img-2.png',
				'icon_img' => 'icon-img-2.png',
				'group_desc' => 'シンプルでナチュラル。でもそれだけじゃない何かを探して。
							     東京に最もふさわしい”アコースティック”な気分を見つけよう。'
			)
		);
		DB::table('rensai_category')->insert(
			array(
				'id' => '3',
				'category_name' => 'Birthday Stories',
				'group_img' => 'group-img-3.png',
				'header_img' => 'header-img-3.png',
				'icon_img' => 'icon-img-3.png',
				'group_desc' => 'それぞれの、誕生日にまつわる小さな出来事。そこから始まる何かに期待を寄せて。
								 今をときめく新進気鋭の作家たちが描く、珠玉のショートストーリー。'
			)
		);
		DB::table('rensai_category')->insert(
			array(
				'id' => '4',
				'category_name' => 'Compass For',
				'group_img' => 'group-img-4.png',
				'header_img' => 'header-img-4.png',
				'icon_img' => 'icon-img-4.png',
				'group_desc' => '３ヶ月かけて世界一周の旅に出たTOKYOWISEのデザイナー。
								 その審美眼で切り撮る世界の色とデザインを覗いてみよう。'
			)
		);	
	}
}		