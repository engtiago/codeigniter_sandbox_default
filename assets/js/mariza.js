// When the user scrolls the page, execute myFunction 
window.onscroll = ()=> {myFunction()};

// Get the header
var header = document.getElementById("header");


// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > 30) {
    header.classList.add("bg-navbar-new");
     header.classList.remove("bg-navbar-transparent");
  } else {
     header.classList.remove("bg-navbar-new");
     header.classList.add("bg-navbar-transparent");
  }
}


$("#cep_curriculo").focusout(function(){
  $.ajax({
      url: 'https://viacep.com.br/ws/'+$(this).val()+'/json/unicode/',
      dataType: 'json',
      success: function(resposta){
          $("#endereco_curriculo").val(resposta.bairro+", "+resposta.logradouro+", Nº: ");
          $("#cidade_curriculo").val(resposta.localidade);
          $("#uf_curriculo").val(resposta.uf);
          $("#endereco_curriculo").focus();
      }
  });
});



  