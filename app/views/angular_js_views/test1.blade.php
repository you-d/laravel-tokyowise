<!-- 1st Test Module -->
<div id="test-1-container" ng-app="test1Module">
		<div class="row">
				<div class="col-md-4">
					<div data:ng-controller="test1Controller">
							Hello, World! <% 5 + 3 %>
							<p>Number of Employees: <% ourEmployees.length %></p>
							<span data:ng-bind="ourEmployees.length"></span>
							<br>
							<button data:ng-click="showHideColours()" type="button">
									<% isHiddenFlag ? 'Show Available Colours' : 'Hide Available Colours' %>
							</button>
							<div id="red" data:ng-hide="isHiddenFlag">Red</div>
							<div id="green" data:ng-hide="isHiddenFlag">Green</div>
							<div id="blue" data:ng-hide="isHiddenFlag">Blue</div>
							<hr>
					</div>
				</div>
				<div class="col-md-4">
					<div data:ng-controller="test1bController">
							<span data:custom-colour-list-1-directive></span>
					</div>
					<hr>
				</div>
				<div class="col-md-4">
					<div data:ng-controller="test1cController">
							<p>The URL is: <% url %></p>
							<ul>
									<li data:ng-cloak><% protocol %></li>
									<li data:ng-cloak><% host %></li>
									<li data:ng-cloak><% port %></li>
									<li data:ng-cloak><% docTitle %></li>
									<li data:ng-cloak><% winWidth %></li>
							</ul>
					</div>
					<hr>
				</div>
		</div>
		<div class="row">
				<div class="col-md-4">
						<div data:ng-controller="test1dController">
								<p data:ng-cloak><% theDate %></p>
								<p data:ng-cloak><% theTime %></p>
						</div>
						<hr>
				</div>
				<div class="col-md-4">
						<div data:ng-repeat="city in ['Liverpool','Perth','Sydney','Dublin','Paris']">
							<% $index %> . <% city %>
							<% $first ? '(This is the first row)' : '' %>
							<% $last ? '(This is the last row)' : '' %>
						</div>
						<hr>
				</div>
		</div>
		<!-- DUMMY CONTENT -->
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</div>
