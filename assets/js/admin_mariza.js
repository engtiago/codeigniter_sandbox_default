$("#cep_endereco").focusout(function(){
    $.ajax({
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        dataType: 'json',
        success: function(resposta){
            $("#logradouro_endereco").val(resposta.logradouro);
            $("#bairro_endereco").val(resposta.bairro);
            $("#complemento_endereco").val(resposta.complemento);
            $("#cidade_endereco").val(resposta.localidade);
            $("#uf_endereco").val(resposta.uf);
            $("#numero_endereco").focus();
        }
    });
});


$(document).ready(function() {

    $('.input-div').hide();
    verificador = true;
    $('[name="mudarselect"]').click(function() {
    if (verificador == true){
            $('.select-div').hide();
        $('.input-div').show();
        verificador=false;
    }else{
        $('.input-div').val('');  
        $('.select-div').show();
        $('.input-div').hide();
        verificador=true;
    }
    })
  });


  $("#cep_sac_atendimento").focusout(function(){
    $.ajax({
        url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
        dataType: 'json',
        success: function(resposta){
            $("#endereco_sac_atendimento").val(resposta.bairro+", "+resposta.logradouro+", Nº: ");
            $("#cidade_sac_atendimento").val(resposta.localidade);
            $("#uf_sac_atendimento").val(resposta.uf);
            $("#endereco_sac_atendimento").focus();
        }
    });
  });