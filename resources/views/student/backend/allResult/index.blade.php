@extends('student.backend.layouts.master')
@section('page_header','All Result')
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
                    <th> Id</th>
                    <th>Note name</th>
                    <th>Courses</th>
                    <th>Note</th>
                    <th>Uploted Date</th>
                    <th>Dowmload</th>
               


                    
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>

           
            


              
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
                    "url": '{{url('student/get_notes_data')}}',
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

        function show_delete_modal(dlt_idLectureNote, nombre) {
            var x = document.getElementById('delete_lectureNote');
            x.innerHTML = nombre;
            $('#dlt_idLectureNote').val(dlt_idLectureNote);
            $('#delete_lectureNole_modal').modal('show');
        }

    </script>
@endsection

