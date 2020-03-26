var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('itemdata', function($scope, $http, $window) {
    $scope.AddModal = false;
    $scope.EditModal = false;
    $scope.DeleteModal = false;
    $scope.DeleteallModal = false;
    $scope.saveModal = false;
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

        $.ajax({
            type:'POST',
            url:'addoder.php',
            data:
            {'item_order': $scope.item_order,
            'borrow_topic': $scope.borrow_topic,
            'detail': $scope.detail,
            'borrow_date': $scope.borrow_date,
            'return_date': $scope.return_date,
            }.success(function() {
               
    
            })
            
            
        
        });


    }

   




    $scope.fetch = function() {
        $http.get("fetchcart.php").success(function(data) {
            $scope.item = data;

            if ($scope.item != '') {
                $scope.saveModal = true;
            } else {
                $scope.saveModal = false;
            }

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
    $scope.updateitem = function() {
        $http.post("editcart.php", $scope.clickitem)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                    $scope.fetch();
                    $scope.success = false;
                } else {
                    $scope.success = true;
                    $scope.error = false;
                    $scope.successMessage = data.message;
                }
            });
    }

    $scope.showDelete = function() {
        $scope.DeleteModal = true;
    }

    $scope.deleteborrow = function() {
        $http.post("deletecart.php", $scope.clickitem)
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
    $scope.showDeleteall = function() {
        $scope.DeleteallModal = true;
    }

    $scope.deleteallborrow = function() {
        $http.post("deletecartall.php", $scope.clickitem)
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