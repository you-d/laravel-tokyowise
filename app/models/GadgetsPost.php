<?php
	/* app/models/GadgetsPost.php */
	class GadgetsPost extends Eloquent {
		// DB TABLE NAME
		public $table = 'gadgets_post';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('post_title', 'primary_img', 'thumbnail_img',  
									'primary_img_desc', 'post_body', 'posting_date');
									
		public static function getDbTableName() {
			return 'gadgets_post';
		}							
	}
?>