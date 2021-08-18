@extends('backend.layouts.master')
@section('page_header','Proveedores')
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
            var provider_table = jQuery("#provider_table");

            provider_table.DataTable({
                "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                "bStateSave": false,
                "paging": true,
                "responsive": true,
                dom: 'Bfrtip',
                "ajax": {
                    "type": 'POST',
                    "url": '{{url('providers/get_provider_data')}}',
                    "data" : {
                        "_token": "{{ csrf_token() }}"
                    },
                },
                buttons: [
                    {
                        extend: 'copyHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-export"></i>Copy Table Data</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4 ]
                        }
                    },
                    {
                        extend: 'excelHtml5', text: '<a><button class="btn btn-primary btn-icon icon-left"><i class="entypo-download"></i>Download As Excel</button></a>',
                        title: "Client List",
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4 ]
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
            provider_table.closest('.dataTables_wrapper').find('select').select2({
                minimumResultsForSearch: -1
            });
        }
        function show_edit_modal(id, name, email, direction, contact, telefono, colonia, codigopostal, estado, pais, rfc ) {
            $('#provider_id').val(id);
            $('#provider_name').val(name);
            $('#provider_email').val(email);
            $('#provider_domicilio').val(direction);
            $('#provider_contacto').val(contact);
            $('#provider_telefono').val(telefono);
            $('#provider_colonia').val(colonia);
            $('#provider_codigopostal').val(codigopostal);
            $('#provider_estado').val(estado);
            $('#provider_pais').val(pais);
            $('#provider_rfc').val(rfc);
            $('#edit_provider_modal').modal('show');
        }
        function show_delete_modal(providerid, name) {
            var x = document.getElementById('delete_provider');
            x.innerHTML = name;
            $('#delete_provider_id').val(providerid);
            $('#delete_provider_modal').modal('show');
        }

    </script>
@endsection
