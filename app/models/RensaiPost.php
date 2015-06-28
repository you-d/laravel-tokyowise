<?php
	/* app/models/RensaiPost.php */
	class RensaiPost extends Eloquent {
		// DB TABLE NAME
		public $table = 'rensai_post';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('category_id', 'post_id', 'post_title', 'primary_img',
									'thumbnail_img', 'post_body', 'posting_date');
		
		// DEFINE RELATIONSHIPS
		// a rensai post belongs to a rensai category
		public function rensaiCategory() {
			return $this->belongsTo('RensaiCategory');
		}
		
		public static function getDbTableName() {
			return 'rensai_post';
		}
		
		// INPUT VALIDATION RULES
		public static $validationRules = array(				   	 
			"post-title" => 'required | string',	
			"main-article-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								   max: 3072 | custom_is_rectangular_img',	
			"article-body" => 'required | custom_valid_file_ext:html',					   			   	  
		);
		// INPUT VALIDATION ERROR MESSAGES		
		public static $validationMessages = array(
			'post-title.required' => '<b>[Post Title]</b> This field is required.',
			'post-title.string' => '<b>[Post Title]</b> The input of this field must be of a string format.',
			'article-body.required' => '<b>[Article Body]</b> This field is required.',
			'article-body.custom_valid_file_ext' => '<b>[Article Body]</b> Accepted File format : html.',
			'main-article-img.required' => '<b>[Main Article Image]</b> This field is required.',
			'main-article-img.image' => '<b>[Main Article Image]</b> File format is not recognisable.',
			'main-article-img.mimes' => '<b>[Main Article Image]</b> Accepted image extension : png, jpg, jpeg.',
			'main-article-img.max' => '<b>[Main Article Image]</b> Maximum image size must not exceed 3Mb',
			'main-article-img.custom_is_rectangular_img' => '<b>[Main Article Image]</b> The image shape must be rectangular.'
		);							
	}
?>