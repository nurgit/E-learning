@extends('student.backend.layouts.master')
@section('page_header','Inicio')
@section('page_links')
    <link rel="stylesheet" href="{{ asset('backend/assets/js/datatables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/js/select2/select2.css') }}">
    <style>
        .page-body .select2-drop {z-index: 10052;}
        .select2-drop-mask {z-index: 10052;}
        .datepicker.datepicker-dropdown{
            z-index: 10052 !important;
        }
    </style>
@endsection
@section('page_breadcrumb')
    <ol class="breadcrumb bc-3" >
        <li class="active">
            <a href="#"><i class="fa fa-home"></i></a>
        </li>
{{--                <li class="active">--}}
{{--                    <strong>{{$sub_menu}}</strong>--}}
{{--                </li>--}}
    </ol>
@endsection
@section('page_content')
    @include('backend.error.error_msg')
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
            <div class="form-group">
                <button type="button" onclick="jQuery('#add_student_modal').modal('show')" class="btn btn-primary btn-icon icon-left"><i class="entypo-plus"></i>Agregar nueva studente</button>
            </div>
            <table class="table table-bordered datatable" id="student_table">
                <thead>
                <tr class="replace-inputs">
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="add_student_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('student/store')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="add_student_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Add student</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Name<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="Name" id="name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">E-mail</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="telefono" name="telefono" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="add_btn">Save</button>
                                <button type="button" class="btn btn-white"
                                        data-dismiss="modal">Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="edit_student_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('student/update')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="edit_generic_name_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Edit Client</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Name <span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="student_nombre" id="student_nombre"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Telefono</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_telefono" name="student_telefono" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Correo</label>

                                    <div class="col-sm-7">
                                        <input type="email" name="student_correo" id="student_correo"
                                               class="form-control"
                                               placeholder=""
                                        >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Estado</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_estado" name="student_estado" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">País</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_pais" name="student_pais" rows="2"
                                                  placeholder="Ex: Mexico"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Domicilio</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_domicilio" name="student_domicilio" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">C.P</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_codigopostal" name="student_codigopostal" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Colonia</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_colonia" name="student_colonia" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Celular</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_celular" name="student_celular" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">RFC</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_rfc" name="student_rfc" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Contacto</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_contacto" name="student_contacto" rows="2"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Comentarios</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="student_comentarios" name="student_comentarios" rows="4"
                                                  placeholder=""></textarea>
                                    </div>
                                </div>

                                <input type="hidden" id="idstudentes" name="idstudentes">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="edit_btn">Update</button>
                                <button type="button" class="btn btn-white"
                                        data-dismiss="modal">Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div id="delete_student_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('student/delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_student_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Eliminar studente</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_student"></span> El studente será eliminado. Está seguro?
                                </div>
                                <input type="hidden" id="delete_student_id" name="delete_student_id">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success" id="delete_btn">Delete</button>
                                <button type="button" class="btn btn-white"
                                        data-dismiss="modal">Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="{{ asset('backend/assets/js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            initialise_table();
        });
        function initialise_table() {
            var student_table = jQuery("#student_table");

            student_table.DataTable({
                order: [ [0, 'desc'] ],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "paging": true,
                "responsive": true,
                dom: 'Bfrtip',
                "ajax": {
                    "type": 'POST',
                    "url": '{{url('admin/get_student_data')}}',
                    "data" : {
                        "_token": "{{ csrf_token() }}"
                    },
                },
                buttons: [
                    {
                        extend: 'copyHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-export"></i>Copy Table Data</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'excelHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-download"></i>Download As Excel</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    },
                    {
                        extend: 'pdfHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-download"></i>Download As PDF</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ]
            });

            // Initalize Select Dropdown after DataTables is created
            student_table.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
        function show_edit_modal(idstudentes, nombre, telefono, correo, estado, pais, domicilio, codigopostal, colonia, celular,  rfc, contacto,  comentarios) {
            $('#idstudentes').val(idstudentes);
            $('#student_nombre').val(nombre);
            $('#student_telefono').val(telefono);
            $('#student_correo').val(correo);
            $('#student_estado').val(estado);
            $('#student_pais').val(pais);
            $('#student_domicilio').val(domicilio);
            $('#student_codigopostal').val(codigopostal);
            $('#student_colonia').val(colonia);
            $('#student_celular').val(celular);
            $('#student_rfc').val(rfc);
            $('#student_contacto').val(contacto);
            $('#student_comentarios').val(comentarios);
            $('#edit_student_modal').modal('show');
        }
        function show_delete_modal(idstudentes, nombre) {
            var x = document.getElementById('delete_student');
            x.innerHTML = nombre;
            $('#delete_student_id').val(idstudentes);
            $('#delete_student_modal').modal('show');
        }

    </script>
@endsection
