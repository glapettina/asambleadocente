var tabla;

function init(){

    $("#mnt_form").on("submit", function(e){

        guardaryeditar(e);
    });
}

function guardaryeditar(e){

    e.preventDefault();

    var formData = new FormData($("#mnt_form")[0]);


    $.ajax({
        url: "../../controller/escuela.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos){


        if (datos == 1) {
            
            $("#esc_id").val('');
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
        }else if(datos == 2){
            $("#esc_id").val('');
            $("#mnt_form")[0].reset();

            $("#listado_table").DataTable().ajax.reload();

            $("#mnt_modal").modal('hide');

           Swal.fire({ 
            title: "Asamblea Docente", 
            html: "Se actualizó con éxito.", 
            icon: "success", 
            confirmButtonColor: "#5156be" 
          });
        } 

        

            
        }
    });

}

$(document).ready(function(){

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
            url: '../../controller/escuela.php?op=listar',
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

    $("#esc_id").val('');
    $("#mnt_form")[0].reset();
    $("#myModalLabel").html('Nuevo Registro');
    $("#mnt_modal").modal('show');
});

function editar(esc_id){

    $("#myModalLabel").html('Editar Registro');
    $.post("../../controller/escuela.php?op=mostrar", {esc_id : esc_id}, function(data){

        data = JSON.parse(data);
        $("#esc_id").val(data.esc_id);
        $("#esc_nom").val(data.esc_nom);
        $("#esc_loc").val(data.esc_loc);
        $("#mnt_modal").modal('show');
    });   
}

function eliminar(esc_id){

    Swal.fire({
        title: "Está seguro de eliminar el registro?",
        icon: "question",
        showDenyButton: true,
        confirmButtonText: "Si",
        denyButtonText: `No`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.post("../../controller/escuela.php?op=eliminar", {esc_id : esc_id}, function(data){
                $("#listado_table").DataTable().ajax.reload();
                Swal.fire({ 
                    title: "Asamblea Docente", 
                    html: "Se eliminó con éxito.", 
                    icon: "success", 
                    confirmButtonColor: "#5156be" 
                  });
                
            });   
        } 
      });
}

/* function permiso(rol_id){

    tabla_permiso = $('#listado_table_permiso').dataTable({
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
            url: '../../controller/rol.php?op=permiso',
            type: "post",
            data: {rol_id : rol_id},
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
    $("#mnt_modal_permiso").modal('show');
}

function habilitar(mend_id){

    $.post("../../controller/rol.php?op=habilitar", {mend_id : mend_id}, function(data){

        $("#listado_table_permiso").DataTable().ajax.reload();
        
    });   
}

function deshabilitar(mend_id){
    
    $.post("../../controller/rol.php?op=deshabilitar", {mend_id : mend_id}, function(data){

        $("#listado_table_permiso").DataTable().ajax.reload();
        
    });   
} */

init();