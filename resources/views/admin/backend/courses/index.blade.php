@extends('admin.backend.layouts.master')
@section('page_header','Courses')
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
                <button type="button" onclick="jQuery('#add_course_modal').modal('show')" class="btn btn-primary btn-icon icon-left"><i class="entypo-plus"></i>Add Course</button>
            </div>
            <table class="table table-bordered datatable" id="course_table">
                <thead>
                <tr class="replace-inputs">
                    <th>Course Name</th>
                    <th>Course Instructor</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="add_course_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('admin/course_store')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="add_course_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Add Course</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Course Name<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="add_course_name" id="add_course_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Course Instructor <span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <select name="instructor_id" id="instructor_id" data-validate="required">
                                            <option value=""></option>
                                            @if((isset($instructor)))
                                                @foreach($instructor as $irow)
                                                    <option value="{{ $irow->id }}">{{ $irow->teacher_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
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
            <div id="edit_course_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('admin/course_update')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="edit_generic_name_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Edit Course</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Course Name <span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="course_name" id="course_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Course Teacher <span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <select name="course_instructor_id" id="course_instructor_id" data-validate="required">
                                            <option value=""></option>
                                            @if((isset($instructor)))
                                                @foreach($instructor as $row)
                                                    <option value="{{ $row->id }}">{{ $row->teacher_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" id="idCourse" name="idCourse">
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
            <div id="delete_course_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <form action="{{url('admin/course_delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_course_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Delete Course</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_course"></span>  Course Will be Deleted. Are You Sure !! ?
                                </div>
                                <input type="hidden" id="delete_course_id" name="delete_course_id">
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
            initialize_instructor_dropdown();
        });
        function initialise_table() {
            var course_table = jQuery("#course_table");
            course_table.DataTable({
                order: [ [0, 'desc'] ],
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "paging": true,
                "responsive": true,
                dom: 'Bfrtip',
                "ajax": {
                    "type": 'POST',
                    "url": '{{url('admin/get_courses_data')}}',
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
            course_table.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
        function show_edit_modal(idCourse, course_name, course_instructor_id) {
            $('#idCourse').val(idCourse);
            $('#course_name').val(course_name);
            $('#course_instructor_id').select2("val", course_instructor_id, true);
            $('#edit_course_modal').modal('show');
        }
        function show_delete_modal(idCourse, nombre) {
            var x = document.getElementById('delete_course');
            x.innerHTML = nombre;
            $('#delete_course_id').val(idCourse);
            $('#delete_course_modal').modal('show');
        }
        function initialize_instructor_dropdown(){
            $('#course_instructor_id').select2({
                placeholder: 'Select...',
                allowClear: true,
                dropdownParent: $('#edit_course_modal')
            });
            $('#instructor_id').select2({
                placeholder: 'Select...',
                allowClear: true,
                dropdownParent: $('#add_course_modal')
            });
        }
    </script>
@endsection