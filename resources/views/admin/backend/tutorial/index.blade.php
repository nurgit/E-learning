@extends('admin.backend.layouts.master')
@section('page_header','Tutorials')
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
@section('page_content')
    @include('backend.error.error_msg')
    <div class="panel panel-primary" data-collapsed="0">
        <div class="panel-body">
            <div class="form-group">
                <button type="button" onclick="jQuery('#add_tutorial_modal').modal('show')" class="btn btn-primary btn-icon icon-left"><i class="entypo-plus"></i>Add Tutorial</button>
            </div>
            <table class="table table-bordered datatable" id="tutorial_table">
                <thead>
                <tr class="replace-inputs">
                    <th>#</th>
                    <th>Tutorial_name</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="add_tutorial_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('admin/tutorial_store')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="add_tutorial_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Add Tutorial</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Tutorial Name<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="add_tutorial_name" id="add_tutorial_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Subject<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="add_sbject_name" id="add_subjcet_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Upload File<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="file" name="tutorial_file" id="tutorial_file"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
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
            <div id="edit_tutorial_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('admin/tutorial_update')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="edit_generic_name_form" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Edit Course</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Tutorial Name <span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="update_tutorial_name" id="update_tutorial_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Subject<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="update_subject_name" id="update_subject_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Upload File<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="file" name="update_tutorial_file" id="update_tutorial_file"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>

                                <input type="hidden" id="idTutorial" name="idTutorial">
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
            <div id="delete_tutorial_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <form action="{{url('admin/tutorial_delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_tutorial_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Delete Tutorisl</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_tutorial"></span>  Tutorial Will be Deleted. Are You Sure !!
                                </div>
                                <input type="hidden" id="delete_tutorial_id" name="delete_tutorial_id">
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
            var tutorial_table = jQuery("#tutorial_table");

            tutorial_table.DataTable({
                order: [ [0, 'desc'] ],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "paging": true,
                "responsive": true,
                dom: 'Bfrtip',
                "ajax": {
                    "type": 'POST',
                    "url": '{{url('admin/get_tutorials_data')}}',
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
            tutorial_table.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
        function show_edit_modal(idTutorial, update_tutorial_name, update_subject_name ) {
            $('#idTutorial').val(idTutorial);
            $('#update_tutorial_name').val(update_tutorial_name);
            $('#update_subject_name').val(update_subject_name);
            $('#edit_tutorial_modal').modal('show');
        }
        function show_delete_modal(idCourse, nombre) {
            var x = document.getElementById('delete_tutorial');
            x.innerHTML = nombre;
            $('#delete_tutorial_id').val(idCourse);
            $('#delete_tutorial_modal').modal('show');
        }
    </script>
@endsection
