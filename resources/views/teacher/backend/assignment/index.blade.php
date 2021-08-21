@extends('teacher.backend.layouts.master')
@section('page_header','Assignment')
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
                <button type="button" onclick="jQuery('#add_assignment_modal').modal('show')" class="btn btn-primary btn-icon icon-left"><i class="entypo-plus"></i>Add Instructor</button>
            </div>
            <table class="table table-bordered datatable" id="student_table">
                <thead>
                <tr class="replace-inputs">
                    <th>Assignment Id</th>
                    <th>Assignment name</th>
                    <th>Courses</th>
                    <th>Instruction</th>
                    <th>Mark</th>
                    <th>Return Date </th>
                    {{-- <th>Action</th> --}}
                    <th> Acction</th>


                    
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="add_assignment_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('teacher/assignment_uoload')}}" class="form-horizontal form-groups-bordered validate"
                    method="post" role="form" id="add_student_form" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" style="text-align: center">Add Assignment</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="" class="col-sm-3 control-label">Assignment Name <span style="color: red">*</span> </label>
                              <div class="col-sm-7">
                                  <input type="text" name="add_assignment_name" id="add_assignment_name"
                                         class="form-control"
                                         data-validate="required"
                                         placeholder=""
                                 
                                  >
                                  <span id="name_err"></span>
                              </div>
                          </div>

                          <div class="form-group">
                            <label for="" class="col-sm-3 control-label">Course <span style="color: red">*</span> </label>
                            <div class="col-sm-7">
                                {{-- <input type="text" name="assignment_name" id="assignment_name"
                                       class="form-control"
                                       data-validate="required"
                                       placeholder=""
                               
                                > --}}

                                <select  aria-label="Default select example" class="form-control" name="course_id"id="course_id">
                                    <option selectedname="course" id="course">Please choose a course</option>
                                    @foreach ($get_course as $courses)
                                    <option value="{{$courses->id}}">{{$courses->course_name}}</option>
                                    @endforeach
                                  
                                </select>
                                <span id="name_err"></span>
                            </div>
                        </div>
                          <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Instruction <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="add_instruction" id="add_instruction"
                                       class="form-control"
                                       data-validate="required"
                                       placeholder=""
                              
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Mark <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="add_mark" id="add_mark"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                        
                                  
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Retarn date <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="date" name="add_date" id="add_date"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                  
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                          
                           {{--  --}}
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Upload File<span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="file" name="add_file" id="add_file"
                                       class="form-control"
                                       data-validate="required"
                                       placeholder=""
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           {{--  --}}



                          {{-- <input type="hidden" id="idAssignment" name="idAssignment"> --}}
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
            <div id="update_assignment_modal" class="modal fade"
            role="dialog" tabindex="-1">
           <div class="modal-dialog">

               <!-- Modal content-->
               <form action="{{url('student/assignment_update')}}" class="form-horizontal form-groups-bordered validate"
                     method="post" role="form" id="edit_generic_name_form" enctype="multipart/form-data">
                   @csrf
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title" style="text-align: center">Update Assignment</h4>
                       </div>
                       <div class="modal-body">
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Assignment Name <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="assignment_name" id="assignment_name"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                  
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
                                
                                   
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Assignment submition date <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="text" name="date" id="date"
                                           class="form-control"
                                           data-validate="required"
                                           placeholder=""
                                   
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
                           
                            {{--  --}}
                            <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Upload File<span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="file" name="file" id="file"
                                        class="form-control"
                                        data-validate="required"
                                        placeholder=""
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div>
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
                    "url": '{{url('teacher/get_assignments_data')}}',
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

  
        function update_assignment_modal(idAssignment, assignment_name,instruction,mark,date) {
            $('#idAssignment').val(idAssignment);
            $('#assignment_name').val(assignment_name);
            $('#instruction').val(instruction);
            $('#mark').val(mark);
            $('#date').val(date);
            // $('#file').val(file);

            $('#update_assignment_modal').modal('show');
        }

        function show_delete_modal(idAssignment, nombre) {
            var x = document.getElementById('delete_student');
            x.innerHTML = nombre;
            $('#delete_teacher_id').val(idAssignment);
            $('#delete_teacher_modal').modal('show');
        }

    </script>
@endsection

