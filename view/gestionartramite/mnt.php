<div id="mnt_detalle" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
        <form method="post" id="documento_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="lbltramite"></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                
                <div class="modal-body">
                
                    <div class="row">
                        <input type="hidden" id="doc_id" name="doc_id">
                <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="area_nom" class="form-label">Área</label>
                            <input class="form-control form-control-sm" type="text" value="" id="area_nom" name="area_nom" readonly>   
                        </div>
                </div>
                <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="tra_nom" class="form-label">Trámite</label>
                            <input class="form-control form-control-sm" type="text" value="" id="tra_nom" name="tra_nom" readonly>
                        </div>
                </div> 
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="area_id" class="form-label">Nº Externo</label>
                            <input class="form-control form-control-sm" type="text" value="" id="doc_externo" name="doc_externo" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="tip_nom" class="form-label">Tipo</label>
                            <input class="form-control form-control-sm" type="text" value="" id="tip_nom" name="tip_nom" readonly>
                        </div>
                    </div>  

                    <div class="col-lg-3">
                        <div class="mb-3">
                            <label for="doc_dni" class="form-label">DNI / CUIT</label>
                            <input class="form-control form-control-sm" type="text" value="" id="doc_dni" name="doc_dni" readonly>
                        </div>
                    </div> 
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="doc_nom" class="form-label">Nombre / Razón Social</label>
                            <input class="form-control form-control-sm" type="text" value="" id="doc_nom" name="doc_nom" readonly>
                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label for="doc_descrip" class="form-label">Descripción</label>
                            <textarea class="form-control form-control-sm" type="text" rows="3" value="" id="doc_descrip" name="doc_descrip" readonly></textarea>
                        </div>
                    </div> 
                    <div class="col-lg-12">
                        <label for="doc_descrip" class="form-label">Documentos Adjuntos</label>
                        <table id="listado_table_detalle" class="table table-sm table-bordered dt-responsive  nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha Creación</th>
                                    <th>Usuario</th>
                                    <th>Perfil</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>

                    
                    
                    <div class="col-lg-12">
                    <br />
                        <div class="mb-3">
                            <label for="doc_respuesta" class="form-label">Respuesta (*)</label>
                            <textarea class="form-control form-control-sm" placeholder="Ingrese respuesta del trámite" type="text" rows="3" value="" id="doc_respuesta" name="doc_respuesta" required></textarea>
                        </div>
                    </div> 
                    <div class="col-lg-12">
                    <div class="dropzone">
                            <div class="dz-default dz-message">
                                <button class="dz-button" type="button">
                                    <img src="../../assets/image/upload.png" alt="" />
                                </button>
                                <div class="dz-message" data-dz-message><span>Arrastra y suelta archivos aquí o haz click para seleccionar archivos *.PDF <br> Máximo 5 archivos y solo de 2MB.</span></div>
                            </div>
                        </div>
                    </div>
                    </div>
                                  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" id="btnguardar" class="btn btn-primary waves-effect waves-light">Guardar</button>
                </div>
            
            </div><!-- /.modal-content -->
        </form>
        </div><!-- /.modal-dialog -->
    </div>