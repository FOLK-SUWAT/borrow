var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('memberdata', function ($scope, $http, $window) {
	$scope.AddModal = false;
	$scope.EditModal = false;
	$scope.DeleteModal = false;

	$scope.errormem_name = false;

	$scope.showAdd = function () {
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

	$scope.fetch = function () {
		$http.get("fetchdepartment.php").success(function (data) {
			$scope.member = data;
		});
	}

	$scope.sort = function (keyname) {
		$scope.sortKey = keyname;
		$scope.reverse = !$scope.reverse;
	}

	$scope.clearMessage = function () {
		$scope.success = false;
		$scope.error = false;
	}

	$scope.addnew = function () {
		$http.post(
			"adddepartment.php", {
				'department': $scope.department,
				'line_token': $scope.line_token,


			}
		).success(function (data) {
			if (data.department) {
				$scope.errordepartment = true;
				$scope.errorline_token = false;
				$window.document.getElementById('department').focus();
			}else if(data.line_token) {
				$scope.errordepartment = false;
				$scope.errorline_token = true;
				$window.document.getElementById('line_token').focus();
			}
			else {
				$scope.AddModal = false;
				$scope.success = true;
				$scope.successMessage = data.message;
				$scope.fetch();
			}
		});
	}

	$scope.selectMember = function (member) {
		$scope.clickMember = member;
	}

	$scope.showEdit = function () {
		$scope.EditModal = true;
	}

	$scope.updateMember = function () {
		$http.post("editdepartment.php", $scope.clickMember)
			.success(function (data) {
				if (data.error) {
					$scope.error = true;
					$scope.errorMessage = data.message;
					$scope.fetch();
				}
				else {
					$scope.success = true;
					$scope.successMessage = data.message;
				}
			});
	}

	$scope.showDelete = function () {
		$scope.DeleteModal = true;
	}

	$scope.deleteMember = function () {
		$http.post("deletedepartment.php", $scope.clickMember)
			.success(function (data) {
				if (data.error) {
					$scope.error = true;
					$scope.errorMessage = data.message;
				}
				else {
					$scope.success = true;
					$scope.successMessage = data.message;
					$scope.fetch();
				}
			});
	}

});