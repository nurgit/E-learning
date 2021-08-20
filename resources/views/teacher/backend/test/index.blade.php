@extends('teacher.backend.layouts.master')
@section('page_header','Test')
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
    
@endsection
@section('page_scripts')
            <script type="text/javascript">
                // $(".agregarPago").click(function(){
                //     $("#idventa").val($(this).data("id"))
                //     $("#modal-pagos").modal("show");
                // });

                // $("#cancelar").click(function(){
                //     $("#modal-pagos").modal("hide");
                // });
            </script>
@endsection
