@extends('backend.layouts.master')
@section('page_header','Usuarios')
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
        <li>
            <a href="#"><i class="fa fa-home"></i>{{$main_menu}}</a>
        </li>
                <li class="active">
                    <strong>{{$sub_menu}}</strong>
                </li>
    </ol>
@endsection
@section('page_content')
    @include('backend.error.error_msg')
    
@endsection
@section('page_scripts')
    <script src="{{ asset('backend/assets/js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            initialise_table();
        });
        function initialise_table() {
            var user_table = jQuery("#user_table");

            user_table.DataTable({
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "paging": true,
                "responsive": true,
                dom: 'Bfrtip',
                "ajax": {
                    "type": 'POST',
                    "url": '{{url('users/get_user_data')}}',
                    "data" : {
                        "_token": "{{ csrf_token() }}"
                    },
                },
                buttons: [
                    {
                        extend: 'copyHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-export"></i>Copy Table Data</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'excelHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-download"></i>Download As Excel</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-download"></i>Download As PDF</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2 ]
                        }
                    }
                ]
            });

            // Initalize Select Dropdown after DataTables is created
            user_table.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
        function show_edit_modal(userid, name, email, privilegio ) {
            $('#userid').val(userid);
            $('#user_name').val(name);
            $('#user_email').val(email);
            $('#user_privilegio').val(privilegio);
            $('#edit_user_modal').modal('show');
        }
        function show_delete_modal(userid, name) {
            var x = document.getElementById('delete_user');
            x.innerHTML = name;
            $('#delete_user_id').val(userid);
            $('#delete_user_modal').modal('show');
        }

    </script>
@endsection
