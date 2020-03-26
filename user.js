var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('memberdata', function($scope, $http, $window) {
    $scope.AddModal = false;
    $scope.EditModal = false;
    $scope.DeleteModal = false;

    $scope.errormem_name = false;

    $scope.showAdd = function() {
        $scope.mem_name = null;
        $scope.email = null;
        $scope.department = null;
        $scope.password = null;
        $scope.mem_type_id = null;

        $scope.errormem_name = false;
        $scope.erroremail = false;
        $scope.errordepartment = false;
        $scope.errormem_type_id = false;
        $scope.errordepartment = false;
        $scope.AddModal = true;
    }

    $scope.fetch = function() {
        $http.get("fetch.php").success(function(data) {
            $scope.member = data;
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

    $scope.addnew = function() {
        $http.post(
            "add.php", {
                'mem_name': $scope.mem_name,
                'email': $scope.email,
                'department': $scope.department,
                'password': $scope.password,
                'mem_type_id': $scope.mem_type_id,

            }
        ).success(function(data) {
            if (data.mem_name) {
                $scope.errormem_name = true;
                $scope.erroremail = false;
                $scope.errordepartment = false;
                $scope.errorpassword = false;
                $scope.errormem_type_id = false;
                $scope.errorMessage = data.message;
                $window.document.getElementById('mem_name').focus();
            } else if (data.email) {
                $scope.errormem_name = false;
                $scope.erroremail = true;
                $scope.errordepartment = false;
                $scope.errorpassword = false;
                $scope.errormem_type_id = false;
                $scope.errorMessage = data.message;
                $window.document.getElementById('email').focus();
            } else if (data.department) {
                $scope.errormem_name = false;
                $scope.erroremail = false;
                $scope.errordepartment = true;
                $scope.errorpassword = false;
                $scope.errormem_type_id = false;
                $scope.errorMessage = data.message;
                $window.document.getElementById('department').focus();
            } else if (data.password) {
                $scope.errormem_name = false;
                $scope.erroremail = false;
                $scope.errordepartment = false;
                $scope.errorpassword = true;
                $scope.errormem_type_id = false;
                $scope.errorMessage = data.message;
                $window.document.getElementById('password').focus();
            } else if (data.mem_type_id) {
                $scope.errormem_name = false;
                $scope.erroremail = false;
                $scope.errordepartment = false;
                $scope.errorpassword = false;
                $scope.errormem_type_id = true;
                $scope.errorMessage = data.message;
                $window.document.getElementById('mem_type_id').focus();
            } else if (data.error) {
                $scope.errormem_name = false;
                $scope.erroremail = false;
                $scope.errordepartment = false;
                $scope.errorpassword = false;
                $scope.errormem_type_id = false;
                $scope.error = true;
                $scope.errorMessage = data.message;
            } else {
                $scope.AddModal = false;
                $scope.success = true;
                $scope.successMessage = data.message;
                $scope.fetch();
            }
        });
    }

    $scope.selectMember = function(member) {
        $scope.clickMember = member;
    }

    $scope.showEdit = function() {
        $scope.EditModal = true;
    }

    $scope.updateMember = function() {
        $http.post("edit.php", $scope.clickMember)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                  
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                }
                $scope.fetch();
            });
    }

    $scope.showDelete = function() {
        $scope.DeleteModal = true;
    }

    $scope.deleteMember = function() {
        $http.post("delete.php", $scope.clickMember)
            .success(function(data) {
                if (data.error) {
                    $scope.error = true;
                    $scope.errorMessage = data.message;
                } else {
                    $scope.success = true;
                    $scope.successMessage = data.message;
                    
                }
                $scope.fetch();
            });
    }

});