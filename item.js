var app = angular.module('app', ['angularUtils.directives.dirPagination']);
app.directive("fileInput", function($parse){  
	 return{  
		  link: function($scope, element, attrs){  
			   element.on("change", function(event){  
					var files = event.target.files;  
					//console.log(files[0].name);  
					$parse(attrs.fileInput).assign($scope, element[0].files);  
					$scope.$apply();  
			   });  
		  }  
	 }  
});  

app.controller('itemdata', function ($scope, $http, $window) {
	$scope.AddModal = false;
	$scope.EditModal = false;
	$scope.DeleteModal = false;

	$scope.erroritem_name = false;

	$scope.showAdd = function () {
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



	$scope.addnew = function () {
		$http.post(
			"additem.php", {
				'type_id': $scope.type_id,
				'cat_id': $scope.cat_id,
				'serail': $scope.serail,
				'item_name': $scope.item_name,
				'detail': $scope.detail,
				'in_use': $scope.in_use,
				'unit_name': $scope.unit_name,
		
			}
		).success(function (data) {
			if (data.cat_data) {
				$scope.errocat_data = true;
				$scope.errortype_id = false;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('cat_data').focus();
			}else if (data.cat_name) {
				$scope.errocat_name = false;
				$scope.errortype_id = true;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('type_id').focus();
			}
			else if (data.type_id) {
				$scope.errocat_name = false;
				$scope.errortype_id = true;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('type_id').focus();
			} else if (data.type_name) {
				$scope.errocat_name = false;
				$scope.errortype_id = false;
				$scope.errortype_name = true;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('type_name').focus();
			} else if (data.model_id) {
				$scope.errocat_name = false;
				$scope.errortype_id = false;
				$scope.errortype_name = false;
				$scope.errormodel_id = true;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('model_id').focus();
			} else if (data.model_name) {
				$scope.errocat_name = false;
				$scope.errortype_id = false;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = true;
				$scope.errorunit_id = false;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('model_name').focus();
			} else if (data.unit_id) {
				$scope.errocat_name = false;
				$scope.errortype_id = false;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = true;
				$scope.errorunit_name = false;
				$scope.errorMessage = data.message;
				$window.document.getElementById('unit_id').focus();
			} else if (data.unit_name) {
				$scope.errocat_name = false;
				$scope.errortype_id = false;
				$scope.errortype_name = false;
				$scope.errormodel_id = false;
				$scope.errormodel_name = false;
				$scope.errorunit_id = false;
				$scope.errorunit_name = true;
				$scope.errorMessage = data.message;
				$window.document.getElementById('unit_name').focus();
			}
			else {
				$scope.AddModal = false;
				$scope.success = true;
				$scope.successMessage = data.message;
				$scope.fetch();
			}
		});
	}

	$scope.fetch = function () {
		$http.get("fetchitemmanager.php").success(function (data) {
			$scope.item = data;
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



	$scope.selectitem = function (item) {
		$scope.clickitem = item;
	}

	$scope.showEdit = function () {
		$scope.EditModal = true;
	}

	$scope.uploadFile = function(){  
		var form_data = new FormData(editupload); 
		angular.forEach($scope.files, function(file){  
			 form_data.append('file', file);  
		});  
		$http.post('upload.php',form_data,  
		{  
			 transformRequest: angular.identity,  
			 headers: {'Content-Type': undefined,'Process-Data': false} 
			
		}).
		
		
		success(function(response){  
			 alert(response);  
			 $scope.fetch();  
		});  
   }  


	$scope.updateitem = function () {
		$http.post("edititem.php", $scope.clickitem)
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
				$scope.fetch();
				//location.reload();
			});
	}

	$scope.showDelete = function () {
		$scope.DeleteModal = true;
	}

	$scope.deleteitem = function () {
		$http.post("deleteitem.php", $scope.clickitem)
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