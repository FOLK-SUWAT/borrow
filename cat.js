var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.controller('catdata', function ($scope, $http, $window) {
	$scope.AddModal = false;
	$scope.EditModal = false;
	$scope.DeleteModal = false;

	$scope.errormem_name = false;

	$scope.showAdd = function () {
		$scope.cat_id = null;
		$scope.cat_name = null;
		$scope.type_id = null;

		$scope.errorcat_id = false;
		$scope.errorcat_name = false;
		$scope.type_id = false;
		$scope.AddModal = true;
	}



	$scope.fetch = function () {
		$http.get("fetchcat.php").success(function (data) {
			$scope.cat = data;
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
			"addcat.php", {
				'cat_id': $scope.cat_id,
				'cat_name': $scope.cat_name,
				'type_id': $scope.type_id,

			}
		).success(function (data) {
			if (data.cat_id) {
				$scope.errocat_id = true;
				$scope.errocat_name = false;
				$scope.errotype_id = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('cat_id').focus();
			}
			else if (data.cat_name) {
				$scope.errocat_id = false;
				$scope.errocat_name = true;
				$scope.errotype_id = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('cat_name').focus();
			}else if (data.type_id) {
				$scope.errocat_id = false;
				$scope.errocat_name = false;
				$scope.errotype_id = true;
				$scope.errorMessage = data.message;
				$window.document.getElementById('type_id').focus();
			}else {
				$scope.AddModal = false;
				$scope.success = true;
				$scope.successMessage = data.message;
				$scope.fetch();
			}
		});
	}

	$scope.selectcat = function (cat) {
		$scope.clickcat = cat;
	}

	$scope.showEdit = function () {
		$scope.EditModal = true;
	}

	$scope.updatecat = function () {
		$http.post("editcat.php", $scope.clickcat)
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

	$scope.deletecat = function () {
		$http.post("deletecat.php", $scope.clickcat)
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