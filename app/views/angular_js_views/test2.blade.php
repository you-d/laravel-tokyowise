<!-- 2nd Test Module -->
<div id="test-2-container" ng-app="test2Module">
    <div data:ng-controller="TokyowiseRensaiPageResourceController">
        <h1>All Rensai Category Record</h1>
				<br>
        <div data:ng-repeat="rensaiCategory in rensaiCategories" data:ng-show="rensaiCategoriesIsAvailable">
            <div>
                <span data:ng-bind="rensaiCategory.id"></span>
                &nbsp;=>&nbsp;
                <span data:ng-bind="rensaiCategory.group_desc"></span>
            </div>
        </div>
				<div data:ng-hide="rensaiCategoriesIsAvailable">
						N/A
				</div>
        <hr>
        <h1>All Rensai Post Record</h1>
				<br>
        <div data:ng-repeat="rensaiPost in rensaiPosts" data:ng-show="rensaiPostsIsAvailable">
            <div>
                <span data:ng-bind="rensaiPost.id"></span>
                &nbsp;=>&nbsp;
                <span data:ng-bind="rensaiPost.post_title"></span>
            </div>
        </div>
				<div data:ng-hide="rensaiPostsIsAvailable">
						N/A
				</div>
        <hr>
        <h1>A Rensai Category Record</h1>
				<br>
				<div data:ng-show="aRensaiCategoryIsAvailable">
        		<span data:ng-bind="aRensaiCategory.id"></span>
						&nbsp;=>&nbsp;
						<span data:ng-bind="aRensaiCategory.group_desc"></span>
				</div>
				<div data:ng-hide="aRensaiCategoryIsAvailable">
						N/A
				</div>
        <hr>
        <h1>Change New Article List Total Entries</h1>
        <br>
        <change-new-articles-total-entries-directive currentTotEntries="currentTotEntries" currentTotEntriesResolved="currentTotEntriesResolved" />
        <hr>
		</div>
		<!-- DUMMY CONTENT -->
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
