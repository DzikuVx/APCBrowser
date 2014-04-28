var apcBrowserApp = angular.module('apcBrowser', ['ui.bootstrap']);

apcBrowserApp.controller('EntryListController', function ($scope, $http, $modal, $log) {

    $http.get('api.php?controller=EntryList').success(function(data) {
        $scope.entries = data;
    });

    $scope.alerts = [];

    $scope.items = ['item1', 'item2', 'item3'];

    $scope.closeAlert = function(index) {
        $scope.alerts.splice(index, 1);
    };

    $scope.entryDetails = function (data) {

        $http.get('api.php', {
                params: {
                    'controller': 'Entry',
                    'key': data.key
                }
            }).success(function (entryValue) {
                $modal.open({
                    templateUrl: 'entryDetailModal.html',
                    controller: EntryModalCtrl,
                    resolve: {
                        data: function () {
                            return data
                        },
                        entryValue: function () {
                            return entryValue
                        }
                    }
                });
            }).error(function () {
                $scope.alerts.push({type: "danger", msg: "Failed to get entry data from server"});
            });
    };

});

var EntryModalCtrl = function ($scope, $modalInstance, data, entryValue) {

    $scope.data = data;
    $scope.entryValue = entryValue;

    $scope.close = function () {
        $modalInstance.close();
    };

};