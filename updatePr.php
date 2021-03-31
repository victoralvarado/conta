<div class="modal fade" id="edit_<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php ?>
                <form method="POST" action="controller/productocontroller.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Nombre</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="nombre" name="nombre" placeholder="Nombre del producto" class="form-control" required="true" value="<?php echo $value['nombre']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Existencias</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="existencias" name="existencias" placeholder="Existencias" min="1" class="form-control" required="true" value="<?php echo $value['existencias']; ?>" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Precio</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="precio" name="precio" placeholder="Precio" min="1.00" step="any" class="form-control" required="true" value="<?php echo $value['precio']; ?>" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Costo</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="costo" name="costo" placeholder="Costo" min="1.00" step="any" class="form-control" required="true" value="<?php echo $value['costo']; ?>" type="number"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Descripción</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><textarea id="descripcion" name="descripcion" placeholder="Descripción" class="form-control" rows="2"><?php echo $value['descripcion']; ?></textarea></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Imagen</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="imagen" name="imagen" class="form-control" accept="image/*" type="file">
                            <div class="alert alert-info" role="alert">
                            Si no agrega una imagen nueva, se mantendra la imagen actual</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Codigo</label>
                        <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><input id="codigo" name="codigo" placeholder="Codigo del producto" class="form-control" required="true" value="<?php echo $value['codigo']; ?>" type="text"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input id="img" name="img" class="form-control" required="true" value="<?php echo $value['imagen']; ?>" type="hidden">
                        <input id="id" name="id" min="1" class="form-control" required="true" value="<?php echo $value['id']; ?>" type="hidden">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="editarProducto" name="editarProducto" class="btn btn-primary"">Editar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>