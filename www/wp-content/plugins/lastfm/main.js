(function(){
  var app = angular.module('lastFM',['ui.bootstrap']);
  app.run(function($rootScope){
    $rootScope.data = [];
    $rootScope.searchType = '';
    $rootScope.notfound = false;
    $rootScope.alertMessage = null;
  });

  app.controller('searchController',['$scope','$http','$rootScope',function($scope,$http,$rootScope){
    $scope.searchItem = '';
    $scope.searchType = 'track';

    $scope.search = function(){
      $rootScope.alertMessage = null;
      $rootScope.searchType = $scope.searchType;

      if($scope.searchType === 'album'){

        $http.get('/slim/api/album/'+$scope.searchItem).then(function(response){
          if(response.data.length>0){
            $rootScope.data = response.data;
            $rootScope.notfound = false;
          }else{
            $rootScope.notfound = true;
          }
        });

      }else if($scope.searchType === 'artist'){

        $http.get('/slim/api/artist/'+$scope.searchItem).then(function(response){
          if(response.data.length>0){
            $rootScope.data = response.data;
            $rootScope.notfound = false;
          }else{
            $rootScope.notfound = true;
          }
        });

      }else{

        $http.get('/slim/api/track/'+$scope.searchItem).then(function(response){
          if(response.data.length>0){
            $rootScope.data = response.data;
            $rootScope.notfound = false;
          }else{
            $rootScope.notfound = true;
          }
        });

      }
    };
  }]);

  app.controller('favoriteController',['$scope','$http','$rootScope',function($scope,$http,$rootScope){
    $scope.alertColor = 'success';
    $scope.customName = '';
    $scope.customDesc = '';
    var commands = {
      'add name *val' : function(val){
        $scope.customName = val;
        $scope.$apply();
      },
      'add description *val' : function(val){
        $scope.customDesc = val;
        $scope.$apply();
      },
      'save the favorite' : function(){
        $scope.saveCustomFav();
        annyang.abort();
      }
    };

    annyang.addCommands(commands);

    $scope.activateSpeech = function(){
      annyang.start();
    }

    $scope.saveFav = function(name,artist,image){
      $http.post('/slim/api/fav',{'name':name,'artist':artist,'image':image,'type':$rootScope.searchType}).then(function(response){
        if(response.data === 'exist'){
          $rootScope.alertMessage = 'Record already in the favorite.';
          $scope.alertColor = 'warning';
        }else if(response.data === 'saved'){
          $rootScope.alertMessage = 'Record saved successfully.';
          $scope.alertColor = 'success';
        }else{
          $rootScope.alertMessage = 'Try Again. Something went wrong.';
          $scope.alertColor = 'danger';
        }
      });
      
    };

    $scope.saveCustomFav = function(){
      $http.post('/slim/api/fav',{'name':$scope.customName,'description':$scope.customDesc,'type':'custom'}).then(function(response){
        if(response.data === 'exist'){
          $rootScope.alertMessage = 'Record already in the favorite.';
          $scope.alertColor = 'warning';
        }else if(response.data === 'saved'){
          $rootScope.alertMessage = 'Record saved successfully.';
          $scope.alertColor = 'success';
        }else{
          $rootScope.alertMessage = 'Try Again. Something went wrong.';
          $scope.alertColor = 'danger';
        }
      });
    };

  }]);
})();
