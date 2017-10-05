angular.module('notesApp',['ngMaterial'])
    .controller('EditDetails', function ($scope, $mdDialog) {
        $scope.signup = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'signupDialog.php',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose:true// Only for -xs, -sm breakpoints.
            })
        };

        function DialogController($scope, $mdDialog) {
            $scope.close = function() {
                $mdDialog.cancel();
            };
            $scope.confirm = function() {

              console.log("hh")
                // localStorage.setItem("name", $scope.name);
                // localStorage.setItem("latitude", $scope.latitude);
                // localStorage.setItem("longitude", $scope.longitude);
                // var a = localStorage.getItem("name");
                // var b = localStorage.getItem("latitude");
                // var c = localStorage.getItem("longitude");
                // $("#CompanyName").html(a);
                $scope.close();
            }

        }
    });
