<?php
	/* app/models/NewsPost.php */
	class NewsPost extends Eloquent {
		// DB TABLE NAME
		public $table = 'news_post';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('post_title', 'primary_img', 'thumbnail_img',
								    'post_body', 'posting_date');
								    
		public static function getDbTableName() {
			return 'news_post';
		}						    
	}
?>