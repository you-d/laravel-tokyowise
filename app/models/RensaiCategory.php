<?php
	/* app/models/RensaiCategory.php */
	class RensaiCategory extends Eloquent {
		// DB TABLE NAME
		public $table = 'rensai_category';
		// PRIMARY KEY LABEL
		public $primaryKey = 'id';
		// ENABLE TIMESTAMPS?
		public $timestamps = true;
		
		// MASS ASSIGNMENT
		protected $fillable = array('category_name', 'group_img', 'header_img', 'icon_img',
									'group_desc');
									
		// DEFINE RELATIONSHIPS
		// a rensai category can have many rensai posts 
		public function rensaiPosts() {
			return $this->hasMany('RensaiPost');
		}	
		
		public static function getDbTableName() {
			return 'rensai_category';
		}
		
		// INPUT VALIDATION RULES
		public static $validationRules = array(
			"category-title" => 'required | string',
			"category-description" => 'required | string',
			"category-header-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								 	  max: 3072', 
			"article-header-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								   	 max: 3072',
			"side-icon-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								max: 2048',					   	 
			"post-title" => 'required | string',	
			"main-article-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								   max: 3072 | custom_is_rectangular_img',	
			"article-body" => 'required | custom_valid_file_ext:html',					   			   	  
		);
		public static $categoryEditingValidationRules = array(
			"category-title" => 'required | string',
			"category-description" => 'required | string',
			"category-header-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								 	  max: 3072', 
			"article-header-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								   	 max: 3072',
			"side-icon-img" => 'required | image | mimes:jpeg,JPEG,jpg,JPG,png,PNG | 
								max: 2048',				
		);
		// INPUT VALIDATION ERROR MESSAGES		
		public static $validationMessages = array(
			'category-title.required' => '<b>[Category Title]</b> This field is required.',
			'category-title.string' => '<b>[Category Title]</b> The input of this field must be of a string format.',
			'category-description.required' => '<b>[Category Description]</b> This field is required.',
			'category-description.string' => '<b>[Category Description]</b> The input of this field must be of a string format.',
			'post-title.required' => '<b>[Post Title]</b> This field is required.',
			'post-title.string' => '<b>[Post Title]</b> The input of this field must be of a string format.',
			'article-body.required' => '<b>[Article Body]</b> This field is required.',
			'article-body.custom_valid_file_ext' => '<b>[Article Body]</b> Accepted File format : html.',
			'category-header-img.required' => '<b>[Header Image]</b> This field is required.',
			'category-header-img.image' => '<b>[Header Image]</b> File format is not recognisable.',
			'category-header-img.mimes' => '<b>[Header Image]</b> Accepted image extension : png, jpg, jpeg.',
			'category-header-img.max' => '<b>[Header Image]</b> Maximum image size must not exceed 3Mb',
			'article-header-img.required' => '<b>[Article Header Image]</b> This field is required.',
			'article-header-img.image' => '<b>[Article Header Image]</b> File format is not recognisable.',
			'article-header-img.mimes' => '<b>[Article Header Image]</b> Accepted image extension : png, jpg, jpeg.',
			'article-header-img.max' => '<b>[Article Header Image]</b> Maximum image size must not exceed 3Mb',
			'side-icon-img.required' => '<b>[Side Icon Image]</b> This field is required.',
			'side-icon-img.image' => '<b>[Side Icon Image]</b> File format is not recognisable.',
			'side-icon-img.mimes' => '<b>[Side Icon Image]</b> Accepted image extension : png, jpg, jpeg.',
			'side-icon-img.max' => '<b>[Side Icon Image]</b> Maximum image size must not exceed 3Mb',	
			'main-article-img.required' => '<b>[Main Article Image]</b> This field is required.',
			'main-article-img.image' => '<b>[Main Article Image]</b> File format is not recognisable.',
			'main-article-img.mimes' => '<b>[Main Article Image]</b> Accepted image extension : png, jpg, jpeg.',
			'main-article-img.max' => '<b>[Main Article Image]</b> Maximum image size must not exceed 3Mb',
			'main-article-img.custom_is_rectangular_img' => '<b>[Main Article Image]</b> The image shape must be rectangular.'
		);	
		public static $categoryEditingValidationMessages = array(
			'category-title.required' => '<b>[Category Title]</b> This field is required.',
			'category-title.string' => '<b>[Category Title]</b> The input of this field must be of a string format.',
			'category-description.required' => '<b>[Category Description]</b> This field is required.',
			'category-description.string' => '<b>[Category Description]</b> The input of this field must be of a string format.',
			'category-header-img.required' => '<b>[Header Image]</b> This field is required.',
			'category-header-img.image' => '<b>[Header Image]</b> File format is not recognisable.',
			'category-header-img.mimes' => '<b>[Header Image]</b> Accepted image extension : png, jpg, jpeg.',
			'category-header-img.max' => '<b>[Header Image]</b> Maximum image size must not exceed 3Mb',
			'article-header-img.required' => '<b>[Article Header Image]</b> This field is required.',
			'article-header-img.image' => '<b>[Article Header Image]</b> File format is not recognisable.',
			'article-header-img.mimes' => '<b>[Article Header Image]</b> Accepted image extension : png, jpg, jpeg.',
			'article-header-img.max' => '<b>[Article Header Image]</b> Maximum image size must not exceed 3Mb',
			'side-icon-img.required' => '<b>[Side Icon Image]</b> This field is required.',
			'side-icon-img.image' => '<b>[Side Icon Image]</b> File format is not recognisable.',
			'side-icon-img.mimes' => '<b>[Side Icon Image]</b> Accepted image extension : png, jpg, jpeg.',
			'side-icon-img.max' => '<b>[Side Icon Image]</b> Maximum image size must not exceed 3Mb',	
		);						
	}
?>