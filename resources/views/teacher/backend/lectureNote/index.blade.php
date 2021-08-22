@extends('teacher.backend.layouts.master')
@section('page_header','Lecture Note')
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
                    <th> Id</th>
                    <th>Note name</th>
                    <th>Courses</th>
                    <th>Note</th>
                    <th>Uploted Date</th>
                    <th>Action</th>
               


                    
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div id="add_assignment_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <form action="{{url('teacher/lectureNote_uoload')}}" class="form-horizontal form-groups-bordered validate"
                    method="post" role="form" id="add_student_form" enctype="multipart/form-data">
                  @csrf
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title" style="text-align: center">Add Lecture Note</h4>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                              <label for="" class="col-sm-3 control-label">Note Name <span style="color: red">*</span> </label>
                              <div class="col-sm-7">
                                  <input type="text" name="add_note_name" id="add_note_name"
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
                                {{-- <input type="text" name="note_name" id="note_name"
                                       class="form-control"
                                       data-validate="required"
                                       placeholder=""
                               
                                > --}}

                                <select  aria-label="Default select example" class="form-control" name="course_id"id="course_id">
                                    {{-- <option>Please choose a course</option> --}}
                                    @foreach ($get_course as $courses)
                                    <option value="{{$courses->id}}">{{$courses->course_name}}</option>
                                    @endforeach
                                  
                                </select>
                                <span id="name_err"></span>
                            </div>
                        </div>
                          <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Note <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   {{-- <input type="text" name="add_instruction" id="add_instruction"
                                       class="form-control"
                                       data-validate="required"
                                       placeholder=""
                              
                                   > --}}
                                   <textarea id="add_note" name="add_note" class="form-control" >

                                </textarea>
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           {{-- <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Mark <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="add_mark" id="add_mark"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                        
                                  
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div> --}}
                           {{-- <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Retarn date <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="date" name="add_date" id="add_date"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                  
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div> --}}
                          
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



                          {{-- <input type="hidden" id="idLectureNote" name="idLectureNote"> --}}
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
            <div id="update_LectureNite_modal" class="modal fade"
            role="dialog" tabindex="-1">
           <div class="modal-dialog">

               <!-- Modal content-->
               <form action="{{url('teacher/lectureNote_update')}}" class="form-horizontal form-groups-bordered validate"
                     method="post" role="form" id="edit_generic_name_form" enctype="multipart/form-data">
                   @csrf
                   <div class="modal-content">
                       <div class="modal-header">
                           <h4 class="modal-title" style="text-align: center">Update Lecture Note</h4>
                       </div>
                       <div class="modal-body">
                           <div class="form-group">
                               <label for="" class="col-sm-3 control-label">Lecture Note Name <span style="color: red">*</span> </label>
                               <div class="col-sm-7">
                                   <input type="text" name="note_name" id="note_name"
                                          class="form-control"
                                          data-validate="required"
                                          placeholder=""
                                  
                                   >
                                   <span id="name_err"></span>
                               </div>
                           </div>
                           <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Note <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    {{-- <input type="text" name="note" id="note"
                                        class="form-control"
                                        data-validate="required"
                                        placeholder=""
                               
                                    > --}}
                                    <textarea id="note" name="note" class="form-control" >

                                    </textarea>
                                    <span id="name_err"></span>
                                </div>
                            </div>

                            {{-- <div class="form-group">
                                <label for="" class="col-sm-3 control-label">Uploted date <span style="color: red">*</span> </label>
                                <div class="col-sm-7">
                                    <input type="date" name="date" id="date"
                                           class="form-control"
                                           data-validate="required"
                                           placeholder=""
                                   
                                    >
                                    <span id="name_err"></span>
                                </div>
                            </div> --}}
                           
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



                           <input type="hidden" id="idLectureNote" name="idLectureNote">
                           <input type="hidden" id="p_file" name="p_file">
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
            <div id="delete_lectureNole_modal" class="modal fade"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog">


                    <!-- Modal content-->
                    <form action="{{url('teacher/lectureNote_delete')}}" class="form-horizontal form-groups-bordered validate"
                          method="post" role="form" id="delete_lectureNole_modal">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" style="text-align: center; color: #00ffea" >Delete Assignment</h4>
                            </div>
                            <div class="modal-body">
                                <div style="text-align: center">
                                    <span id="delete_lectureNote"></span> -Lecture Note  Will be Deleted. Are You Sure !! ?
                                </div>
                                <input type="hidden" id="dlt_idLectureNote" name="dlt_idLectureNote">
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
                    "url": '{{url('teacher/get_lecture_notes_data')}}',
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

  
        function update_LectureNite_modal(idLectureNote, note_name,note,date) {
            $('#idLectureNote').val(idLectureNote);
            $('#note_name').val(note_name);
            $('#note').val(note);
            $('#date').val(date);
           // $('#p_file').val(p_file);

            $('#update_LectureNite_modal').modal('show');
        }

        function show_delete_modal(idLectureNote, nombre) {
            var x = document.getElementById('delete_lectureNote');
            x.innerHTML = nombre;
            $('#dlt_idLectureNote').val(dlt_idLectureNote);
            $('#delete_lectureNole_modal').modal('show');
        }

    </script>
@endsection

