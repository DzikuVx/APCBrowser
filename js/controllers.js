var apcBrowserApp = angular.module('apcBrowser', ['ui.bootstrap']);

apcBrowserApp.controller('EntryListController', function ($scope, $http) {

    $http.get('api.php?controller=EntryList').success(function(data) {
        $scope.entries = data;
    });

});