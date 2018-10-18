// Creating module.
var proud_peach = angular.module('proud_peach', ['ngRoute']);

// Configuring routes for main page.
proud_peach.config(function($routeProvider) {
  $routeProvider

  // Main page.
  .when('/', {
    templateUrl : 'pages/main.html',
    controller  : 'mainCtrl'
  })

  // Patients page.
  .when('/patients', {
    templateUrl : 'pages/patients.html',
    controller  : 'patientsCtrl'
  })

  // Records page.
  .when('/records', {
    templateUrl : 'pages/records.html',
    controller  : 'recordsCtrl'
  })

  // Prescriptions page.
  .when('/prescriptions', {
    templateUrl : 'pages/prescriptions.html',
    controller  : 'prescriptionsCtrl'
  })

  // Leaves page.
  .when('/leaves', {
    templateUrl : 'pages/leaves.html',
    controller  : 'leavesCtrl'
  });
});

// main page controller.
proud_peach.controller('mainCtrl', function($scope) {
  //
});

// patients page controller.
proud_peach.controller('patientsCtrl', function($scope) {
  //
});

// records page controller.
proud_peach.controller('recordsCtrl', function($scope) {
  //
});

// prescriptions page controller.
proud_peach.controller('prescriptionsCtrl', function($scope) {
  //
});

// leaves page controller.
proud_peach.controller('leavesCtrl', function($scope) {
  //
});
