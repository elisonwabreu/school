$(function(){
    
});    

    function editarAluno(codigo, formulario, codigo_classe, base_url, dados){
       
        //formulario.validate();
        url         = base_url + 'index.php?admin/student/'+codigo+'/do_update/' + codigo;

        function sucesso(retorno){

           // alert("Dados editados com sucesso!");
            $('#modal_ajax').modal('hide');  
            var novaURL = base_url + 'index.php?admin/student_information/'+codigo_classe;
            $(location).attr('href',novaURL);
            $('#mensagem').delay(2500).fadeIn('slow');
            $('#mensagem').addClass('alert alert-success').attr('role', 'alert');
            $('#mensagem').html("Dados Editados com sucesso");
            $('#mensagem').delay(1500).fadeOut('slow');

        }

        function carregando(data) {


        }

        function complete(data) {
            // $('#modal_ajax').modal('hide');

        }

        function erro(data) {
            alert("deu merda");
            $('#modal_ajax').modal('hide');
        }

        $.ajax({
            type: 'POST',
            url: url,
            data: dados,
            beforeSend: carregando,
            error: erro,
            success: sucesso,
            complete: complete
        });

    }
    
    /*function teste(base_url){
        //alert("entrou");
        url         = base_url + 'index.php?admin/imagem';
        var sender  = $('form[name="formulario_add"]');
        var loader  = $('#resposta');
        
        sender.submit(function(){
            $(this).ajaxSubmit({
                url: url,
                success: function(dado){
                    loader.empty().html('<pre>'+ dado + '</pre>');
                }
                //error: erro
            });
            
            return false;
        });
    }*/
    
    //se chamar essa função no onclick do botão do formulario do student_add ela submete mais de uma vez o formulario
    //não descobri o porque ainda
    function salvarAluno(base_url){
        url         = base_url + 'index.php?admin/student/create/';
        var sender  = $('form[name="formulario_add"]');
        var loader  = $('#resposta');
        
        function sucesso(retorno){
            //alert("retornou!" + retorno);
            var result = JSON.parse( retorno );

            if(result.msg == "validacao"){
                loader.fadeIn("fast");
                loader.addClass("alert alert-danger").html("Preencha os campos obrigatórios");
                loader.fadeOut(4000);
                //função que percorre os campos de preenchimento obrigatório
                /*$.each(result.validacao, function(i, item){
                    alert(result.validacao[i]);
               });*/ 
            }else if(result.msg == "erro"){
                alert("Erro ao inserir registro no banco de dados" + result.mensagem );
            }else if(result.msg == "sucesso"){
                alert("Dados cadastrados com sucesso!" + result.result);
                formulario.each (function(){
                    this.reset();
                });
            }                
        }
        
        function erro(data){
            var result = JSON.parse( data );
            alert("erro ao tentar inserir registro");
        }
        
        sender.submit(function(){
            $(this).ajaxSubmit({
                url: url,
                success: sucesso,
                error: erro
            });                        
            return false;
        });
        
        return false;
    }
    
    
    
    
    
    
    function mascara(telefone){ 
        if(telefone.value.length == 0)
          telefone.value = '(' + telefone.value; //quando começamos a digitar, o script irá inserir um parênteses no começo do campo.
        if(telefone.value.length == 3)
           telefone.value = telefone.value + ') '; //quando o campo já tiver 3 caracteres (um parênteses e 2 números) o script irá inserir mais um parênteses, fechando assim o código de área.

      if(telefone.value.length == 8)
          telefone.value = telefone.value + '-'; //quando o campo já tiver 8 caracteres, o script irá inserir um tracinho, para melhor visualização do telefone.
      
      if(telefone.value.length == 12)
          return;

    }
   



