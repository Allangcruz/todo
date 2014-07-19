var app = angular.module("app",[]);

app.controller("todo",function($scope,$http){

    $scope.load = false;
    
    /*
    | Função que fecha um alerta
    */
    $scope.fechar = function (){
         angular.element("#resposta").html("");
    }

    /*
     |Função que salva um item
    */
    $scope.save = function(){
      if($scope.item.text === ""){
        resposta = '<div class="alert alert-error">Preencha o campo! <a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
        angular.element("#resposta").html(resposta);
      }else{
        $scope.load = true;
        //atualizar os itens
        if($scope.item.id > 0){
          $http.put("todo/update",$scope.item).
            success(function(data){//trata resposta do servidor

              var resposta = '';
              switch(data.msg.tipo){
                case 'a':
                    resposta = '<div class="alert alert-block">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;

                case 'e':
                    resposta = '<div class="alert alert-error">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;          

                case 's':
                    resposta = '<div class="alert alert-success">'+data.msg.texto+'<a href="#" ng-click="fechar();"  class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.read();            
                    reset();
                    $scope.load = false;
                break;
              }

          });

        }else{
  
          //salva os itens
          $http.post("todo/save",$scope.item).
            success(function(data){
              var resposta = '';
              switch(data.msg.tipo){
                case 'a':
                    resposta = '<div class="alert alert-block">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;

                case 'e':
                    resposta = '<div class="alert alert-error">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;          

                case 's':
                    resposta = '<div class="alert alert-success">'+data.msg.texto+'<a href="#" ng-click="fechar();"  class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.read();     
                    reset();
                    $scope.load = false;
                break;
              }
          });
        }

      }

    }//fim save
    

    /*
     |Função que atualiza um item
    */
    $scope.update = function(unidade){
      $scope.item = unidade;
    }
    


    /*
     |Função que consulta varios itens
    */
    $scope.read = function(){
      $http.get("todo/read").
        success(function(data){
         $scope.itens = data;
        });
    }
    

    /*
     |Função que exclui um item
    */
    $scope.delete = function(id){
      $scope.load = true;

        $http.delete("todo/delete/"+id).
          success(function(data){
            var resposta = '';
              switch(data.msg.tipo){
                case 'a':
                    resposta = '<div class="alert alert-block">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;

                case 'e':
                    resposta = '<div class="alert alert-error">'+data.msg.texto+'<a href="#" ng-click="fechar();" class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.load = false;
                break;          

                case 's':
                    resposta = '<div class="alert alert-success">'+data.msg.texto+'<a href="#" ng-click="fechar();"  class="close" data-dismiss="alert">&times;</a></div>';
                    angular.element("#resposta").html(resposta);
                    $scope.read();     
                    reset();
                    $scope.load = false;
                break;
              }

          });

    }

    /*
     |Função que zera o formulario
    */
    var reset = function(){
        $scope.item = {id : 0, text: "", done: false};
    } 

    /*
     |Função que executa quando iniciar
    */
    var init = function(){
        $scope.read();
        reset();
    }

    //executa
    init();

});