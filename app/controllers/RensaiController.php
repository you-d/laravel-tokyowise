<?php

class RensaiController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch($pageType) {
			case "hub" :
				// rensai.blade.php
				$output = 'rensai';
				break;
			case "category" :
				// rensai-category.blade.php 
				$output = 'rensai-category';
				break;
			case "post" :
				// rensai-post.blade.php
				$output = 'rensai-post';
				break;		
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'rensai';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><rensai></rensai></tokyowise>
		return 'rensai';
	}
	/* Shows rensai.blade.php */
	public function rensai() {
		// Get the setting value for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());	
	
		// Data fetching operations
		if (Cache::has('rensai-rensaiCategories')) {
			$rensaiCategories = Cache::get('rensai-rensaiCategories');
		} else {
			// get all categories
			$rensaiCategories = $this->rensaiPageRensaiCategoryDbQuery();
			Cache::add('rensai-rensaiCategories', $rensaiCategories, $this->cacheTimeLimit);
		}
		if (Cache::has('rensai-rensaiLatestThumbImgs')) {
			$rensaiLatestThumbImgs = Cache::get('rensai-rensaiLatestThumbImgs');
		} else {
			// get the latest post's thumb img for each category
			$rensaiLatestThumbImgs = $this->rensaiPageGetLatestThumbImgs($rensaiCategories);
			Cache::add('rensai-rensaiLatestThumbImgs', $rensaiLatestThumbImgs, $this->cacheTimeLimit);	
		}
		if (Cache::has('rensai-rensaiPosts')) {
			$rensaiPosts = Cache::get('rensai-rensaiPosts');
		} else {
			// get the latest posts
			$rensaiPosts = $this->rensaiPageRensaiPostsDbQuery();
			Cache::add('rensai-rensaiPosts', $rensaiPosts, $this->cacheTimeLimit);							   
		}
		
		// The Rensai page has Features, News, & Gadgets modules on its page. 
		return View::make( $this->getViewName("hub") )->with('rensaiCategories', $rensaiCategories)
												 	  ->with('rensaiPosts', $rensaiPosts)
												 	  ->with('rensaiLatestThumbImgs', $rensaiLatestThumbImgs)
												 	  ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
												 	  ->with('newsModuleEntries',$this->getNewsModuleEntries())
												 	  ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());
	}
	/* Shows rensai-category.blade.php */
	public function rensaiCategory($categoryId) {		
		// url validation
		if (RensaiCategory::find($categoryId) == null) {
			return Redirect::route($this->getAlias());
		}
		
		// Get the setting values for this page								   
		$this->getXmlConfig($this->getXmlNodeLabel());	
		
		// Data fetching operations
		if (Cache::has('rensai-category-rensaiCategory' . $categoryId)) {
			$rensaiCategory = Cache::get('rensai-category-rensaiCategory' . $categoryId);
		} else {
			$rensaiCategory = $this->rensaiCategoryGetRecordDbQuery($categoryId);
			Cache::add('rensai-category-rensaiCategory' . $categoryId, $rensaiCategory, $this->cacheTimeLimit);		
		}
		if (Cache::has('rensai-category-rensaiPosts' . $categoryId)) {
			$rensaiPosts = Cache::get('rensai-category-rensaiPosts' . $categoryId);		
		} else {
			// find all posts that are under this category
			$rensaiPosts = $this->rensaiCategoryGetAllPosts($categoryId);
			Cache::add('rensai-category-rensaiPosts' . $categoryId, $rensaiPosts, $this->cacheTimeLimit);							   
		}					    	
		
		// The Rensai page has Features, News, & Gadgets modules on its page. 
		return View::make($this->getViewName("category"))->with('rensaiCategory', $rensaiCategory)
														 ->with('rensaiPosts', $rensaiPosts)
														 ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
														 ->with('newsModuleEntries',$this->getNewsModuleEntries())
														 ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());						    		
	}
	/* Shows rensai-posts.blade.php */
	public function rensaiPost($categoryId, $postId) {
		// url validation
		if (RensaiPost::where('category_id', '=', $categoryId)->
						where('post_id', '=', $postId)->
						first() == null) {
			return Redirect::route($this->getAlias());					
		}
		
		// Get the setting values for this page										
		$this->getXmlConfig($this->getXmlNodeLabel());	

		// Data fetching operations
		if (Cache::has('rensai-post-rensaiPost' . $categoryId . DIRECTORY_SEPARATOR . $postId)) {
			$rensaiPost = Cache::get('rensai-post-rensaiPost' . $categoryId . DIRECTORY_SEPARATOR . $postId);
		} else {
			$rensaiPost = DB::table('rensai_post')->
								select('rensai_post.id', 'rensai_post.category_id', 'rensai_post.post_id',
										'rensai_post.post_title', 'rensai_post.primary_img', 'rensai_category.header_img',
										'rensai_post.thumbnail_img', 'rensai_category.icon_img',
										'rensai_category.category_name', 'rensai_post.post_body', 'rensai_post.posting_date')->
								join('rensai_category', 
									 'rensai_post.category_id', '=', 'rensai_category.id')->
								where('category_id', '=', $categoryId)->
								where('post_id', '=', $postId)->
								first(); 
					
			Cache::add('rensai-post-rensaiPost' . $categoryId . DIRECTORY_SEPARATOR . $postId, $rensaiPost, $this->cacheTimeLimit);										
		}	
		if (Cache::has('rensai-post-postArchives' . $categoryId . DIRECTORY_SEPARATOR . $postId)) {
			$postArchives = Cache::get('rensai-post-postArchives' . $categoryId . DIRECTORY_SEPARATOR . $postId);
		} else {				
			// We also need to get all rows with a specific category_id to populate the post archive column 
			$postArchives = $this->rensaiPostPagePostArchivesDbQuery($categoryId);									
			Cache::add('rensai-post-postArchives' . $categoryId . DIRECTORY_SEPARATOR . $postId, $postArchives, $this->cacheTimeLimit);												
		}
				
		// Determine the content of Post Prev & Next Links	
		if (Cache::has('rensai-post-prev-next-links' . $categoryId . DIRECTORY_SEPARATOR . $postId)) {
			$leftLink = Cache::get('rensai-post-prev-next-links' . $categoryId . DIRECTORY_SEPARATOR . $postId)["leftLink"];
			$rightLink = Cache::get('rensai-post-prev-next-links' . $categoryId . DIRECTORY_SEPARATOR . $postId)["rightLink"];
			$topThumbImg = Cache::get('rensai-post-prev-next-links' . $categoryId . DIRECTORY_SEPARATOR . $postId)["topThumbImg"];	
		} else {
			$prevNextLinks = $this->handlePrevNextLinks($rensaiPost);
			$leftLink = $prevNextLinks["leftLink"];
			$rightLink = $prevNextLinks["rightLink"];
			$topThumbImg = $prevNextLinks["topThumbImg"];
			Cache::add('rensai-post-prev-next-links' . $categoryId . DIRECTORY_SEPARATOR . $postId, $prevNextLinks, $this->cacheTimeLimit);
		}
			
		// The Rensai page has features, News, & Gadgets modules on its page. 																						 
		return View::make($this->getViewName("post"))->with('rensaiPost', $rensaiPost)
													 ->with('postArchives', $postArchives)
													 ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
													 ->with('newsModuleEntries',$this->getNewsModuleEntries())
													 ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries())
													 ->with('leftLink', $leftLink)
													 ->with('rightLink', $rightLink)
													 ->with('topThumbImg', $topThumbImg);
	}
	/* Redirect back to rensai.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* A Helper function for both the rensai() & rensaiCms() function */
	protected function rensaiPageRensaiCategoryDbQuery() {
		$rensaiCategories = RensaiCategory::orderBy('id','desc')->get();
		return $rensaiCategories;
	}
	/* A Helper function for both the rensai() & rensaiCms() function */
	protected function rensaiPageGetLatestThumbImgs($rensaiCategories) {
		$rensaiLatestThumbImgs = array ($rensaiCategories->count());
		$counter = 0;
		foreach ($rensaiCategories as $rensaiCategory) {
			$rensaiLatestThumbImgs [$counter] = $this->rensaiCategoryGetLatestThumbImg($rensaiCategory->id);
			$counter++;												
		}
		return $rensaiLatestThumbImgs;
	}
	/* A helper function for the rensaiPageGetLatestThumbImgs() function */
	protected function rensaiCategoryGetLatestThumbImg($category_id) {
		$rensaiLatestThumbImg = RensaiPost::where('category_id', '=', $category_id)->
											orderBy('id', 'desc')->
											lists('thumbnail_img');
		return $rensaiLatestThumbImg;
	}
	/* A Helper function for both the rensai() & rensaiCms() functions */
	protected function rensaiPageRensaiPostsDbQuery() {
		$rensaiPosts = RensaiPost::orderBy('posting_date','desc')->
										   orderBy('id', 'desc')->
										   take($this->xmlOutputArray["totLatestPosts"])->
										   get();
		return $rensaiPosts;
	}
	/* A Helper function for both the rensai() & rensaiCms() functions */
	protected function rensaiPostPagePostArchivesDbQuery($categoryId) {
		$postArchives = DB::table('rensai_post')->select('post_id','posting_date', 'post_title')
														->where('category_id', $categoryId)
														->orderBy('id', 'desc')
														->get();
		return $postArchives;												
	}	
	/* A helper function for both the rensai() & rensaiCms() functions */
	protected function rensaiCategoryGetRecordDbQuery($categoryId) {
		$rensaiCategory = RensaiCategory::find($categoryId);
		return $rensaiCategory;
	}		
	/* A helper function for both the rensai() & rensaiCms() functions	*/
	protected function rensaiCategoryGetAllPosts($categoryId) {
		$rensaiPosts = RensaiPost::where('category_id', '=', $categoryId)->
								   orderBy('id', 'desc')->
								   get();
		return $rensaiPosts;					   	
	}								
	/* Handle the Prev & Next Links of the rensai-post.blade.php */
	protected function handlePrevNextLinks($rensaiPost) {
		$prevNextLinks = array(3);
		$rensaiPostIds = DB::table('rensai_post')->select('id', 'thumbnail_img')->get();									   
		if ($rensaiPost->id == $rensaiPostIds[0]->id) {
			// This record is the oldest record in the table
			// The left col will be the link to the newer article
			$leftLink =  DB::table('rensai_post')->select('post_id', 'category_id', 'post_title', 'thumbnail_img')
												  ->where('id', '=', $rensaiPostIds[1]->id)
												  ->first();									  						  
			// The right col will be the link to back to the parent page
			$rightLink = null;	
			$topThumbImg = $rensaiPostIds[count($rensaiPostIds) - 1]->thumbnail_img;
		} else if ($rensaiPost->id == $rensaiPostIds[count($rensaiPostIds) - 1]->id) {
			// This record is the newest record in the table
			// The left col will be the link to back to the parent page
			$leftLink = null;
			// The right col will be the link to the older article
			$rightLink =  DB::table('rensai_post')->select('post_id', 'category_id', 'post_title', 'thumbnail_img')
												   ->where('id', '=', $rensaiPostIds[count($rensaiPostIds) - 2]->id)
												   ->first();
			$topThumbImg = $rensaiPostIds[count($rensaiPostIds) - 1]->thumbnail_img;								   									  
		} else {
			// This record is neither the oldest nor the newest record in the table
			// Get the key of this $rensaiPost['id']
			$thisPostKey = -1;
			for ($i=0; $i<count($rensaiPostIds) - 1; $i++) {
				if ($rensaiPost->id == $rensaiPostIds[$i]->id) {
					$thisPostKey = $i;
					break;
				}
			}
			// The left col will be the link to the newer article
			$leftLink =  DB::table('rensai_post')->select('post_id', 'category_id', 'post_title', 'thumbnail_img')
												  ->where('id', '=', $rensaiPostIds[$thisPostKey + 1]->id)
												  ->first();	
			// The right col will be the link to the order article
			$rightLink =  DB::table('rensai_post')->select('post_id', 'category_id', 'post_title', 'thumbnail_img')
												   ->where('id', '=', $rensaiPostIds[$thisPostKey - 1]->id)
												   ->first();
			$topThumbImg = null;									   			
		}
		$prevNextLinks["leftLink"] = $leftLink;	
		$prevNextLinks["rightLink"] = $rightLink;
		$prevNextLinks["topThumbImg"] = $topThumbImg;
		
		return $prevNextLinks;
	}
}