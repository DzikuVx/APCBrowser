var apcBrowserApp = angular.module('apcBrowser', []);

apcBrowserApp.controller('EntryListController', function ($scope, $http) {
//    $scope.entries = [
//        {
//            key: 'key1',
//            'hits': 2,
//            'size' : 12,
//            'accessed': '2012-01-01',
//            'modified': '2012-01-01',
//            'created': '2012-01-01',
//            'timeout': '84600'
//        }, {
//            'key': 'key2',
//            'hits': 2,
//            'size' : 12,
//            'accessed': '2012-01-01',
//            'modified': '2012-01-01',
//            'created': '2012-01-01',
//            'timeout': '84600'
//        }
//    ];

    $http.get('api.php?controller=EntryList').success(function(data) {
        $scope.entries = data;
    });

//    $scope.orderProp = 'age';
//    api.php?controller=EntryList

});