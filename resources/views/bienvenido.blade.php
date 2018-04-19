<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CRSF-TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- JQUERY -->
        <script src="js/jquery.min.js"></script>
        <!-- BOOTSTRAP -->
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- FONT AWESOME -->
        <script src="js/font-awesome.js"></script>

        <title>Test - CRUD en Laravel</title>
    </head>
    <body>
        <!-- MODALS -->
        <!-- MODAL CREAR USUARIO-->
        <div id="crear_usuario" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title">Creación de Usuarios</h4>
              </div>
              <div class="modal-body">
                    <div class="form-group">
                        <span><b>Nombre</b></span>
                        <input type="text" id="user_name_crea" class="form-control">
                    </div>
                     <div class="form-group">
                        <span><b>Apellido</b></span>
                        <input type="text" id="user_ape_crea" class="form-control">
                    </div>
                     <div class="form-group">
                        <span><b>Fono</b></span>
                        <input type="text" id="user_fono_crea" class="form-control">
                    </div>
              </div>
              <div class="modal-footer">
                <div align="center">
                    <button type="button" class="btn btn-success" id="create_user">Crear</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="exit_create_user">Cancelar</button>
                    <div class="alert alert-success" style="display: none" id="alert_ucrea">
                      <strong>¡Usuario Creado!</strong>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- MODAL MODIFICAR USUARIO-->
        <div id="modificar_usuario" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">

            <div class="modal-content">
              <div class="modal-header">
                <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                <h4 class="modal-title">Modificación de Usuarios</h4>
              </div>
                <div class="modal-body">
                    <div class="form-group">
                        <span><b>Nombre</b></span>
                        <input type="text" id="user_name_modif" class="form-control">
                    </div>
                     <div class="form-group">
                        <span><b>Apellido</b></span>
                        <input type="text" id="user_ape_modif" class="form-control">
                    </div>
                     <div class="form-group">
                        <span><b>Fono</b></span>
                        <input type="text" id="user_fono_modif" class="form-control">
                    </div>
                 </div>
              <div class="modal-footer">
                <div align="center">
                    <button type="button" class="btn btn-success" id="mod_user">Modificar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="exit_mod_user">Cancelar</button>
                    <div class="alert alert-success" style="display: none" id="alert_umod">
                      <strong>¡Usuario Modificado!</strong>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- MODAL DESHABILITAR USUARIO-->
        <div id="deshabilitar_usuario" class="modal fade" role="dialog">
          <div class="modal-dialog modal-sm">

            <div class="modal-content">
              <div class="modal-body" align="center">
                <h5>¿Deseas deshabilitar a este usuario?</h5>
              </div>
              <div class="modal-footer">
                <div align="center">
                    <button type="button" class="btn btn-success" id="desh_user">Aceptar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="exit_desh_user">Cancelar</button>
                    <div class="alert alert-success" style="display: none" id="alert_udesh">
                      <strong>¡Usuario Deshabilitado!</strong>
                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        
        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">Test</a>
            </div>
            <div class="navbar-form navbar-left">
              <div class="form-group">
                <input type="text" id="text_search" class="form-control" placeholder="¿Qué desea buscar?" onkeyup="buscar_usuario()">
              </div>
              <select class="form-control" id="select_filter" title="Escoja una opción y comience a escribir su búsqueda.">
                  <option value="0">Escoja una opción <i class="fas fa-caret-down fa-1px"></i></option>
                  <option value="1">Nombre</option>
                  <option value="2">Apellido</option>
                  <option value="3">Fono</option>
              </select>
              <button type="submit" class="btn btn-success" data-toggle='modal' data-target='#crear_usuario'><i class="fas fa-plus"></i> Crear Usuario</button>
            </div>
          </div>
        </nav>

        <div class="container">
            <div class="col-md-12">
                <table id="listado_usuarios" class="table">
                    <tr align="center">
                        <td>
                            <b>Nombre</b>
                        </td>
                        <td>
                           <b>Apellido</b>
                        </td>
                        <td>
                            <b>Fono</b>
                        </td>
                        <td>
                            <b>Acción</b>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </body>
    <script type="text/javascript" src="js/main.js"></script>
</html>
