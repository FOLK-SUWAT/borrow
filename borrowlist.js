var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('borrowdata', function($scope, $http, $window) {
    $scope.AddModal = false;
    $scope.EditModal = false;
    $scope.DeleteModal = false;

    $scope.DeleteitemModal = false;
    $scope.showborrow_bill = false;
    $scope.showborrow_item = false;

    $scope.EdititemModal = false;
    $scope.errorborrow_topic = false;

    $scope.showAdd = function() {
        $scope.borrow_bill = null;
        $scope.borrow_topic = null;
        $scope.item_name = null;
        $scope.num_request = null;
        $scope.detail = null;
        $scope.borrow_date = null;
        $scope.return_date = null;
        $scope.status = null;

        $scope.errorborrow_topic = false;
        $scope.erroritem_name = false;
        $scope.errornum_request = false;
        $scope.errordetail = false;
        $scope.errorborrow_date = false;
        $scope.errorreturn_date = false;
        $scope.errorstatus = false;
        $scope.AddModal = true;
    }
    $scope.edititem = function() {
        $http.post("fetcheditlist.php",
            $scope.clickborrow)

        .success(function(data) {
            $scope.showborrow_item = true;
            $scope.showborrow_bill = false;
            $scope.data = null;
            $scope.borrow = data;
            $interval(function() {
                $scope.success = false;
            }, 5000);

        });
    };
    $scope.reitem = function() {
        $http.post("fetchreeditlist.php",
            $scope.clickborrow)

        .success(function(data) {
            $scope.data = null;
            $scope.borrow = data;
            $interval(function() {
                $scope.success = false;
            }, 5000);

        });
    };


    $scope.fetch = function() {
        $scope.showborrow_bill = true;
        $scope.showborrow_item = false;
        $http.get("fetchlist.php").success(function(data) {
            $scope.borrow = data;
        });
    }


    $scope.dayscheck = function(date) {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + mm + dd;
        $scope.today = today;
        var date = new Date(date);
        var ddd = date.getDate();
        var mmm = date.getMonth() + 1;
        var yyyyy = date.getFullYear();
        if (ddd < 10) {
            ddd = '0' + ddd
        }
        if (mmm < 10) {
            mmm = '0' + mmm
        }
        date = yyyyy + mmm + ddd;
        $scope.retrun = date;
        $scope.daycheck = today;
        $scope.total = date - today;
        $scope.item

        $scope.idcheck = function(data) {
            if ($scope.total < 0) {
                $scope.idcheck = data;
                return $scope.idcheck;
            } else {
                $scope.idcheck = data;
                return $scope.idcheck;
            }

        }

        return $scope.total;
    }


    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    }

    $scope.clearMessage = function() {
        $scope.success = false;
        $scope.error = false;
    }



    $scope.selectborrow = function(borrow) {
        $scope.clickborrow = borrow;
    }

    $scope.showEdititem = function() {
        $scope.EdititemModal = true;
    }

    $scope.showEdit = function() {
        $scope.EditModal = true;
    }

    $scope.updateitem = function() {
        $http.post("editborrowlist.php", $scope.clickborrow)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                    $scope.fetch();
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                }
            });
    }

    $scope.updateborrow = function() {
        $http.post("editborrow.php", $scope.borrow)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                    $scope.fetch();
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                }
            });
    }

    $scope.showDeleteitem = function() {
        $scope.DeleteitemModal = true;
    }

    $scope.showDelete = function() {
        $scope.DeleteModal = true;
    }
    $scope.deleteborrowitem = function() {
        $http.post("deleteborrowitem.php", $scope.clickborrow)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                    $scope.reitem();
                }
            });
    }

    $scope.deleteborrow = function() {
        $http.post("deleteborrow.php", $scope.clickborrow)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                    $scope.fetch();
                }
            });
    }


});