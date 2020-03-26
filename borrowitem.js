var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('itemdata', function($scope, $http, $window) {
    $scope.AddModal = false;
    $scope.EditModal = false;
    $scope.DeleteModal = false;
    $scope.ListModal = false;
    $scope.erroritem_name = false;

    $scope.showAdd = function() {
        $scope.cat_name = null;
        $scope.item_name = null;
        $scope.detail = null;
        $scope.serail = null;
        $scope.cat_id = null;
        $scope.type_id = null;
        $scope.model_id = null;
        $scope.unit_id = null;
        $scope.in_use = null;


        $scope.erroritem_name = false;
        $scope.errordetail = false;
        $scope.errordetail = false;
        $scope.errorserail = false;
        $scope.errorcat_id = false;
        $scope.errortype_id = false;
        $scope.errormodel_id = false;
        $scope.errorunit_id = false;
        $scope.errorin_use = false;
        $scope.AddModal = true;
    }



    $scope.addnew = function() {
        $http.post(
            "additem.php", {

            }
        ).success(function(data) {

            $scope.AddModal = false;
            $scope.success = true;
            $scope.successMessage = data.message;
            $scope.fetch();

        });
    }

    $scope.submitForm = function() {
        $http({
            method: "POST",
            url: 'fetchitemselect.php',
            data: $scope.data
        }).success(function(data) {
            if (data.message != '') {
                $scope.data = null;
                $scope.success = false;
                $scope.item = data;
                $interval(function() {
                    $scope.success = false;
                }, 5000);
            }
        });
    };



    $scope.fetch = function() {
        $http.get("fetchitem.php")
            .success(function(data) {
                $scope.item = data;

            });
    }




    $scope.sort = function(keyname) {
        $scope.sortKey = keyname;
        $scope.reverse = !$scope.reverse;
    }

    $scope.clearMessage = function() {
        $scope.success = false;
        $scope.error = false;
    }



    $scope.selectitem = function(item) {
        $scope.clickitem = item;
    }

    $scope.showEdit = function() {
        $scope.EditModal = true;
    }

    $scope.showEdit = function() {
        $scope.EditModal = true;
    }


    $scope.updateitem = function() {
        $http.post("addcart.php", $scope.clickitem)
            .success(function(data) {


                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                    $scope.success = false;

                } else {
                    $scope.data = null;
                    $scope.error = false;
                    $scope.success = true;
                    $scope.item = data;
                    $scope.successMessage = "เพิ่มสำเร็จ";
                    $interval(function() {
                        $scope.success = false;
                    }, 5000);
                }

            });

    }



    $scope.updatecart = function() {
        $http.post(
            "updatecart.php", {
                'item': $scope.item,
            }
        ).success(function(data) {
                $scope.fetch();
            }


        );
    }


});