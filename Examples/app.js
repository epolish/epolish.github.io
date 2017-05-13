angular.module("exampleApp", ["ngResource"])
.constant("baseUrl", "http://example/class/bootstrap.php")
.factory('$appResource', ['$resource', function($resource){
  return function(url, paramDefaults, actions){
     var newResource = {
       'update':   {method:'PUT'}
     };
     actions = angular.extend({}, newResource , actions);
     return $resource(url, paramDefaults, actions);
  }
}])
.controller("defaultCtrl", function ($scope, $http, $resource, baseUrl) {

    $scope.currentView = "table";

    $scope.itemsResource = $resource(baseUrl + ":id", { id: "@id" });

    $scope.refresh = function () {
        $scope.items = $scope.itemsResource.query();
    }

    $scope.create = function (item) {
        new $scope.itemsResource(item).$save().then(function (newItem) {
            $scope.items.push(newItem);
            $scope.currentView = "table";
        });
    }

    $scope.update = function (item) {
        item.$save();
        $scope.currentView = "table";
    }

    $scope.delete = function (item) {
        item.$delete().then(function () {
            $scope.items.splice($scope.items.indexOf(item), 1);
        });
        $scope.currentView = "table";
    }

    $scope.editOrCreate = function (item) {
        $scope.currentItem = item ? item : {};
        $scope.currentView = "edit";
    }

    $scope.saveEdit = function (item) {
        if (angular.isDefined(item.id)) {
            $scope.update(item);
        } else {
            $scope.create(item);
        }
    }

    $scope.cancelEdit = function () {
        if ($scope.currentItem && $scope.currentItem.$get) {
            $scope.currentItem.$get();
        }
        $scope.currentItem = {};
        $scope.currentView = "table";
    }

    $scope.refresh();
    
});
