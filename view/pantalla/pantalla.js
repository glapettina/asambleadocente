var tabla;

function init(){

    /* setInterval(function () {
        $('#listado_table').reload();
    }, 2000); */

}



$(document).ready(function() {
   
    $.post("../../controller/pantalla.php?op=comboarea", function(data){

        $('#area_id').html(data);
    });
    
    $("#area_id").change(function(){

        $("#area_id").each(function(){

            area_id = $(this).val();

            tabla = $('#listado_table').dataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                "searching": true,
                lengthChange: false,
                colReorder: true,
                
                "ajax":{
                    url: '../../controller/pantalla.php?op=listar',
                    type: "post",
                    data: {area_id : area_id},
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
            

            setInterval( function () {
                $('#listado_table').DataTable().ajax.reload( null, false ); // user paging is not reset on reload
            }, 5000 );

            
        })
        
    });

   
});


init();