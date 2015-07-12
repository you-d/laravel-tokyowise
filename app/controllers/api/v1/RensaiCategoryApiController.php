<?php
/* API Ver.1 */
class RensaiCategoryApiController extends RensaiController {
	/**
	 * Display a listing of the resource.
	 * Display all category record in the db table.
	 *
	 * @return Response
	 */
	public function index() {
			try {
					$statusCode = 200;
					$errorMsg = "";
					if (Cache::has('rensai-rensaiCategories')) {
							$rensaiCategories = Cache::get('rensai-rensaiCategories');
					} else {
							// get all categories
							$rensaiCategories = parent::rensaiPageRensaiCategoryDbQuery();
							Cache::add('rensai-rensaiCategories', $rensaiCategories,
												 $this->cacheTimeLimit);
					}
			} catch (Exception $e) {
					$statusCode = 400;
					$errorMsg = "Bad Request.";
			} finally {
					return Response::json(array('meta' => array('href' => '',
																											'statusCode' => $statusCode,
																											'contentType' => 'application/json'),
																			'error' => $errorMsg,
																			'categories' => $rensaiCategories),
																$statusCode)->
																setCallback(Input::get('callback'));
			}
	}

	/**
	 * Show the form for creating a new resource.
	 * Create a new category record. (GET)
	 *
	 * @return Response
	 */
	public function create() {

	}

	/**
	 * Store a newly created resource in storage.
	 * Create a new category record. (POST)
	 *
	 * @return Response
	 */
	public function store() {

	}

	/**
	 * Display the specified resource.
	 * Display a category record.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		try {
				$statusCode = 200;
				$errorMsg = "";
				if (Cache::has('rensai-category-rensaiCategory' . $id)) {
					$rensaiCategory = Cache::get('rensai-category-rensaiCategory' . $id);
				} else {
					$rensaiCategory = parent::rensaiCategoryGetRecordDbQuery($id);
					Cache::add('rensai-category-rensaiCategory' . $id, $rensaiCategory, $this->cacheTimeLimit);
				}
		} catch (Exception $e) {
				$statusCode = 400;
				$errorMsg = "Bad Request.";
		} finally {
				return Response::json(array('meta' => array('href' => '',
																										'statusCode' => $statusCode,
																										'contentType' => 'application/json'),
																		'error' => $errorMsg,
																		'category' => $rensaiCategory),
															$statusCode)->
															setCallback(Input::get('callback'));
		}
	}

	/**
	 * Display all post record under this category.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function showPosts($categoryId) {
		try {
				$statusCode = 200;
				$errorMsg = "";
				if (Cache::has('rensai-category-rensaiPosts' . $categoryId)) {
					$rensaiPosts = Cache::get('rensai-category-rensaiPosts' . $categoryId);
				} else {
					// find all posts that are under this category
					$rensaiPosts = parent::rensaiCategoryGetAllPosts($categoryId);
					Cache::add('rensai-category-rensaiPosts' . $categoryId, $rensaiPosts, $this->cacheTimeLimit);
				}
		} catch (Exception $e) {
				$statusCode = 400;
				$errorMsg = "Bad Request.";
		} finally {
				return Response::json(array('meta' => array('href' => '',
																										'statusCode' => $statusCode,
																										'contentType' => 'application/json'),
																		'error' => $errorMsg,
																		'posts' => $rensaiPosts),
															$statusCode)->
															setCallback(Input::get('callback'));
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {

	}
}
