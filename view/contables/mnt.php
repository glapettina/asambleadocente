<!-- sample modal content -->
<div id="mnt_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form method="post" id="mnt_form">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="vacante_id" name="vacante_id">
                <input type="hidden" id="id" name="id">
            <div class="row">                

                <div class="col-lg-12">
                    
                        <label for="docente" class="form-label">Docente</label>
                        <input class="form-control" type="text" value="" id="docente" name="docente">
                    
                </div>
            </div>    
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light">Guardar</button>
            </div>
        </div>
    </form>
    </div>
</div>