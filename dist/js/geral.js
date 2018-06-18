$(document).ready(function() {

  display_form();

  function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
    //$("#ipt_busca_avancada").val(sParameterName);
  };

  /*var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
  };*/
  //var busca = getUrlParameter('busca');
  //alert(getUrlParameter('busca'));
  getUrlParameter();

  function display_form(){

    var display = localStorage.getItem("display_valor");
    //var busca = searchParams.get("busca").
    

    if (display === "true"){
      $('#div_form_busca_avancada').removeClass('dis-none');
      $('#icon_busca').removeClass('fa-search-plus');
      $('#icon_busca').addClass('fa-search-minus');
    } else {
      $('#div_form_busca_avancada').addClass('dis-none');
      $('#icon_busca').removeClass('fa-search-minus');
      $('#icon_busca').addClass('fa-search-plus');
    }
  }

  $("#btn_busca_avancada").click(function() {
    var busca_invisivel = $('#div_form_busca_avancada').hasClass('dis-none');
    
    if(busca_invisivel == true){
      localStorage.setItem("display_valor", true);
      display_form();
    } else {
      localStorage.setItem("display_valor", false);
      display_form()
    }
  });
});