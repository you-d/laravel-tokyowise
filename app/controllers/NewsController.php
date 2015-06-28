<?php

class NewsController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// news.blade.php
				$output = 'news';
				break;
			case "post" :
				// news-post.blade.php
				$output = 'news-post';
				break;		
		}
		
		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'news';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><news></news></tokyowise>
		return 'news';
	}
	/* Shows news.blade.php */
	public function news() {
		// Get the setting values for this page										
		$this->getXmlConfig($this->getXmlNodeLabel());	
		
		// Data fetching operations
		if (Cache::has('news-newsPosts')) {
			$newsPosts = Cache::get('news-newsPosts');
		} else {
			$newsPosts = $this->newsPageNewsPostDbQuery();
			Cache::add('news-newsPosts', $newsPosts, $this->cacheTimeLimit);
		}
		
		// The News page has Features, Rensai, & Gadgets modules on its page. 			
		return View::make($this->getViewName("hub"))->with('newsPosts', $newsPosts)
											   		->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									  		   		->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
									  		   		->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());	
	}
	/* Shows news-post.blade.php */
	public function newsPost($postId) {		
		// url validation
		if (NewsPost::where('id', '=', $postId)->count() == 0) {
			return Redirect::route($this->getAlias());
		}
		
		// Get the setting values for this page										
		$this->getXmlConfig($this->getXmlNodeLabel());			
		
		// Data fetching operations
		if (Cache::has('news-post-newsPost' . $postId)) {
			$newsPost = Cache::get('news-post-newsPost' . $postId);
		} else {
			$newsPost = NewsPost::where('id', '=', $postId)->first();
			Cache::add('news-newsPost' . $postId, $newsPost, $this->cacheTimeLimit);
		}
		if (Cache::has('news-post-postArchives' . $postId)) {
			$postArchives = Cache::get('news-post-postArchives' . $postId);
		} else {
			$postArchives = NewsPost::orderBy('id', 'desc')->
									  take($this->xmlOutputArray["archiveTotEntries"])->
									  get();
			Cache::add('news-post-postArchives' . $postId, $postArchives, $this->cacheTimeLimit);						  
		}
		
		// Determine the content of Post Prev & Next Links
		if (Cache::has('news-post-prev-next-links' . $postId)) {
			$leftLink = Cache::get('news-post-prev-next-links' . $postId)["leftLink"];
			$rightLink = Cache::get('news-post-prev-next-links' . $postId)["rightLink"];
			$topThumbImg = Cache::get('news-post-prev-next-links' . $postId)["topThumbImg"];	
		} else {
			$prevNextLinks = $this->handlePrevNextLinks($newsPost);
			$leftLink = $prevNextLinks["leftLink"];
			$rightLink = $prevNextLinks["rightLink"];
			$topThumbImg = $prevNextLinks["topThumbImg"];
			Cache::add('news-post-prev-next-links' . $postId, $prevNextLinks, $this->cacheTimeLimit);
		}
		
		// The News page has Features, Rensai, & Gadgets modules on its page. 										 
		return View::make($this->getViewName("post"))->with('newsPost', $newsPost)
									  				 ->with('postArchives', $postArchives)
												  	 ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
												   	 ->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
												  	 ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries())
												  	 ->with('leftLink', $leftLink)
												  	 ->with('rightLink', $rightLink)
												  	 ->with('topThumbImg', $topThumbImg);			
	}
	/* Redirect back to news.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* A Helper function for the news() & newsCms() function */
	protected function newsPageNewsPostDbQuery() {
		$newsPosts = NewsPost::orderBy('id', 'desc')->get();
		return $newsPosts;
	}
	/* Handle the Prev & Next Links of the news-post.blade.php */
	private function handlePrevNextLinks($newsPost) {
		$prevNextLinks = array(3);
		$newsPostIds = DB::table('news_post')->select('id', 'thumbnail_img')->get();									   
		if ($newsPost->id == $newsPostIds[0]->id) {
			// This record is the oldest record in the table
			// The left col will be the link to the newer article
			$leftLink =  DB::table('news_post')->select('id', 'post_title', 'thumbnail_img')
											   ->where('id', '=', $newsPostIds[1]->id)
											   ->first();									  						  
			// The right col will be the link to back to the parent page
			$rightLink = null;	
			$topThumbImg = $newsPostIds[count($newsPostIds) - 1]->thumbnail_img;
		} else if ($newsPost->id == $newsPostIds[count($newsPostIds) - 1]->id) {
			// This record is the newest record in the table
			// The left col will be the link to back to the parent page
			$leftLink = null;
			// The right col will be the link to the older article
			$rightLink =  DB::table('news_post')->select('id', 'post_title', 'thumbnail_img')
												->where('id', '=', $newsPostIds[count($newsPostIds) - 2]->id)
												->first();
			$topThumbImg = $newsPostIds[count($newsPostIds) - 1]->thumbnail_img;								   									  
		} else {
			// This record is neither the oldest nor the newest record in the table
			// Get the key of this $newsPost['id']
			$thisPostKey = -1;
			for ($i=0; $i<count($newsPostIds) - 1; $i++) {
				if ($newsPost->id == $newsPostIds[$i]->id) {
					$thisPostKey = $i;
					break;
				}
			}
			// The left col will be the link to the newer article
			$leftLink =  DB::table('news_post')->select('id', 'post_title', 'thumbnail_img')
											   ->where('id', '=', $newsPostIds[$thisPostKey + 1]->id)
											   ->first();	
			// The right col will be the link to the order article
			$rightLink =  DB::table('news_post')->select('id', 'post_title', 'thumbnail_img')
											    ->where('id', '=', $newsPostIds[$thisPostKey - 1]->id)
											    ->first();
			$topThumbImg = null;									   			
		}
		$prevNextLinks["leftLink"] = $leftLink;	
		$prevNextLinks["rightLink"] = $rightLink;
		$prevNextLinks["topThumbImg"] = $topThumbImg;
		
		return $prevNextLinks;
	}
}