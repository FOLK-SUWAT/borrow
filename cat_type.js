var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('catdata', function ($scope, $http, $window) {
	$scope.AddModal = false;
	$scope.EditModal = false;
	$scope.DeleteModal = false;

	$scope.errormem_name = false;

	$scope.showAdd = function () {
		$scope.type_id = null;
		$scope.type_name = null;


		$scope.errortype_id = false;
		$scope.errortype_name = false;

		$scope.AddModal = true;
	}

	$scope.fetch = function () {
		$http.get("fetchcat_type.php").success(function (data) {
			$scope.cat_type = data;
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
			"addcat_type.php", {
				
				'type_id': $scope.type_id,
				'type_name': $scope.type_name,
				

			}
		).success(function (data) {
			if (data.type_id) {
				$scope.errortype_id = false;
				$scope.errortype_name = false;

				$scope.errorMessage = data.message;
				$window.document.getElementById('type_id').focus();
			}else if (data.type_name) {
				$scope.errortype_id = true;
				$scope.errortype_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('type_name').focus();
			}else {
				$scope.AddModal = false;
				$scope.success = true;
				$scope.successMessage = data.message;
				$scope.fetch();
			}
		});
	}

	$scope.selectcat_type = function (cat_type) {
		$scope.clickcat_type = cat_type;
	}

	$scope.showEdit = function () {
		$scope.EditModal = true;
	}

	$scope.updatecat_type = function () {
		$http.post("editcat_type.php", $scope.clickcat_type)
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

	$scope.deletecat_type = function () {
		$http.post("deletecat_type.php", $scope.clickcat_type)
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