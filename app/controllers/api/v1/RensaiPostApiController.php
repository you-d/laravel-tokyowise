<?php
/* API Ver.1 */
class RensaiPostApiController extends RensaiController {
	/**
	 * Display a listing of the resource.
	 * Display all post record in the db table.
	 *
	 * @return Response
	 */
	public function index() {
			try {
					$statusCode = 200;
					$errorMsg = "";
					if (Cache::has('rensai-rensaiPosts')) {
							$rensaiPosts = Cache::get('rensai-rensaiPosts');
					} else {
							// get the latest posts
							$rensaiPosts = parent::rensaiPageRensaiPostsDbQuery();
							Cache::add('rensai-rensaiPosts', $rensaiPosts, $this->cacheTimeLimit);
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
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store() {
		//
	}


	/**
	 * Display the specified resource.
	 * Display a post record.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		try {
				$statusCode = 200;
				$errorMsg = "";
				if (Cache::has('rensai-post-rensaiPost' . $id)) {
					$rensaiPost = Cache::get('rensai-post-rensaiPost' . $id);
				} else {
					$rensaiPost = parent::rensaiPostGetRecordDbQuery($id);
					Cache::add('rensai-post-rensaiPost' . $id, $rensaiPost, $this->cacheTimeLimit);
				}
		} catch (Exception $e) {
				$statusCode = 400;
				$errorMsg = "Bad Request.";
		} finally {
				return Response::json(array('meta' => array('href' => '',
																										'statusCode' => $statusCode,
																										'contentType' => 'application/json'),
																		'error' => $errorMsg,
																		'post' => $rensaiPost),
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
