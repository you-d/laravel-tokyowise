<?php
class XmlConfig {
	private $xmlFile;
	private $page;
	private $configXml;
	// TODO : Caching the XML Parsing Output. Serialisation of SimpleXML elements is not allowed.
	private $cacheTimeLimit; 
	
	// the constructor
	function __construct($page, $cacheTimeLimit) {
		// Read tokyowise-config.xml
		$this->xmlFile = storage_path() . "/xml/tokyowise-config.xml";
		$fileContent = file_get_contents ($this->xmlFile);
			
		$this->page = $page;
		$this->cacheTimeLimit = $cacheTimeLimit;
		$this->configXml = new SimpleXmlElement ($fileContent);
	}
	
	public function getThisPageConfig() {
		$output = null;
		
		switch($this->page) {
			case "home":
				$output = $this->getHomeConfig();
				break;
			case "features":
				$output = $this->getFeaturesConfig();
				break;
			case "rensai":
				$output = $this->getRensaiConfig();
				break;	
			case "gadgets":
				$output = $this->getGadgetsConfig();
				break;
			case "news":
				$output = $this->getNewsConfig();
				break;
			case "editors":
				$output = $this->getEditorsConfig();
				break;
			default:
				$output = $this->pageNotExistAction();					
		}
		
		return $output;
	}
	
	/* 
		Possible parameter values:
		$page -> "home"
		$column -> "headerimg" -> $val = array([wide img filename], [narrow img filename]) , 
				   "headline" -> $val = array([entry idx (0-4)], [record type (features, rensai, etc...)], [record id]),  
				   "featurehighlight" -> $val =  , 
				   "news" -> $val = (int) [total entries], 
				   "rensai" -> $val = (int) [total entries], 
				   "gadgets" -> $val = (int) [total entries]   
	*/	
	public function setThisPageConfig($column, $val) {
		switch($this->page) {
			case "home":
				$this->setHomeConfig($column, $val);
				break;
			case "features":
				$this->setFeaturesConfig($column, $val);
				break;
			case "rensai":
				$this->setRensaiConfig($column, $val);
				break;	
			case "gadgets":
				$this->setGadgetsConfig($column, $val);
				break;
			case "news":
				$this->setNewsConfig($column, $val);
				break;
			case "editors":
				$this->setEditorsConfig($column, $val);
				break;
			default:
				$this->pageNotExistAction();		
		}
		// Save the change
		$this->configXml->asXML($this->xmlFile);
	}
	
	/* Get Config */
	
	private function getHomeConfig() {
		$configXml = $this->configXml;
		// <tokyowise> -> <home>
		$homeNode = $configXml->home;
		// <tokyowise> -> <headerimg>
		$headerImg = $homeNode->headerimg;
		$wideHeaderImg = $headerImg->wide;
		$narrowHeaderImg = $headerImg->narrow;
		$headerImgLastUpdate = $headerImg->lastupdate;
		// <tokyowise> -> <home> -> <headline> node
		$headline = $homeNode->headline;
		// Format -> a multidimensional array ( array (x, y) )
		// where x = <page> node & y = <id> node
		$headlineEntries = array($headline->children()->count());
		$headlineEntry = array(2); 
		$ctr = 0;
		foreach($headline->children() as $entry) {
			$headlineEntry [0] = $entry->page;
			$headlineEntry [1] = $entry->id;
			$headlineEntries[$ctr] = $headlineEntry;
			$ctr++;
		}
		// <tokyowise> -> <home> -> <featurehighlight> 
		$featureHighlight = $homeNode->featurehighlight;
		// Get the 'category_id' value of the latest feature volume
		$latestFeatureCatId = $featureHighlight->latestvol;
		// Get the total number of entries for the feature highlight column
		$totalEntries =  $featureHighlight->totalentries;
		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($homeNode);
		
		$array = array( "latestFeatureCatId" => $latestFeatureCatId,
				   		"totalEntries" => $totalEntries,
				   		"headlineEntries" => $headlineEntries,
				   		"wideHeaderImg" => $wideHeaderImg,
				   		"narrowHeaderImg" => $narrowHeaderImg,
				   		"headerImgLastUpdate" => $headerImgLastUpdate,
				   		"featuresModuleTotalEntries" => $modulesOutput["featuresEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
				   		"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
				 ); 	 	
	
		return $array;
	}
		
	private function getFeaturesConfig() {
		$configXml = $this->configXml;
		// <tokyowise> -> <features>
		$featuresNode = $configXml->features;

		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($featuresNode);
		
		$array = array( "featuresModuleTotalEntries" => $modulesOutput["featuresEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
				   		"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
					  ); 		
		
		return $array;
	}
	
	private function getRensaiConfig() {
		$configXml = $this->configXml;
		// <tokyowise> -> <rensai>
		$rensaiNode = $configXml->rensai;
		// <tokyowise> -> <rensai> -> <latestposts>
		$totLatestPosts = $rensaiNode->latestposts;

		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($rensaiNode);
		
		$array = array( "totLatestPosts" => $totLatestPosts,
						"featuresModuleTotalEntries" => $modulesOutput["featuresEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
				   		"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
					  ); 	 	
	
		return $array;
	}
	
	private function getGadgetsConfig() {
		$configXml = $this->configXml;
		// <tokyowise> -> <gadgets>
		$gadgetsNode = $configXml->gadgets;

		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($gadgetsNode);
		
		$array = array( "featuresModuleTotalEntries" => $modulesOutput["featuresEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
				   		"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
					  ); 	 	
	
		return $array;
	}
	
	private function getNewsConfig() {
		$configXml = $this->configXml;
		//<tokyowise> -> <news>
		$newsNode = $configXml->news;
		//<tokyowise> -> <news> -> <archive> 
		$archiveNode = $newsNode->archive;
		// <tokyowise> -> <news> -> <archive> -> <totalentries>
		$archiveTotEntries = $archiveNode->totalentries;

		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($newsNode);
		
		$array = array( "archiveTotEntries" => $archiveTotEntries, 
					  	"featuresModuleTotalEntries" => $modulesOutput["featuresEntries"], 
					  	"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
					  ); 	
		
		return $array; 
	}
	
	private function getEditorsConfig() {
		$configXml = $this->configXml;
		// <tokyowise> -> <editors>
		$editorsNode = $configXml->editors;
		// Get the config for modules in this page
		$modulesOutput = $this->getModulesConfig($editorsNode);
		
		$array = array( "featuresModuleTotalEntries" => $modulesOutput["featuresEntries"],
				   		"newsModuleTotalEntries" => $modulesOutput["newsEntries"],
				   		"rensaiModuleTotalEntries" => $modulesOutput["rensaiEntries"],
				   		"gadgetsModuleTotalEntries" => $modulesOutput["gadgetsEntries"],
					  ); 	 	
	
		return $array;
	}
	
	private function getModulesConfig($pageNode) {		
		// Get the inner elements of the $pageNode -> <modules> node
		$modulesNode = $pageNode->modules;
		
		// Get the number of entries for the features module
		$featuresEntries = $modulesNode->features;
		// Get the number of entries for the rensai module
		$rensaiEntries = $modulesNode->rensai;
		// Get the number of entries for the gadgets module
		$gadgetsEntries = $modulesNode->gadgets;
		// Get the number of entries for the news module
		$newsEntries = $modulesNode->news;
		
		$array = array( "featuresEntries" => $featuresEntries, 
					  	"rensaiEntries" => $rensaiEntries,
					  	"gadgetsEntries" => $gadgetsEntries,
					  	"newsEntries" => $newsEntries,
					  );
		
		return $array;			   	
	}
	
	/* Set Config */
	
	/* 
		Possible parameter values:
		$page -> "home"
		$column -> "headerimg" -> $val = array([wide img filename], [narrow img filename]) , 
				   "headline" -> $val = array([entry idx (0-4)], [record type (Features, Rensai, etc...)], [record id]), 
				   "features-highlight" -> $val = (int) [total entries],
				   "news" -> $val = (int) [total entries], 
				   "rensai" -> $val = (int) [total entries], 
				   "gadgets" -> $val = (int) [total entries]   
	*/
	private function setHomeConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <home>
		$homeNode = $configXml->home;
		
		switch ($column) {
			case "headerimg" :
				// <tokyowise> -> <home> -> <headerimg>
				$headerimgNode = $homeNode->headerimg;
				
				// Update the Xml file
				$headerimgNode->lastupdate = $val;
				break;
			case "headline" :
				// <tokyowise> -> <home> -> <headline>
				$headlineNode = $homeNode->headline;
				
				// Get the headline index (5 boxes, so the range is 0-4)
				$tgtHeadlineIdx = intval($val[0]);
				// Get the record type (Features, Rensai, etc...)
				// Recall: all chars have to be lowercase
				$tgtHeadlineRecordType = strtolower($val[1]);
				// Get the record id 
				$tgtHeadlineRecordId = intval($val[2]);
				
				// Update the xml file
				$headlineNode->entry[ $tgtHeadlineIdx ]->page = $tgtHeadlineRecordType;
				$headlineNode->entry[ $tgtHeadlineIdx ]->id = $tgtHeadlineRecordId;		
				break;	
			case "features-highlight" :
				$homeNode->featurehighlight->totalentries = $val;
				break;	
			case "news" :
				$homeNode->modules->news = $val;
				break;
			case "rensai" :
				$homeNode->modules->rensai = $val;	
				break;
			case "gadgets" :
				$homeNode->modules->gadgets = $val;
				break;			
		}
	}
	
	private function setFeaturesConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <features>
		$featuresNode = $configXml->features;
		
		switch ($column) {	
			case "news" :
				$featuresNode->modules->news = $val;
				break;
			case "rensai" :
				$featuresNode->modules->rensai = $val;	
				break;
			case "gadgets" :
				$featuresNode->modules->gadgets = $val;
				break;			
		}
	}
	
	private function setRensaiConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <rensai>
		$rensaiNode = $configXml->rensai;
		
		switch ($column) {	
			case "new-articles-list" :
				$rensaiNode->latestposts = $val;
				break;
			case "news" :
				$rensaiNode->modules->news = $val;
				break;
			case "features" :
				$rensaiNode->modules->features = $val;	
				break;
			case "gadgets" :
				$rensaiNode->modules->gadgets = $val;
				break;			
		}
	}	
	
	private function setGadgetsConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <gadgets>
		$gadgetsNode = $configXml->gadgets;
		
		switch ($column) {	
			case "news" :
				$gadgetsNode->modules->news = $val;
				break;
			case "rensai" :
				$gadgetsNode->modules->rensai = $val;	
				break;
			case "features" :
				$gadgetsNode->modules->features = $val;
				break;			
		}
	}
	
	private function setNewsConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <news>
		$newsNode = $configXml->news;
		
		switch ($column) {	
			case "rensai" :
				$newsNode->modules->rensai = $val;
				break;
			case "features" :
				$newsNode->modules->features = $val;	
				break;
			case "gadgets" :
				$newsNode->modules->gadgets = $val;
				break;			
		}
	}
	
	private function setEditorsConfig($column, $val) {		
		$configXml = $this->configXml;
		// <tokyowise> -> <editors>
		$editorsNode = $configXml->editors;
		
		switch ($column) {	
			case "rensai" :
				$editorsNode->modules->rensai = $val;
				break;
			case "features" :
				$editorsNode->modules->features = $val;	
				break;
			case "news" :
				$editorsNode->modules->news = $val;	
				break;	
			case "gadgets" :
				$editorsNode->modules->gadgets = $val;
				break;			
		}
	}			
	
	/* Others */
	
	private function pageNotExistAction() {
		return array();
	}
}
?>