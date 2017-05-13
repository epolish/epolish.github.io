<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" ng-app="exampleApp">
	<head>
		<title>Items Editor</title>
		<link href="css/bootstrap.css" rel="stylesheet" />
		<link href="css/bootstrap-theme.css" rel="stylesheet" />
		<script src="js/angular.js"></script>
		<script src="js/angular_resource.js"></script>
		<script src="js/app.js"></script>
	</head>
	<body ng-controller="defaultCtrl">
		<div class="panel panel-primary">
			<h3 class="panel-heading">Products</h3>
			<ng-include src="'templates/table.php'" ng-show="currentView == 'table'"></ng-include>
			<ng-include src="'templates/edit.php'" ng-show="currentView == 'edit'"></ng-include>
		</div>
	</body>
</html>