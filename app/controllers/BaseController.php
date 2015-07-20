<?php
// Check config/app.php to modify the web app's timezone
//date_default_timezone_set('Australia/Melbourne');

abstract class BaseController extends Controller {
	protected $xmlOutputArray = null;
	protected $cacheTimeLimit = 1440; // 24 hrs

	private $featuresModuleTotEntries = 0;
	private $newsModuleTotEntries = 0;
	private $rensaiModuleTotEntries = 0;
	private $gadgetsModuleTotEntries = 0;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/* Abstract functions */
	abstract public function getViewName($pageType);
	abstract public function getAlias();
	abstract public function getXmlNodeLabel();
	abstract public function redirectBack();

	/* Determine the name of the folder of the cms view files */
	protected function getCmsViewFolder() {
		// cms/sample-cms-page.blade.php
		return "cms" . DIRECTORY_SEPARATOR;
	}

	/* Method to strip tags globally to prevent XSS attack on the site
		 * Ref: http://usman.it/xss-filter-laravel/
		 */
	static public function globalXssClean() {
			// Recursive cleaning for array [] inputs, not just strings.
			$sanitised = self::arrayStripTags(Input::get());
    	Input::merge($sanitised);
	}

	static private function arrayStripTags($array) {
			$result = array();
			foreach ($array as $key => $value) {
					// Don't allow tags on key either, maybe useful for dynamic forms.
					//$key = strip_tags($key);
					$key = htmlentities($key);

					// If the value is an array, we will just recurse back into the
        	// function to keep stripping the tags out of the array,
        	// otherwise we will set the stripped value.
					if (is_array($value)) {
							$result[$key] = self::arrayStripTags($value);
					} else {
							//$result[$key] = trim(strip_tags($value));
							$result[$key] = trim(htmlentities($value));
					}
			}

			return $result;
	}

	/*
		Possible parameter values:
		$page -> "home"
		$column -> "headerimg" -> $val = array([wide img filename], [narrow img filename]) ,
				   "headline" -> $val = array([entry idx (0-4)], [record type (features, rensai, etc...)], [record id]),
				   "features-highlight" -> $val = (int) [total entries],
				   "news" -> $val = (int) [total entries],
				   "rensai" -> $val = (int) [total entries],
				   "gadgets" -> $val = (int) [total entries]
	*/
	protected function setXmlConfig($page, $column, $val) {
		$xmlConfigObj = new XmlConfig($page, $this->cacheTimeLimit);
		$xmlConfigObj->setThisPageConfig($column, $val);
	}

	/* Get the setting values from the xml config file */
	protected function getXmlConfig($page) {
		$xmlConfigObj = new XmlConfig($page, $this->cacheTimeLimit);
		$this->xmlOutputArray = $xmlConfigObj->getThisPageConfig();

		// get the total entries for each module
		if (array_key_exists("featuresModuleTotalEntries", $this->xmlOutputArray)) {
			$this->featuresModuleTotEntries = $this->xmlOutputArray["featuresModuleTotalEntries"];
		}
		if (array_key_exists("newsModuleTotalEntries", $this->xmlOutputArray)) {
			$this->newsModuleTotEntries = $this->xmlOutputArray["newsModuleTotalEntries"];
		}
		if (array_key_exists("rensaiModuleTotalEntries", $this->xmlOutputArray)) {
			$this->rensaiModuleTotEntries = $this->xmlOutputArray["rensaiModuleTotalEntries"];
		}
		if (array_key_exists("gadgetsModuleTotalEntries", $this->xmlOutputArray)) {
			$this->gadgetsModuleTotEntries = $this->xmlOutputArray["gadgetsModuleTotalEntries"];
		}
	}

	protected function getFeaturesModuleEntries() {
		if (Cache::has('module-features')) {
			$moduleEntries = Cache::get('module-features');
		} else {
			$moduleEntries = DB::table('feature_post')->
								select('feature_post.post_id', 'feature_post.posting_date',
									   'feature_post.post_title', 'feature_post.category_id',
									   'feature_post.thumbnail_img', 'feature_category.category_name')->
								join('feature_category', 'feature_post.category_id', '=', 'feature_category.id')->
								orderBy('feature_post.id','desc')->
								take($this->featuresModuleTotEntries)->
								get();
			Cache::add('module-features', $moduleEntries, $this->cacheTimeLimit);
		}

		return $moduleEntries;
	}

	protected function getNewsModuleEntries() {
		if (Cache::has('module-news')) {
			$moduleEntries = Cache::get('module-news');
		} else {
			$moduleEntries = DB::table('news_post')->
								select('id', 'posting_date', 'thumbnail_img', 'post_title')->
								orderBy('id', 'desc')->
								take($this->newsModuleTotEntries)->
								get();
			Cache::add('module-news', $moduleEntries, $this->cacheTimeLimit);
		}

		return $moduleEntries;
	}

	protected function getRensaiModuleEntries() {
		if (Cache::has('module-rensai')) {
			$moduleEntries = Cache::get('module-rensai');
		} else {
			$moduleEntries = DB::table('rensai_post')->
								select('rensai_post.post_id', 'rensai_post.posting_date',
									   'rensai_post.post_title', 'rensai_post.category_id',
									   'rensai_post.thumbnail_img', 'rensai_category.category_name')->
								join('rensai_category', 'rensai_post.category_id', '=', 'rensai_category.id')->
								orderBy('rensai_post.id','desc')->
								take($this->rensaiModuleTotEntries)->
								get();
			Cache::add('module-rensai', $moduleEntries, $this->cacheTimeLimit);
		}

		return $moduleEntries;
	}

	protected function getGadgetsModuleEntries() {
		if (Cache::has('module-gadgets')) {
			$moduleEntries = Cache::get('module-gadgets');
		} else {
			$moduleEntries = DB::table('gadgets_post')->
								select('id', 'post_title', 'thumbnail_img', 'posting_date')->
								orderBy('id','desc')->
								take($this->gadgetsModuleTotEntries)->
								get();
			Cache::add('module-gadgets', $moduleEntries, $this->cacheTimeLimit);
		}

		return $moduleEntries;
	}
}
