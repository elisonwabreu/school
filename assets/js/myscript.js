$(function(){
    
});    

    function editarAluno(codigo, formulario, codigo_classe, base_url, dados){
       
         /*formulario = $('form[name="formulario"]');
        codigo_classe = $('#txtCodigoClasse').val();
        codigo = $('#txtCodigo').val();*/
        url         = base_url + 'index.php?admin/student/'+codigo+'/do_update/' + codigo;
        //url         = "<?php echo base_url(); ?>" + 'index.php?admin/teste';
    
        //formulario.submit(function(){

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

            
        //});
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
   



