<?php
	/* app/models/FeatureCategory.php */
	class FeatureCategory extends Eloquent {
		// DB TABLE NAME
		public $table = 'feature_category';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('category_name', 'group_img', 'header_img', 'icon_img',
									'highlight_desc');
									
		// DEFINE RELATIONSHIPS
		// a feature category can have many feature posts 
		public function featurePost() {
			return $this->hasMany('FeaturePost');
		}
		
		public static function getDbTableName() {
			return 'feature_category';
		}								
	}
?>