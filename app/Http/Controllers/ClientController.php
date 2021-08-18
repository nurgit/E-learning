<?php

namespace App\Http\Controllers;

use App\Models\SalesPaymentModel;
use Illuminate\Http\Request;
use App\Models\ClientModel;
use App\Models\SalesItemModel;
use App\Models\SalesModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = [];
       $data['main_menu'] = "Clientes";
        return view('backend.client.index', $data);
    }

    /**
     * Store a newly created client in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'email'
        ]);
        $client = new ClientModel();
        $client->nombre = $request->nombre;
        $client->correo = $request->correo;
        $client->domicilio = $request->domicilio ? $request->domicilio : null;
        $client->colonia = $request->colonia ? $request->colonia : null;
        $client->codigopostal = $request->codigopostal ? $request->codigopostal : null;
        $client->telefono = $request->telefono ? $request->telefono : null;
        $client->celular = $request->celular ? $request->celular : null;
        $client->rfc = $request->rfc ? $request->rfc : null;
        $client->contacto = $request->contacto ? $request->contacto : null;
        $client->estado = $request->estado ? $request->estado : null;
        $client->pais = $request->pais ? $request->pais : null;
        $client->comentarios = $request->comentarios ? $request->comentarios : null;
        $client->fecharegistro = date('Y-m-d H:i:s');


        if ($client->save()) {
            return redirect('clients')->with('success', 'Cliente agregada con éxito');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'nombre' => 'required,"'.$request->idclientes.'",idclientes',
        ]);

        $client = ClientModel::where('idclientes', $request->idclientes)->get()->first();
        abort_if(!$client, 404);
        $client->nombre = $request->client_nombre;
        $client->correo = $request->client_correo;
        $client->domicilio = $request->client_domicilio ? $request->client_domicilio : null;
        $client->colonia = $request->client_colonia ? $request->client_colonia : null;
        $client->codigopostal = $request->client_codigopostal ? $request->client_codigopostal : null;
        $client->telefono = $request->client_telefono ? $request->client_telefono : null;
        $client->celular = $request->client_celular ? $request->client_celular : null;
        $client->rfc = $request->client_rfc ? $request->client_rfc : null;
        $client->contacto = $request->client_contacto ? $request->client_contacto : null;
        $client->estado = $request->client_estado ? $request->client_estado : null;
        $client->pais = $request->client_pais ? $request->client_pais : null;
        $client->comentarios = $request->client_comentarios ? $request->client_comentarios : null;
        $client->fecharegistro = date('Y-m-d H:i:s');

        if ($client->save()) {
            return redirect('clients')->with('success', 'Cliente agregada con éxito');
        } else {
            return redirect()->back()->with('error', 'An error occurred! Please try again.');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->delete_client_id;
        if ($client = ClientModel::where('idclientes', $id)->first()) {
            if ($client->delete()) {
                return redirect()->back()->with('success', 'Cliente eliminado con éxito.');
            } else {
                return redirect()->back()->with('error', 'Generic name delete failed!');
            }
        } else {
            return redirect()->back()->with('error', 'Generic name not found!');
        }
    }

    public function client_sales(string $id)
    {
        $data = [];
        $data['main_menu'] = "Clientes";
        $data['sub_menu'] = "Cliente Ventas";
        $sale_info = SalesModel::where('ventas.idcliente', $id)
            ->join('ventas_articulos', 'ventas_articulos.idventa', '=', 'ventas.idventas')
            ->join('ventas_pagos', 'ventas_pagos.idventa', '=', 'ventas.idventas')
            ->select('ventas.*','ventas_articulos.total','ventas_pagos.cantidad','ventas.descuento','ventas.fetcha_hora')
            ->orderBy('idventas', 'DESC')->get();

        $client_info = ClientModel::where('idclientes', $id)->get();
        $data['sale_info'] = $sale_info;
        $data['client_info'] = $client_info ;

        return view('backend.client.client_sales', $data);
    }
    public function fetch_client_data(Request $request)
    {

            $get_clients = ClientModel::all();

            if ($get_clients->count() > 0) {
                $data = [];
                foreach ($get_clients as $row) {
                    $id = $row->idclientes;
                    $name = $row->nombre;
                    $email = $row->correo ? $row->correo : 'N/A';
                    $direccion = $row->domicilio ? $row->domicilio : 'N/A';
                    $telefono= $row->telefono ? $row->telefono : 'N/A';
                    $edit_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_edit_modal(\"$id\", \"$name\", \"$row->telefono\", \"$row->correo\",  \"$row->estado\", \"$row->pais\", \"$row->domicilio\", \"$row->codigopostal\", \"$row->colonia\", \"$row->celular\", \"$row->rfc\",   \"$row->contacto\", \"$row->comentarios\" )' data-placement=\"top\" title=\"Edit\" class=\"glyphicon glyphicon-edit\"></span></a>";
                    $delete_btn = "<a href=\"javascript:void(0)\"><span data-toggle=\"tooltip\" onclick='show_delete_modal(\"$id\", \"$name\")' data-placement=\"top\" title=\"Delete\" class=\"glyphicon glyphicon-trash\"></span></a>";
                    $sale_url = route('client_sale', ['client'=>$id]);
                    $sale_btn = "<a href=\"$sale_url\"><span data-toggle=\"tooltip\" data-placement=\"top\" title=\"Sales\" class=\"glyphicon glyphicon-usd\"></span></a>";

                    $action = "$edit_btn $delete_btn $sale_btn";
                    $temp = array();
                    array_push($temp, $name);
                    array_push($temp, $direccion);
                    array_push($temp, $telefono);;
                    array_push($temp, $email);
                    array_push($temp, $action);
                    array_push($data, $temp);
                }

                echo json_encode(array('data'=>$data));
            } else {
                echo '{
                    "sEcho": 1,
                    "iTotalRecords": "0",
                    "iTotalDisplayRecords": "0",
                    "aaData": []
                }';
            }

    }
}
