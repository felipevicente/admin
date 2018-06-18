$("body").on("click","#btn_excluir",function(){
    var id = $(this).closest('tr').find('td:eq(0)').text();
    var c_obj = $(this).parents("tr");
    //alert(id);
    $.ajax({
        dataType: 'json',
        type:'POST',
        /*url: 'http://localhost/jquerymobile/cadastro/cadastro_usuario.php?funcao=cadastrar',*/
        url: 'http://localhost/admin/fc/verify/verify_usuario.php?funcao=deletar',
        data:{id:id}
    }).done(function(data){
        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();
    });

});