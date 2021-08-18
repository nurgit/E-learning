@extends('backend.layouts.master')
@section('page_header','POS')
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
    </ol>
@endsection
@section('page_content')
    @include('backend.error.error_msg')

    
@endsection
@section('page_scripts')
    <script src="{{ asset('backend/assets/js/datatables/datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2/select2.min.js') }}"></script>
    <script type="text/javascript">
        function actualizarSaldos(){
            var total = 0;
            $(".totalArticulo").each(function(){
                total += parseFloat( $(this).html() );
            });

            $("#subtotal").html(total);
            $("#subtotalOculto").val(total);

            if ( $("#descuento").val() != "0"){
                var descuento 	= $("#descuento").val();
                var total2 		= $("#subtotalOculto").val();
                //var result = (descuento / 100) * total2;

                $("#total").html( total2 - descuento );
            } else {
                $("#total").html(total);
            }

        }
        jQuery(document).ready(function ($) {
            $("#cliente").select2({
                placeholder: 'Select...',
                allowClear: true
            }).on('change', function()
            {
                var client_id = $(this).val();
                console.log(client_id);
                // Adding Custom Scrollbar
                //$(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
            });
            $("#articulo").select2({
                placeholder: 'Select...',
                allowClear: true
            }).on('change', function()
            {
                var article_id = $(this).val();
                    console.log(article_id);
                $.ajax({
                    type : 'get',
                    url : '{{ url("pos/get_article_data") }}',
                    data : {'id':article_id},
                    datatype: 'json',
                    success:function(data){
                        //console.log(data[0].precio);
                        var id= data[0].idarticulos;
                        var nuevaFila = '<tr>'+
                            '<td>'+data[0].articulo+
                            '<input type="hidden" name="idarticulo[]" value="'+id+'">'+
                            '</td>'+
                            '<td class="text-right v-middle"><input type="text" name="precio[]" id="precio_'+id+'" data-id="'+id+'" value="'+data[0].precio+'" class="form-control precioArticulo text-right"></td>'+
                            '<td class="text-right v-middle"><input type="text" step="1" name="cantidad[]" value="1" id="cantidad_'+id+'" data-id="'+id+'" class="form-control cantidad text-right"></td>'+
                            '<td class="text-right v-middle">$ <span class="totalArticulo" id="total_'+id+'">'+data[0].precio+'</span></td>'+
                            '<td class="text-right"><a href="#" class="btn btn-sm btn-danger clsEliminarFila"> <i class="fa fa-times"></i> </a></td>'+
                            '</tr>';
                        $('table#productos tr:last').after(nuevaFila);
                        actualizarSaldos();
                        $('#articulo').val('').trigger('change');
                    }
                })

            });
       });

        $(function(){
            $("#agregarCliente").click(function(){
                $("#modal-clientes").modal("show");
            });
        });
        $(document).on('click','.clsEliminarFila',function(){
            var objFila = $(this).parents().get(1);
            $(objFila).remove();
            actualizarSaldos();
        });
        /* actualizar precio */
        $(document).on('keyup', '.precioArticulo', function(){
            var este = $(this).val();
            var id   = $(this).data("id");
            var cantidad = $("#cantidad_"+id).val();

            $("#total_"+ id).html( este * cantidad );

            actualizarSaldos();
        });
        /* descuento */
        $(document).on('keyup','.descuento',function(){
            var descuento 	= $(this).val()
            var total 		= $("#subtotalOculto").val();

            //var result = (descuento / 100) * total;

            $("#total").html( total - descuento);
        });
        $(document).on('keyup','.cantidad',function(){
            var este 	= $(this).val()
            var id 		= $(this).data("id");
            var precio 	= $("#precio_"+id).val();

            $("#total_"+id).html( parseFloat(este) * parseFloat(precio) );
            actualizarSaldos();
        });
        $(document).on('keyup', '#pagocon', function(){
            var total = $("#total").html();
            var pago  = $(this).val();

            var resta = parseFloat(total) - parseFloat(pago);
            $("#cambio").html(resta);
        });
        $("#finalizar").click(function(e){
            e.preventDefault();
            //alert($("#productos tr").length);

            if ($("#pagocon").val() == ""){
                // mensaje de que selecicone cliente
                // return false;
                if ($("#cliente").val() != ""){
                    if($("#e_nombre").val() != ""){
                        if($("#e_direccion").val() != ""){
                            if($("#e_fechaentrega").val() != ""){
                                if($("#e_horaentrega").val() != ""){
                                    if($("#e_mensaje").val() != ""){
                                        if($("#productos tr").length > 1){
                                            $("#formaVenta").submit();
                                        }else{$("#errorArticulo").show(); $("#errorMensaje").hide();}
                                    }else{$("#errorMensaje").show(); $("#errorHora").hide();}
                                }else{$("#errorHora").show(); $("#errorFecha").hide(); $("#errorDir").hide();}
                            }else{$("#errorFecha").show(); $("#errorDir").hide();}
                        }else{$("#errorDir").show(); $("#errorNombre").hide();}
                    }else{$("#errorNombre").show(); $("#errorCliente").hide();}
                }else{$("#errorCliente").show();}


            } else {
                $("#formaVenta").submit();
            }


        });
    </script>
@endsection
