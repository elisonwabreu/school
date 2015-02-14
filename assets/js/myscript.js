$(function(){
    
});    

function formataCampoAluno(){
    $('input[name="al_cep"]').mask("99.999-999");
    $('input[name="al_cpf"]').mask("999.999.999-99");
    $('input[name="al_rg"]').mask("99999999999");
    $('input[name="al_fone"]').mask("(99)9999-9999");
    $('input[name="al_celular"]').mask("(99)9999-9999");
}

function formataCampoProfessor(){
   $('input[name="pr_cep"]').mask("99.999-999");
   $('input[name="pr_cpf"]').mask("999.999.999-99");
   $('input[name="pr_rg"]').mask("99999999999");
   $('input[name="pr_fone"]').mask("(99)9999-9999");
   $('input[name="pr_celular"]').mask("(99)9999-9999"); 
}
  
   



