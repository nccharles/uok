// Application module
var myApp = angular.module('myApp',[]);
myApp.controller("myController",['$scope','$http', function($scope,$http){

// Function to get employee details from the database
getInfo();
function getInfo(){
// Sending request to EmpDetails.php files
$http.post('db/empDetails.php').success(function(data){
// Stored the returned data into scope
$scope.groups = data;
});
}


      $scope.newMember = {};
      $scope.message="";
      $scope.members=[
        {fname:"Mukama", lname: "Aline", groupname:"Summomy"},
        {fname:"kalisa", lname: "issa", groupname:"Summomy"},
        {fname:"Bihozagara", lname: "samy", groupname:"Summomy"},
        {fname:"musonera", lname: "issa", groupname:"Summomy"},
        {fname:"nsengiyumva", lname: "said", groupname:"Summomy"},
        {fname:"teta", lname: "mamy", groupname:"Summomy"},

       ];
     $scope.saveGroup = function(){
       $scope.groups.push($scope.newGroup);
       $scope.newGroup = {};
       $scope.message="New User Added successful!";
     };
     $scope.selectGroup = function(clue){
       $scope.clickedGroup = clue;

     };
     $scope.updateGroup= function(){
     $scope.message="Group Updated successful!";
     };
     $scope.deleteGroup = function(){
        $scope.groups.splice($scope.groups.indexOf($scope.clickedGroup), 1);
        $scope.message="Group Deleted successful!";
     };
    $scope.clearMessage = function(){
      $scope.message="";
    };

}]);
