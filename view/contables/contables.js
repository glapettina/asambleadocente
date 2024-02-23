var tabla;

function init(){

    $("#mnt_form").on("submit", function(e){

        guardaryeditar(e);
    });

    $("#mnt_form_favorito").on("submit", function(e){

        marcar(e);
    });
}

function guardaryeditar(e){

    e.preventDefault();

    var formData = new FormData($("#mnt_form")[0]);


    $.ajax({
        url: "../../controller/cargos.php?op=editar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

        console.log(datos);

        if (datos == 2) {
            
            $("#vacante_id").val('');
            $("#mnt_form")[0].reset();

            $("#listado_table").DataTable().ajax.reload();

            $("#mnt_modal").modal('hide');

           Swal.fire({ 
            title: "Asamblea Docente", 
            html: "Se registró con éxito.", 
            icon: "success", 
            confirmButtonColor: "#5156be" 
          });

        }else if (datos == 0) {
            
            Swal.fire({ 
                title: "Asamblea Docente", 
                html: "Registro ya existe, por favor validar.", 
                icon: "error", 
                confirmButtonColor: "#5156be" 
              });
        }/* else if(datos == 2){
            $("#vacante_id").val('');
            $("#mnt_form")[0].reset();

            $("#listado_table").DataTable().ajax.reload();

            $("#mnt_modal").modal('hide');

           Swal.fire({ 
            title: "Asamblea Docente", 
            html: "Se actualizó con éxito.", 
            icon: "success", 
            confirmButtonColor: "#5156be" 
          });
        }  */

        

            
        }
    });

}

function marcar(e){

    e.preventDefault();

    var formData = new FormData($("#mnt_form_favorito")[0]);


    $.ajax({
        url: "../../controller/cargos.php?op=marcar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){

        console.log(datos);

        if (datos == 1) {
            
            $("#vacante_id").val('');
            $("#mnt_form_favorito")[0].reset();

            $("#listado_table").DataTable().ajax.reload();

            $("#mnt_modal_favorito").modal('hide');

           Swal.fire({ 
            title: "Asamblea Docente", 
            html: "Se agregó a favoritos.", 
            icon: "success", 
            confirmButtonColor: "#5156be" 
          });

        } else if (datos == 2) {
            
            Swal.fire({ 
                title: "Asamblea Docente", 
                html: "La vacante ya se encuentra en su lista de favoritos.", 
                icon: "error", 
                confirmButtonColor: "#5156be" 
              });
        } 
    }  
        
    });

}

$(document).ready(function(){

    $.post("../../controller/escuela.php?op=combo", function(data){
        
        $('#esc_id').html(data);
    });

    $.post("../../controller/area.php?op=combo", function(data){
        
        $('#area_id').html(data);
    });

    tabla = $('#listado_table').dataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        "searching": true,
        lengthChange: false,
        colReorder: true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        "ajax":{
            url: '../../controller/contables.php?op=listar',
            type: "get",
            dataType: "json",
            error:function(e){
                console.log(e.responseText);
            },
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplyLength": 10,
        "autoWidth": false,
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    }).DataTable();
});

$(document).on("click", "#btnnuevo", function(){

    $("#vacante_id").val('');
    $("#mnt_form")[0].reset();
    $("#myModalLabel").html('Nuevo Registro');
    $("#mnt_modal").modal('show');
});

function editar(vacante_id){

    $("#myModalLabel").html('Editar Registro');
    $.post("../../controller/cargos.php?op=mostrar_docente", {vacante_id : vacante_id}, function(data){

        data = JSON.parse(data);
        $("#vacante_id").val(data.vacante_id);
        $("#docente").val(data.docente);
        $("#mnt_modal").modal('show');
    });   
}

function eliminar(tra_id){

    Swal.fire({
        title: "Está seguro de eliminar el registro?",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.post("../../controller/tramite.php?op=eliminar", {tra_id : tra_id}, function(data){
                $("#listado_table").DataTable().ajax.reload();
                Swal.fire({ 
                    title: "Mesa de Partes", 
                    html: "Se eliminó con éxito.", 
                    icon: "success", 
                    confirmButtonColor: "#5156be" 
                  });
                
            });   
        } 
      });
}

function favorito(vacante_id){

    $("#myModalLabel").html('Marcar Favorito');
    $.post("../../controller/cargos.php?op=mostrar", {vacante_id : vacante_id}, function(data){

        data = JSON.parse(data);
        $("#vacante_id").val(data.vacante_id);
        $("#area_id").val(data.area_id);
        $("#esc_id").val(data.esc_id);
        $("#codigo").val(data.codigo);
        $("#asignatura").val(data.asignatura);
        $("#id").val(data.id);
        $("#horas").val(data.horas);
        $("#turno").val(data.turno);
        $("#origen").val(data.origen);
        $("#mnt_modal_favorito").modal('show');
    });   
}


init();