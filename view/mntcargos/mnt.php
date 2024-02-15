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
            <div class="row">
                <div class="col-lg-6">                    
                            <label for="esc_id" class="form-label">Escuela (*)</label>
                        <select class="form-select" data-trigger="" name="esc_id" id="esc_id" placeholder="Seleccionar" required>
                            <option value="">Seleccionar</option>
                        </select>
                    
                </div>
                <div class="col-lg-6">
                    
                        <label for="codigo" class="form-label">Código (*)</label>
                        <input class="form-control" type="text" value="" id="codigo" name="codigo">
                    
                </div>
                <div class="col-lg-12">
                    
                        <label for="asignatura" class="form-label">Asignatura / Cargo (*)</label>
                        <input class="form-control" type="text" value="" id="asignatura" name="asignatura">
                    
                </div>
                <div class="col-lg-3">
                    
                        <label for="id" class="form-label">ID (*)</label>
                        <input class="form-control" type="text" value="" id="id" name="id">
                    
                </div>
                <div class="col-lg-3">
                    
                        <label for="horas" class="form-label">Horas</label>
                        <input class="form-control" type="text" value="" id="horas" name="horas">
                    
                </div>
                <div class="col-lg-6">                    
                            <label for="esc_id" class="form-label">Turno (*)</label>
                        <select class="form-select" data-trigger="" name="esc_id" id="esc_id" placeholder="Seleccionar" required>
                            <option value="">Seleccionar</option>
                            <option value="M">Mañana</option>
                            <option value="T">Tarde</option>
                            <option value="V">Vespertino</option>
                            <option value="M/T">Mañana / Tarde</option>
                        </select>
                    
                </div>
                <div class="col-lg-6">
                    
                        <label for="origen" class="form-label">Origen (*)</label>
                        <input class="form-control" type="text" value="" id="origen" name="origen">
                    
                </div>
                <div class="col-lg-6">
                    
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