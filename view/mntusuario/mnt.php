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
                    <input type="hidden" id="usu_id" name="usu_id">

                    <div class="mb-3">
                        <label for="usu_nomape" class="form-label">Nombre y Apellido(*)</label>
                        <input class="form-control" type="text" id="usu_nomape" name="usu_nomape" required>
                    </div>
                    <div class="mb-3">
                        <label for="usu_correo" class="form-label">Correo Electrónico (*)</label>
                        <input class="form-control" type="email" id="usu_correo" name="usu_correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="rol_id" class="form-label">Rol (*)</label>
                        <select class="form-select" data-trigger="" name="rol_id" id="rol_id" placeholder="Seleccionar" required>
                            <option value="">Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnguardar" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
            </div>
    </form>
    </div>
</div>