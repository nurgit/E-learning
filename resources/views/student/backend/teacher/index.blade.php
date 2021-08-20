@extends('student.backend.layouts.master')
@section('page_header','Instructor')
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
                <button type="button" onclick="jQuery('#add_student_modal').modal('show')" class="btn btn-primary btn-icon icon-left"><i class="entypo-plus"></i>Add Student</button>
            </div>
            <table class="table table-bordered datatable" id="student_table">
                <thead>
                <tr class="replace-inputs">
                    <th>Instructor Name</th>
                    <th>Email</th>
                    <th>Courses</th>
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
                    <form action="{{url('admin/teacher_store')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="add_student_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center">Add Course</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Teacher Name<span style="color: red">*</span> </label>
                                    <div class="col-sm-7">
                                        <input type="text" name="add_teacher_name" id="add_teacher_name"
                                               class="form-control"
                                               data-validate="required"
                                               placeholder=""
                                        >
                                        <span id="name_err"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="url" class="col-sm-3 control-label">Email</label>

                                    <div class="col-sm-7">
                                        <textarea class="form-control autogrow" id="add_email" name="add_email" rows="2"
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
            <div id="edit_teacher_modal" class="modal fade"
            role="dialog" tabindex="-1">
           <div class="modal-dialog">

               <!-- Modal content-->
               <form action="{{url('admin/teacher_update')}}" class="form-horizontal form-groups-bordered validate"
                     method="post" role="form" id="edit_generic_name_form">
                   @csrf
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title" style="text-align: center">Edit Course</h4>
                       </div>
                       <div class="modal-body">
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Teacher Name <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="teacher_name" id="teacher_name"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           <div class="form-group">
                               <label for="url" class="col-sm-3 control-label">Course Class</label>

                               <div class="col-sm-7">
                                   <textarea class="form-control autogrow" id="email" name="email" rows="2"
                                             placeholder=""></textarea>
                               </div>
                           </div>

                           <input type="hidden" id="idTeacher" name="idTeacher">
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
            <div id="delete_teacher_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <form action="{{url('admin/teacher_delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_student_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Delete Student</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_student"></span> -Teacher Will be Deleted. Are You Sure !! ?
                                </div>
                                <input type="hidden" id="delete_teacher_id" name="delete_teacher_id">
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
                    "url": '{{url('student/get_teacher_data')}}',
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
        function show_edit_modal(idTeacher, teacher_name, email) {
            $('#idTeacher').val(idTeacher);
            $('#teacher_name').val(teacher_name);
            $('#email').val(email); 
            $('#edit_teacher_modal').modal('show');
        }
        function show_delete_modal(idTeacher, nombre) {
            var x = document.getElementById('delete_student');
            x.innerHTML = nombre;
            $('#delete_teacher_id').val(idTeacher);
            $('#delete_teacher_modal').modal('show');
        }

    </script>
@endsection

