var apcBrowserApp = angular.module('apcBrowser', ['ui.bootstrap']);

apcBrowserApp.controller('EntryListController', function ($scope, $http, $modal, $log) {

    $scope.alerts = [];

    $scope.load = function () {
        $http.get('api.php?controller=EntryList').success(function (data) {
            $scope.entries = data;
        });
    };

    $scope.closeAlert = function (index) {
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
                        },
                        parent: function () {
                            return $scope
                        }
                    }
                });
            }).error(function () {
                $scope.alerts.push({type: "danger", msg: "Failed to get entry data from server"});
            });
    };

    $scope.load();

});

var EntryModalCtrl = function ($scope, $modalInstance, $http, data, entryValue, parent) {

    $scope.data = data;
    $scope.entryValue = entryValue;
    $scope.parent = parent;

    $scope.dropEntry = function (data) {
        $http.get('api.php', {
            params: {
                'controller': 'Entry',
                'action': 'delete',
                'key': data.key
            }
        }).success(function () {
            $scope.parent.load();
            $modalInstance.close();
            $scope.parent.alerts.push({type: "success", msg: "Entry deleted"});
        }).error(function () {
            $scope.parent.alerts.push({type: "danger", msg: "Request failed"});
        });
    };

    $scope.close = function () {
        $modalInstance.close();
    };

};