$(document).ready(function() {

  var dataTable = $('#tb_lista_usuario').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : false,
        'info'        : true,
        'autoWidth'   : true
    });

  display_form();

  function display_form(){

    var display = localStorage.getItem("display_valor");

    if (display === "true"){
      $('#div_form_busca_avancada').removeClass('dis-none');
      $('#icon_busca').removeClass('fa-search-plus');
      $('#icon_busca').addClass('fa-search-minus');
    } else {
      $('#div_form_busca_avancada').addClass('dis-none');
      $('#icon_busca').removeClass('fa-search-minus');
      $('#icon_busca').addClass('fa-search-plus');
    }

    let searchParams = new URLSearchParams(window.location.search);
    var tipo_busca = searchParams.get('tipo_busca');
    var busca = searchParams.get('busca');
    if(tipo_busca ||  busca){
      $("#tipo_busca").val(tipo_busca);
      $("#ipt_busca_avancada").val(busca);
      $("#ipt_busca_avancada").focus();
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

  $(document).on('click', '.delete', function() {
        var id_usuario = $(this).attr("id");

        swal({
            title: "",
            text: "Deseja excluir registro?",
            type: "warning",
            confirmButtonColor: "#dd4b39",
            confirmButtonText: "Excluir",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            cancelButtonColor: "#D73925",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                url: "ajax/delete.php",
                method: "POST",
                data: {
                    id_usuario: id_usuario
                },
                success: function(data) {
                    if(data === "true"){
                        swal("Registro Excluido!", "", "success");
                        $("#"+id_usuario).remove();
                    } 
                    if(data ==="false") {
                        swal("Erro ao Excluir!", "", "alert");
                    }
                }
            });
        });

    });

    $('#btn_alterar_senha').click(function(){
               $.ajax({
                    url: 'ajax/alterar_senha.php',
                    method: 'POST',
                    dataType: 'json',
                    async: true,
                    data: $("#form_alterar_senha").serialize(),
                    success: function(data){
                        switch(data){
                            case "true":
                                msg_alerta("Cadastrado realizado com sucesso!");
                                break;
                            case "false":
                                msg_alerta("Erro ao cadastrar!");
                                break;
                            case "existe":
                                msg_alerta("Email já cadastrado!");
                                break;
                        }
                    }
                });
        });
});