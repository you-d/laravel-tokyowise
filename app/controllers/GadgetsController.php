<?php

class GadgetsController extends BaseController {
	/* view file name */
	public function getViewName($pageType) {
		switch ($pageType) {
			case "hub" :
				// gadgets.blade.php
				$output = 'gadgets';
				break;
			case "post" :
				// gadgets-post.blade.php
				$output = 'gadgets-post';
				break;
		}
		
		return $output;			
	}
	/* alias */
	public function getAlias() {
		return 'gadgets';
	}
	/* xml node label */
	public function getXmlNodeLabel() {
		// <tokyowise><gadgets></gadgets></tokyowise>
		return 'gadgets';
	}
	/* Shows gadgets.blade.php */
	public function gadgets() {
		// Get the setting values for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());	
	
		// Data fetching operations
		if (Cache::has('gadgets-gadgetPosts')) {
			$gadgetPosts = Cache::get('gadgets-gadgetPosts');
		} else {
			$gadgetPosts = $this->gadgetsPageGadgetsPostDbQuery();
			Cache::add('gadgets-gadgetPosts', $gadgetPosts, $this->cacheTimeLimit);
		}
			
		// The Gadgets page has Features, Rensai, & News modules on its page. 	
		return View::make( $this->getViewName("hub") )->with('gadgetPosts',$gadgetPosts)
												 	  ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
												 	  ->with('newsModuleEntries',$this->getNewsModuleEntries())
												 	  ->with('rensaiModuleEntries',$this->getRensaiModuleEntries());
	}
	/* Shows gadgets-post.blade.php */
	public function gadgetPost($pageId) {
		// Get the id from the $pageId by removing the first 2 chars from the param - 
		// which are supposed to be 'n' & 'o' for 'no'
		$postId = substr($pageId, 2);
		
		// url validation
		if (GadgetsPost::where('id', '=', $postId)->count() == 0) {
			return Redirect::route($this->getAlias());
		}
		
		// Get the setting values for this page		
		$this->getXmlConfig($this->getXmlNodeLabel());	
		
		// Data fetching operations
		if (Cache::has('gadgets-post-gadgetPost' . $postId)) {
			$gadgetPost = Cache::get('gadgets-post-gadgetPost' . $postId);
		} else {
			$gadgetPost = GadgetsPost::find($postId);
			Cache::add('gadgets-post-gadgetPost' . $postId, $gadgetPost, $this->cacheTimeLimit);
		}
		
		// Determine the content of Post Prev & Next Links	
		if (Cache::has('gadgets-post-prev-next-links' . $postId)) {
			$leftLink = Cache::get('gadgets-post-prev-next-links' . $postId)["leftLink"];
			$rightLink = Cache::get('gadgets-post-prev-next-links' . $postId)["rightLink"];
			$topThumbImg = Cache::get('gadgets-post-prev-next-links' . $postId)["topThumbImg"];	
		} else {
			$prevNextLinks = $this->handlePrevNextLinks($gadgetPost);
			$leftLink = $prevNextLinks["leftLink"];
			$rightLink = $prevNextLinks["rightLink"];
			$topThumbImg = $prevNextLinks["topThumbImg"];
			Cache::add('gadgets-post-prev-next-links' . $postId, $prevNextLinks, $this->cacheTimeLimit);
		}
				
		// The Gadgets page has Features, Rensai, & News modules on its page. 	
		return View::make($this->getViewName("post"))->with('gadgetPost',$gadgetPost)
										 			 ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
										 			 ->with('newsModuleEntries',$this->getNewsModuleEntries())
										 			 ->with('rensaiModuleEntries',$this->getRensaiModuleEntries())
										 			 ->with('leftLink', $leftLink)
									  	 			 ->with('rightLink', $rightLink)
									  	 			 ->with('topThumbImg', $topThumbImg);	
	}
	/* Redirect back to gadgets.blade.php */
	public function redirectBack() {
		return Redirect::route($this->getAlias());
	}
	/* A helper function for the gadgets() & gadgetsCms() function */
	protected function gadgetsPageGadgetsPostDbQuery() {
		$gadgetPost = GadgetsPost::orderBy('id', 'desc')->get();
		return $gadgetPost;
	}
	/* Handle the Prev & Next Links of the gadgets-post.blade.php */
	private function handlePrevNextLinks($gadgetPost) {
		$prevNextLinks = array(3);
		$gadgetPostIds = DB::table(GadgetsPost::getDbTableName())->select('id', 'thumbnail_img')->get();									   
		if ($gadgetPost->id == $gadgetPostIds[0]->id) {
			// This record is the oldest record in the table
			// The left col will be the link to the newer article
			$leftLink =  DB::table(GadgetsPost::getDbTableName())->select('id', 'post_title', 'thumbnail_img')
												  ->where('id', '=', $gadgetPostIds[1]->id)
												  ->first();									  						  
			// The right col will be the link to back to the parent page
			$rightLink = null;	
			$topThumbImg = $gadgetPostIds[count($gadgetPostIds) - 1]->thumbnail_img;
		} else if ($gadgetPost->id == $gadgetPostIds[count($gadgetPostIds) - 1]->id) {
			// This record is the newest record in the table
			// The left col will be the link to back to the parent page
			$leftLink = null;
			// The right col will be the link to the older article
			$rightLink =  DB::table(GadgetsPost::getDbTableName())->select('id', 'post_title', 'thumbnail_img')
												   ->where('id', '=', $gadgetPostIds[count($gadgetPostIds) - 2]->id)
												   ->first();
			$topThumbImg = $gadgetPostIds[count($gadgetPostIds) - 1]->thumbnail_img;								   									  
		} else {
			// This record is neither the oldest nor the newest record in the table
			// Get the key of this $gadgetPost['id']
			$thisPostKey = -1;
			for ($i=0; $i<count($gadgetPostIds) - 1; $i++) {
				if ($gadgetPost->id == $gadgetPostIds[$i]->id) {
					$thisPostKey = $i;
					break;
				}
			}
			// The left col will be the link to the newer article
			$leftLink =  DB::table(GadgetsPost::getDbTableName())->select('id', 'post_title', 'thumbnail_img')
												  ->where('id', '=', $gadgetPostIds[$thisPostKey + 1]->id)
												  ->first();	
			// The right col will be the link to the order article
			$rightLink =  DB::table(GadgetsPost::getDbTableName())->select('id', 'post_title', 'thumbnail_img')
												   ->where('id', '=', $gadgetPostIds[$thisPostKey - 1]->id)
												   ->first();
			$topThumbImg = null;									   			
		}
		$prevNextLinks["leftLink"] = $leftLink;	
		$prevNextLinks["rightLink"] = $rightLink;
		$prevNextLinks["topThumbImg"] = $topThumbImg;
		
		return $prevNextLinks;
	}
}