<?php

class RensaiCmsController extends RensaiController {
	/* view file name */
	public function getViewName($pageType) {
		switch($pageType) {
			case "hub" :
				// rensai-cms.blade.php
				$output = 'rensai-cms';
				break;
			case "category" :
				// rensai-cms-category.blade.php
				$output = 'rensai-cms-category';
				break;
			case "post" :
				// rensai-cms-post.blade.php
				$output = 'rensai-cms-post';
				break;
		}

		return $output;
	}
	/* alias */
	public function getAlias() {
		return 'rensaiCms';
	}
	/* Shows public/cms/rensai-cms.blade.php */
	public function rensaiCms() {
		// Get the setting value for this page
		$this->getXmlConfig($this->getXmlNodeLabel());

		// Data fetching operations
		// get all categories
		$rensaiCategories = parent::rensaiPageRensaiCategoryDbQuery();
		// get the latest post's thumb img for each category
		$rensaiLatestThumbImgs = parent::rensaiPageGetLatestThumbImgs($rensaiCategories);
		// get the latest posts
		$rensaiPosts = parent::rensaiPageRensaiPostsDbQuery();

		$viewFile = $this->getCmsViewFolder() . $this->getViewName("hub");
		return View::make( $viewFile )->with('rensaiCategories', $rensaiCategories)
									  ->with('rensaiPosts', $rensaiPosts)
									  ->with('rensaiLatestThumbImgs', $rensaiLatestThumbImgs)
									  ->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									  ->with('newsModuleEntries',$this->getNewsModuleEntries())
									  ->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());
	}
	public function rensaiCategoryCms($categoryId) {
		// url validation
		if (RensaiCategory::find($categoryId) == null) {
			return Redirect::route($this->getAlias());
		}

		// Get the setting values for this page
		$this->getXmlConfig($this->getXmlNodeLabel());

		// Data fetching operations
		$rensaiCategory = parent::rensaiCategoryGetRecordDbQuery($categoryId);
		// find all posts that are under this category
		$rensaiPosts = parent::rensaiCategoryGetAllPosts($categoryId);

		// The Rensai page has Features, News, & Gadgets modules on its page.
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("category");
		return View::make($viewFile)->with('rensaiCategory', $rensaiCategory)
									->with('rensaiPosts', $rensaiPosts)
									->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									->with('newsModuleEntries',$this->getNewsModuleEntries())
									->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries());
	}
	public function rensaiPostCms($categoryId, $postId) {
		// url validation
		if (RensaiPost::where('category_id', '=', $categoryId)->
						where('post_id', '=', $postId)->
						first() == null) {
			return Redirect::route($this->getAlias());
		}

		// Get the setting values for this page
		$this->getXmlConfig($this->getXmlNodeLabel());

		// Note : We won't call the function in the parent class for the query below.
		// The reason being is because in the cms panel we need the updated_at column.
		$rensaiPost = DB::table('rensai_post')->
								select('rensai_post.id', 'rensai_post.category_id', 'rensai_post.post_id',
										'rensai_post.post_title', 'rensai_post.primary_img', 'rensai_category.header_img',
										'rensai_post.thumbnail_img', 'rensai_category.icon_img',
										'rensai_category.category_name', 'rensai_post.post_body', 'rensai_post.posting_date',
										'rensai_post.updated_at')->
								join('rensai_category',
									 'rensai_post.category_id', '=', 'rensai_category.id')->
								where('category_id', '=', $categoryId)->
								where('post_id', '=', $postId)->
								first();
		$postArchives = parent::rensaiPostPagePostArchivesDbQuery($categoryId);
		$prevNextLinks = parent::handlePrevNextLinks($rensaiPost);
		$leftLink = $prevNextLinks["leftLink"];
		$rightLink = $prevNextLinks["rightLink"];
		$topThumbImg = $prevNextLinks["topThumbImg"];

		// The Rensai page has features, News, & Gadgets modules on its page.
		$viewFile = $this->getCmsViewFolder() . $this->getViewName("post");
		return View::make($viewFile)->with('rensaiPost', $rensaiPost)
									->with('postArchives', $postArchives)
									->with('featureModuleEntries',$this->getFeaturesModuleEntries())
									->with('newsModuleEntries',$this->getNewsModuleEntries())
									->with('gadgetsModuleEntries',$this->getGadgetsModuleEntries())
									->with('leftLink', $leftLink)
									->with('rightLink', $rightLink)
									->with('topThumbImg', $topThumbImg);
	}
	/* Handle POST */
	public function postRensaiCms() {
		switch (Input::get("category")) {
			case "rensai-new-articles-list":
				$this->setXmlConfig("rensai", "new-articles-list", intval(Input::get("arg1")));
				Cache::forget('rensai-rensaiPosts');

				break;
			case "rensai-create-article-category":
				$this->handleCategoryCreation();
				Cache::forget('rensai-rensaiCategories');
				Cache::forget('rensai-rensaiLatestThumbImgs');
				Cache::forget('rensai-rensaiPosts');

				break;
			case "rensai-delete-article-category":
				$this->handleCategoryRemoval(intval(Input::get("arg1")));
				Cache::forget('rensai-rensaiCategories');
				Cache::forget('rensai-rensaiLatestThumbImgs');
				Cache::forget('rensai-rensaiPosts');

				break;
			case "rensai-news-module":
				$this->setXmlConfig("rensai", "news", intval(Input::get("arg1")));
				Cache::forget('module-news');

				break;
			case "rensai-features-module":
				$this->setXmlConfig("rensai", "features", intval(Input::get("arg1")));
				Cache::forget('module-features');

				break;
			case "rensai-gadgets-module":
				$this->setXmlConfig("rensai", "gadgets", intval(Input::get("arg1")));
				Cache::forget('module-gadgets');

				break;
		}
	}
	public function postRensaiCategoryCms($categoryId) {
		switch (Input::get("category")) {
			case "rensai-edit-category":
				$this->handleEditingCategory($categoryId);
				Cache::forget('rensai-category-rensaiCategory' . $categoryId);

				break;
			case "rensai-create-new-post":
				$newRecordId = $this->handleCreatingPost($categoryId);
				Cache::forget('rensai-category-rensaiCategory' . $categoryId);
				Cache::forget('rensai-category-rensaiPosts' . $categoryId);
				Cache::forget('rensai-rensaiLatestThumbImgs');
				Cache::forget('rensai-rensaiPosts');

				// Clear the cache for the previous posts of this newly created post
				// DEMO Mode (because $newRecordId will be null in demo mode)
				/*
				$rensaiPostIds = DB::table('rensai_post')->select('id')->get();
				for ($i=0; $i<count($rensaiPostIds) - 1; $i++) {
					if ($newRecordId == $rensaiPostIds[$i]->id) {
						if ($i > 0) {
							$prevPost = $rensaiPostIds[$i - 1]->id;
							if (Cache::has('rensai-post-prev-next-links' . $categoryId . "/" . $prevPost)) {
								Cache::forget('rensai-post-prev-next-links' . $categoryId . "/" . $prevPost);
							}
						}

						break;
					}
				}*/

				break;
			case "rensai-delete-a-post":
				$targetCategoryId = intval(Input::get("category-id"));
				$targetPostId = intval(Input::get("arg1"));
				$this->handleDeletingPost($targetPostId);
				Cache::forget('rensai-category-rensaiCategory' . $targetCategoryId);
				Cache::forget('rensai-category-rensaiPosts' . $targetCategoryId);
				Cache::forget('rensai-rensaiLatestThumbImgs');
				Cache::forget('rensai-rensaiPosts');

				Cache::forget('rensai-post-prev-next-links' . $targetCategoryId . "/" .$targetPostId);
				// Clear the cache for the next & previous posts of this deleted post
				$rensaiPostIds = DB::table('rensai_post')->select('id')->get();
				for ($i=0; $i<count($rensaiPostIds) - 1; $i++) {
					if ($targetPostId == $rensaiPostIds[$i]->id) {
						if ($i > 0) {
							$prevPost = $rensaiPostIds[$i - 1]->id;
							if (Cache::has('rensai-post-prev-next-links' . $targetCategoryId . "/" . $prevPost)) {
								Cache::forget('rensai-post-prev-next-links' . $targetCategoryId . "/" . $prevPost);
							}
						}
						if ($i < count($rensaiPostIds) - 1) {
							$nextPost = $rensaiPostIds[$i + 1]->id;
							if (Cache::has('rensai-post-prev-next-links' . $targetCategoryId . "/" . $nextPost)) {
								Cache::forget('rensai-post-prev-next-links' . $targetCategoryId . "/" . $nextPost);
							}
						}

						break;
					}
				}

				break;
		}
	}
	public function postRensaiPostCms($categoryId, $postId) {
		switch (Input::get("category")) {
			case "rensai-edit-a-post" :
				$this->handleEditingPost($categoryId, $postId);

				// Clear the cache
				Cache::forget('rensai_post_rensaiPost' . $categoryId . '/' . $postId);
			break;
		}
	}
	private function getFolderPath($type) {
		switch ($type) {
			case "categories":
				$path = public_path().sprintf("/images/rensai/categories");
				break;
			case "posts":
				$path = public_path().sprintf("/images/rensai/posts");
				break;
			case "postbody":
				$path = app_path().sprintf("/views/archive_rensai_posts");
				break;
		}

		return $path;
	}
	private function handleCategoryCreation() {
		$categoryTitle = Input::get("category-title");
		$categoryDesc = Input::get("category-description");
		$categoryHeaderImg = Input::file("category-header-img");
		$articleHeaderImg = Input::file("article-header-img");
		$sideIconImg = Input::file("side-icon-img");

		$postTitle = Input::get("post-title");
		$mainPostImg = Input::file("main-article-img");
		$postBody = Input::file("article-body");

		// Validate inputs
		$inputs = array('category-title' => $categoryTitle,
					    'category-description' => $categoryDesc,
					    'category-header-img' => $categoryHeaderImg,
					    'article-header-img' => $articleHeaderImg,
					    'side-icon-img' => $sideIconImg,
					    'post-title' => $postTitle,
					    'main-article-img' => $mainPostImg,
					    'article-body' => $postBody);
		$validator = Validator::make($inputs,
									 RensaiCategory::$validationRules,
									 RensaiCategory::$validationMessages);
		if ($validator->fails()) {
			// Send all of the error messages back to the cms dialog in cms.js
			echo 'error:';
			echo '<ul>';
			foreach ($validator->errors()->all() as $message) {
				echo '<li> - ' . $message . '</li>';
			}
			echo '</ul>';
		} else {
			/*
			$cateDestPath = $this->getFolderPath("categories");
			$postDestPath = $this->getFolderPath("posts");
			$postBodyDestPath = $this->getFolderPath("postbody");

			// Create an EMPTY category record inside the 'rensai_category' table to retrieve its PK
			$newRensaiCate = RensaiCategory::create(array('category_name' => '', 'group_img' => '',
														  'header_img' => '', 'icon_img' => '',
														  'group_desc' => ''
													));
			// Create an EMPTY post record inside the 'rensai_post' table to retrieve its PK
			$newRensaiPost = RensaiPost::create(array('category_id' => $newRensaiCate->id,
													  'post_id' => '',
													  'post_title' => '', 'primary_img' => '',
													  'thumbnail_img' => '', 'post_body' => '',
													  'posting-date' => ''
											   ));
			// Assign the name for each uploaded image. The name must follow the naming convention
			// Naming Convention : group-img-[id].[ext]
			$groupImgName = 'group-img-' . $newRensaiCate->id . '.' . $categoryHeaderImg->getClientOriginalExtension();
			// Naming Convention : header-img-[id].[ext]
			$headerImgName = 'header-img-' . $newRensaiCate->id . '.' . $articleHeaderImg->getClientOriginalExtension();
			// Naming Convention : icon-img-[id].[ext]
			$iconImgName = 'icon-img-' . $newRensaiCate->id . '.' . $sideIconImg->getClientOriginalExtension();
			// Naming Convention : primary-img-[cate-id]-[id].[ext]
			$primaryImgName = 'primary-img-' . $newRensaiCate->id . '-' . $newRensaiPost->id . '.' . $mainPostImg->getClientOriginalExtension();
			// Naming Convention : thumb-img-[cate-id]-[id].[ext]
			$thumbImgName = 'thumb-img-' . $newRensaiCate->id . '-' . $newRensaiPost->id . '.' . $mainPostImg->getClientOriginalExtension();
			// Naming Convention : rensai-[cate-id]-[id].html
			$postBodyName = 'rensai-'. $newRensaiCate->id . '-' . $newRensaiPost->id . '.html';

			// Insert the new category data into the $newRensaiCate by updating this record
			$tgtRensaiCate = RensaiCategory::where('id', '=', $newRensaiCate->id)->first();
			$tgtRensaiCate->category_name = $categoryTitle;
			$tgtRensaiCate->group_img = $groupImgName;
			$tgtRensaiCate->header_img = $headerImgName;
			$tgtRensaiCate->icon_img = $iconImgName;
			$tgtRensaiCate->group_desc = $categoryDesc;
			$tgtRensaiCate->save();

			// Insert the new post data into the $newRensaiPost by updating this record
			$tgtRensaiPost = RensaiPost::where('id', '=', $newRensaiPost->id)->first();
			$tgtRensaiPost->category_id = $newRensaiCate->id;
			$tgtRensaiPost->post_id = $newRensaiCate->id . '-' . $newRensaiPost->id;
			$tgtRensaiPost->post_title = $postTitle;
			$tgtRensaiPost->primary_img = $primaryImgName;
			$tgtRensaiPost->thumbnail_img = $thumbImgName;
			$tgtRensaiPost->post_body = $postBodyName;
			$tgtRensaiPost->posting_date = date("Y-m-d H:i:s");	// MySQL datetime friendly format
			$tgtRensaiPost->save();

			// Move the $categoryHeaderImg to the /public/rensai/categories/ folder
			$categoryHeaderImg->move($cateDestPath, $groupImgName);
			// Move the $articleHeaderImg to the /public/rensai/categories/ folder
			$articleHeaderImg->move($cateDestPath, $headerImgName);
			// Move the $sideIconImg to the /public/rensai/categories/ folder
			$sideIconImg->move($cateDestPath, $iconImgName);
			// Move the $mainPostImg to the /public/rensai/posts/ folder
			$mainPostImg->move($postDestPath, $primaryImgName);
			// Clone the $mainPostImage in the /public/rensai/posts/ folder
			$originalImgPath = $postDestPath . '/' . $primaryImgName;
			$clonedImgPath = $postDestPath . '/' . $thumbImgName;
			if (\File::copy($originalImgPath, $clonedImgPath)) {
				// Use the Intervention Lib to create the thumbnail version of the $mainPostImg.
				// Open the cloned image
				$thumbImg = Image::make($clonedImgPath);
				// Then, Resize it to 150 x 150 pixels
				$thumbImg->resize(150, 150);
				// Finally, Save it
				$thumbImg->save($clonedImgPath);
			}
			// Move the $postBody file to the /app/views/archive_rensai_posts/ folder
			$postBody->move($postBodyDestPath, $postBodyName);

			echo 'ok';
			*/
			// DEMO Mode
			echo 'demo';
		}
	}
	private function handleCategoryRemoval($id) {
		$rensaiCategory = RensaiCategory::where('id', '=', $id)->first();
		if ($rensaiCategory != null) {
			$cateDestPath = $this->getFolderPath("categories");
			$postDestPath = $this->getFolderPath("posts");
			$postBodyDestPath = $this->getFolderPath("postbody");

			// Delete all post materials related to all post record under this category record
			$rensaiPosts = RensaiPost::where("category_id", "=", $id)->get();
			if ($rensaiPosts != null) {
				/*
				foreach ($rensaiPosts as $rensaiPost) {
					\File::delete($postDestPath . '/' . $rensaiPost->primary_img);
					\File::delete($postDestPath . '/' . $rensaiPost->thumbnail_img);

					\File::delete($postBodyDestPath . '/' . $rensaiPost->post_body);
				}

				// Then, Delete all materials related to this category record
				\File::delete($cateDestPath . '/' . $rensaiCategory->group_img);
				\File::delete($cateDestPath . '/' . $rensaiCategory->header_img);
				\File::delete($cateDestPath . '/' . $rensaiCategory->icon_img);

				// delete the record from the database
				RensaiCategory::destroy($id);

				echo 'ok';
				*/
				echo 'demo';
			} else {
				// Throw an exception here...
				echo 'error';
			}
		} else {
			// Throw an exception here...
			echo 'error';
		}
	}
	private function handleCreatingPost($categoryId) {
		// url validation
		if (RensaiCategory::find($categoryId) == null) {
			return Redirect::route($this->getAlias());
		}

		$postTitle = Input::get("post-title");
		$mainPostImg = Input::file("main-article-img");
		$postBody = Input::file("article-body");

		// Validate inputs
		$inputs = array('post-title' => $postTitle,
					    'main-article-img' => $mainPostImg,
					    'article-body' => $postBody);
		$validator = Validator::make($inputs,
									 RensaiPost::$validationRules,
									 RensaiPost::$validationMessages);
		if ($validator->fails()) {
			// Send all of the error messages back to the cms dialog in cms.js
			echo 'Error:';
			echo '<ul>';
			foreach ($validator->errors()->all() as $message) {
				echo '<li> - ' . $message . '</li>';
			}
			echo '</ul>';
		} else {
			/*
			$postDestPath = $this->getFolderPath("posts");
			$postBodyDestPath = $this->getFolderPath("postbody");

			// Create an EMPTY post record inside the 'rensai_post' table to retrieve its PK
			$newRensaiPost = RensaiPost::create(array('category_id' => $categoryId,
													  'post_id' => '',
													  'post_title' => '', 'primary_img' => '',
													  'thumbnail_img' => '', 'post_body' => '',
													  'posting-date' => ''
											   ));

			// Naming Convention : primary-img-[cate-id]-[id].[ext]
			$primaryImgName = 'primary-img-' . $categoryId . '-' . $newRensaiPost->id . '.' . $mainPostImg->getClientOriginalExtension();
			// Naming Convention : thumb-img-[cate-id]-[id].[ext]
			$thumbImgName = 'thumb-img-' . $categoryId . '-' . $newRensaiPost->id . '.' . $mainPostImg->getClientOriginalExtension();
			// Naming Convention : rensai-[cate-id]-[id].html
			$postBodyName = 'rensai-'. $categoryId . '-' . $newRensaiPost->id . '.html';

			// Insert the new post data into the $newRensaiPost by updating this record
			$tgtRensaiPost = RensaiPost::where('id', '=', $newRensaiPost->id)->first();
			$tgtRensaiPost->category_id = $categoryId;
			$tgtRensaiPost->post_id = $categoryId . '-' . $newRensaiPost->id;
			$tgtRensaiPost->post_title = $postTitle;
			$tgtRensaiPost->primary_img = $primaryImgName;
			$tgtRensaiPost->thumbnail_img = $thumbImgName;
			$tgtRensaiPost->post_body = $postBodyName;
			$tgtRensaiPost->posting_date = date("Y-m-d H:i:s");	// MySQL datetime friendly format
			$tgtRensaiPost->save();

			// Move the $mainPostImg to the /public/rensai/posts/ folder
			$mainPostImg->move($postDestPath, $primaryImgName);
			// Clone the $mainPostImage in the /public/rensai/posts/ folder
			$originalImgPath = $postDestPath . '/' . $primaryImgName;
			$clonedImgPath = $postDestPath . '/' . $thumbImgName;
			if (\File::copy($originalImgPath, $clonedImgPath)) {
				// Use the Intervention Lib to create the thumbnail version of the $mainPostImg.
				// Open the cloned image
				$thumbImg = Image::make($clonedImgPath);
				// Then, Resize it to 150 x 150 pixels
				$thumbImg->resize(150, 150);
				// Finally, Save it
				$thumbImg->save($clonedImgPath);
			}
			// Move the $postBody file to the /app/views/archive_rensai_posts/ folder
			$postBody->move($postBodyDestPath, $postBodyName);

			echo 'ok';

			return $newRensaiPost->id;
			*/

			// DEMO Mode
			echo 'demo';

			return null;
		}
	}
	private function handleDeletingPost($id) {
		$rensaiPost = RensaiPost::where('id', '=', $id)->first();
		if ($rensaiPost != null) {
			// Get the number of posts under the category of this post
			$totalPosts = RensaiPost::where('category_id', '=', $rensaiPost->category_id)->get();
			if (count($totalPosts) <= 1) {
				// Warning! A category must contain at least a single post. Therefore, This
				// post cannot be deleted. If you want to delete this post, then delete the
				// category of this post from the rensai hub cms page.
				echo '<p style="text-align:center;">Warning!</p>';
				echo '<p style="text-align:center;">A Category must contain at least a single post.</p>';
				echo '<p style="text-align:center;">Delete the category from the <b>[rensai hub cms page]</b> to delete this post.</p>';
				echo '<br>';
			} else {
				/*
				$postDestPath = $this->getFolderPath("posts");
				$postBodyDestPath = $this->getFolderPath("postbody");

				// Delete all materials related to this post
				\File::delete($postDestPath . DIRECTORY_SEPARATOR . $rensaiPost->primary_img);
				\File::delete($postDestPath . DIRECTORY_SEPARATOR . $rensaiPost->thumbnail_img);

				\File::delete($postBodyDestPath . DIRECTORY_SEPARATOR . $rensaiPost->post_body);

				// Then, delete the record from the database
				RensaiPost::destroy($id);

				echo 'ok';
				*/

				// DEMO mode
				echo 'demo';
			}
		} else {
			// throw an exception here...
			echo 'error';
		}
	}
	private function handleEditingPost($categoryId, $postId) {
		$primaryKey = Input::get("primary-id");
		$tgtRensaiPost = RensaiPost::where('category_id', '=', $categoryId)->
								  	 where('post_id', '=', $postId)->
								  	 where('id', '=', $primaryKey)->
								  	 first();
		if ($tgtRensaiPost != null) {
			$updatedPostTitle = Input::get("post-title");
			$newMainArticleImg = Input::file("main-article-img");
			$newArticleBody = Input::file("article-body");

			// Validate inputs
			$inputs = array('post-title' => $updatedPostTitle,
							'main-article-img' => $newMainArticleImg,
							'article-body' => $newArticleBody);
			$validator = Validator::make($inputs,
										 RensaiPost::$validationRules,
										 RensaiPost::$validationMessages);

			if ($validator->fails()) {
				// Send all of the error messages back to the cms dialog in cms.js
				echo 'error:';
				echo '<ul>';
				foreach ($validator->errors()->all() as $message) {
					echo '<li> - ' . $message . '</li>';
				}
				echo '</ul>';
			} else {
				/*
				// Update the record
				$tgtRensaiPost->post_title = $updatedPostTitle;
				$tgtRensaiPost->save();
				// Note: Since the uploaded image names are standardised, updating the filename for each
				// image is unnecessary

				$postDestPath = $this->getFolderPath("posts");
				$postBodyDestPath = $this->getFolderPath("postbody");

				// Naming Convention : primary-img-[cate-id]-[id].[ext]
				$primaryImgName = 'primary-img-' . $categoryId . '-' .$tgtRensaiPost->id . '.' . $newMainArticleImg->getClientOriginalExtension();
				// Naming Convention : thumb-img-[cate-id]-[id].[ext]
				$thumbImgName = 'thumb-img-' . $categoryId . '-' . $tgtRensaiPost->id . '.' . $newMainArticleImg->getClientOriginalExtension();
				// Naming Convention : rensai-[cate-id]-[id].html
				$postBodyName = 'rensai-'. $categoryId . '-' . $tgtRensaiPost->id . '.html';

				// Move the $newMainArticleImg to the /public/rensai/posts/ folder
				$newMainArticleImg->move($postDestPath, $primaryImgName);
				// Clone the $mainPostImage in the /public/rensai/posts/ folder
				$originalImgPath = $postDestPath . DIRECTORY_SEPARATOR . $primaryImgName;
				$clonedImgPath = $postDestPath . DIRECTORY_SEPARATOR . $thumbImgName;
				if (\File::copy($originalImgPath, $clonedImgPath)) {
					// Use the Intervention Lib to create the thumbnail version of the $mainPostImg.
					// Open the cloned image
					$thumbImg = Image::make($clonedImgPath);
					// Then, Resize it to 150 x 150 pixels
					$thumbImg->resize(150, 150);
					// Finally, Save it
					$thumbImg->save($clonedImgPath);
				}
				// Move the $postBody file to the /app/views/archive_rensai_posts/ folder
				$newArticleBody->move($postBodyDestPath, $postBodyName);

				echo 'ok';
				*/

				// DEMO mode
				echo 'demo';
			}
		} else {
			// throw an exception here...
		}
	}
	private function handleEditingCategory($categoryId) {
		// url validation
		if (RensaiCategory::find($categoryId) == null) {
			return Redirect::route($this->getAlias());
		}

		$categoryTitle = Input::get("category-title");
		$categoryDesc = Input::get("category-description");
		$categoryHeaderImg = Input::file("category-header-img");
		$articleHeaderImg = Input::file("article-header-img");
		$sideIconImg = Input::file("side-icon-img");

		// Validate inputs
		$inputs = array('category-title' => $categoryTitle,
					    'category-description' => $categoryDesc,
					    'category-header-img' => $categoryHeaderImg,
					    'article-header-img' => $articleHeaderImg,
					    'side-icon-img' => $sideIconImg);
		$validator = Validator::make($inputs,
									 RensaiCategory::$categoryEditingValidationRules,
									 RensaiCategory::$categoryEditingValidationMessages);
		if ($validator->fails()) {
			// Send all of the error messages back to the cms dialog in cms.js
			echo 'Error:';
			echo '<ul>';
			foreach ($validator->errors()->all() as $message) {
				echo '<li> - ' . $message . '</li>';
			}
			echo '</ul>';
		} else {
			/*
			$cateDestPath = $this->getFolderPath("categories");

			// Update this record
			$tgtRensaiCate = RensaiCategory::where('id', '=', $categoryId)->first();
			$tgtRensaiCate->category_name = $categoryTitle;
			$tgtRensaiCate->group_desc = $categoryDesc;
			$tgtRensaiCate->save();

			// Assign the name for each uploaded image. The name must follow the naming convention
			// Naming Convention : group-img-[id].[ext]
			$groupImgName = 'group-img-' . $categoryId . '.' . $categoryHeaderImg->getClientOriginalExtension();
			// Naming Convention : header-img-[id].[ext]
			$headerImgName = 'header-img-' . $categoryId . '.' . $articleHeaderImg->getClientOriginalExtension();
			// Naming Convention : icon-img-[id].[ext]
			$iconImgName = 'icon-img-' . $categoryId . '.' . $sideIconImg->getClientOriginalExtension();

			// Move the $categoryHeaderImg to the /public/rensai/categories/ folder
			$categoryHeaderImg->move($cateDestPath, $groupImgName);
			// Move the $articleHeaderImg to the /public/rensai/categories/ folder
			$articleHeaderImg->move($cateDestPath, $headerImgName);
			// Move the $sideIconImg to the /public/rensai/categories/ folder
			$sideIconImg->move($cateDestPath, $iconImgName);

			echo 'ok';
			*/
			// DEMO mode
			echo 'demo';
		}
	}
}
