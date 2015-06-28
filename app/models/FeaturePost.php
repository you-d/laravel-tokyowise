<?php
	/* app/models/FeaturePost.php */
	class FeaturePost extends Eloquent {
		// DB TABLE NAME
		public $table = 'feature_post';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('category_id', 'post_id', 'post_title', 'header-img', 
									'primary_img', 'thumbnail_img', 'post_body', 
									'posting_date');
									
		// DEFINE RELATIONSHIPS
		// a feature post belongs to a feature category
		public function featureCategory() {
			return $this->belongsTo('FeatureCategory');
		}	
		
		public static function getDbTableName() {
			return 'feature_post';
		}	
	}
?>