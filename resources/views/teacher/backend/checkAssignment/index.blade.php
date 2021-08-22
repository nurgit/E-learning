@extends('teacher.backend.layouts.master')
@section('page_header',' Check Assignment')
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
            
            <table class="table table-bordered datatable" id="student_table">
                <thead>
                <tr class="replace-inputs">
                    <th>Id</th>
                    <th>Assignment name</th>
                    <th>Courses</th>
                    <th>Instruction</th>
                    <th>Mark</th>
                    <th>Get Mark</th>
                    <th>Dateline</th>
                    <th>Submited Date</th>
                    <th>Download</th>
                    {{-- <th>Action</th> --}}
                    <th> Add Mark</th>


                    
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            
            <div id="update_assignment_modal" class="modal fade"
            role="dialog" tabindex="-1">
           <div class="modal-dialog">

               <!-- Modal content-->
               <form action="{{url('teacher/return_assignments_marking')}}" class="form-horizontal form-groups-bordered validate"
                     method="post" role="form" id="edit_generic_name_form" enctype="multipart/form-data">
                   @csrf
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title" style="text-align: center">Give  Assignmen Mark</h4>

                       <div class="modal-body">

                    </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Give  Mark <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" name="get_mark" id="get_mark"
                                            class="form-control"
                                            data-validate="required"
                                            placeholder=""
                                    
                                    
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Assignment Name <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="assignment_name" id="assignment_name"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                  readonly
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Assignment Instruction <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" name="instruction" id="instruction"
                                        class="form-control"
                                        data-validate="required"
                                        placeholder=""
                               readonly
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Assignment Mark <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" name="mark" id="mark"
                                           class="form-control"
                                           data-validate="required"
                                           placeholder=""
                                           readonly
                                   readonly
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>



                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Dateline <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" name="date" id="date"
                                           class="form-control"
                                           data-validate="required"
                                           placeholder=""
                                   readonly
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Submited Date <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" name="submitin_date" id="submitin_date"
                                           class="form-control"
                                           data-validate="required"
                                           placeholder=""
                                   readonly
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>


                           
                            {{--  --}}
                            {{-- <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Upload File<span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="file" name="file" id="file"
                                        class="form-control"
                                        data-validate="required"
                                        placeholder=""
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div> --}}
                            {{--  --}}



                           <input type="hidden" id="idAssignment" name="idAssignment">
              
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
            {{-- <div id="delete_assignment_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <form action="{{url('teacher/assignment_delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_student_form">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Delete Assignment</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_student"></span> -Assignment Will be Deleted. Are You Sure !! ?
                                </div>
                                <input type="hidden" id="assignmentId" name="assignmentId">
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
            </div> --}}
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
                    "url": '{{url('teacher/get_check_assignments_data')}}',
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

  
        function update_assignment_modal(idAssignment, assignment_name,instruction,mark,get_mark,date,submitin_date,) {
            $('#idAssignment').val(idAssignment);
            $('#assignment_name').val(assignment_name);
            $('#instruction').val(instruction);
            $('#mark').val(mark);
            $('#mget_markark').val(get_mark);
            $('#date').val(date);
            $('#submitin_date').val(submitin_date);
           // $('#file').val(file);
          
            
            $('#update_assignment_modal').modal('show');
        }

        function show_delete_modal(idAssignment, nombre) {
            var x = document.getElementById('delete_student');
            x.innerHTML = nombre;
            $('#assignmentId').val(idAssignment);
            $('#delete_assignment_modal').modal('show');
        }

    </script>
@endsection

