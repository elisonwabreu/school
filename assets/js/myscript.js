$(function(){
    
});    

   /* function editarAluno(codigo, formulario){
        //url         = "<?php echo base_url(); ?>" + 'index.php?admin/student/'+codigo+'/do_update/' + codigo;
        url         = "<?php echo base_url(); ?>" + 'index.php?admin/teste';
        formulario  = $('form[name="formulario"]');
        formulario.submit(function(){

            function sucesso(retorno){
                var result = JSON.parse( retorno );
                alert("retornoou legal" + result.dados.al_nome);
                //$('#modal_ajax').modal('hide');
            }   

            $.ajax({
                type: 'POST',
                url: url,
                data: $(this).serialize(),
                success: sucesso,
                error: function(resp){alert("deu merda");}
            });

            /*$.post(url, $(this).serialize(), function(dados){
                   alert(dados);
            });

            return false;
        }); 
    }*/
    
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
   



