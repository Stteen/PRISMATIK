<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Select2Controller extends Controller
{
    //

    public function select2(Request $request){
        $q = $request->q;
        $id = $request->id;

        switch($request->action){

            case 'getProductos':
                if ($q!='') {
                    $r = \App\Models\Producto::where('varReferencia', 'like', '%'.$q.'%')->
                    where('varTipoProducto',$request->tipoProducto)->get()
                ->map(function ($item) {
                    return ['id'=>$item->IdPortafolio,'text'=>$item->varReferencia.' - '.$item->varColor];
                });
                }
                else{
                    $r = \App\Models\Producto::where('IdPortafolio',$id)->get()
                    ->map(function ($item) {
                        return ['id'=>$item->IdPortafolio,'text'=>$item->varReferencia];
                    });
                }

                break;

                
            case 'getProveedores':
                if ($q!='') {
                    $r = \App\Models\Proveedor::where('intNumeroDoc', 'like', '%'.$q.'%')
                    ->orWhere('varNombreRazon', 'like', '%'.$q.'%')
                    ->orWhere('varNombreConta', 'like', '%'.$q.'%')
                    ->get()
                ->map(function ($item) {
                    return ['id'=>$item->IdProveedores,'text'=>$item->varNombreConta.' - '.$item->varNombreRazon];
                });
                }
                else{
                    $r = \App\Models\Proveedor::where('IdProveedores',$id)->get()
                    ->map(function ($item) {
                        return ['id'=>$item->IdProveedores,'text'=>$item->varNombreConta];
                    });
                }

                break;

                case 'getClientes':
                    if ($q!='') {
                        $r = \App\Models\Cliente::where('IdDocumentos', 'like', '%'.$q.'%')
                        ->orWhere('varNombreRazon', 'like', '%'.$q.'%')
                        ->orWhere('varNombreConta', 'like', '%'.$q.'%')
                        ->get()
                    ->map(function ($item) {
                        return ['id'=>$item->IdClientes,'text'=>$item->varNombreConta];
                    });
                    }
                    else{
                        $r = \App\Models\Cliente::where('IdClientes',$id)->get()
                        ->map(function ($item) {
                            return ['id'=>$item->IdClientes,'text'=>$item->varNombreConta];
                        });
                    }
    
                    break;

                    case 'getZonas':
                        if ($q!='') {
                            $r = \App\Models\Zona::where('varNumeroZona', 'like', '%'.$q.'%')
                            ->orWhere('varDepartamento', 'like', '%'.$q.'%')
                            ->orWhere('varCiudad', 'like', '%'.$q.'%')
                            ->where('bolEstado', 1)
                            ->get()
                        ->map(function ($item) {
                            return ['id'=>$item->IdZonas,'text'=>$item->varCiudad.' - '.$item->varDepartamento];
                        });
                        }
                        else{
                            $r = \App\Models\Zona::where('IdZonas',$id)->get()
                            ->map(function ($item) {
                                return ['id'=>$item->IdZonas,'text'=>$item->varCiudad];
                            });
                        }
        
                        break;

                        case 'getTecnicos':
                            if ($q!='') {
                                $r = \App\Models\Tecnico::where('varNumeroDoc', 'like', '%'.$q.'%')
                                ->orWhere('varNombreRazon', 'like', '%'.$q.'%')
                                ->orWhere('varNombreCont', 'like', '%'.$q.'%')
                                ->where('bolEstado', 1)
                                ->get()
                            ->map(function ($item) {
                                return ['id'=>$item->IdTecnicos,'text'=>$item->varNombreCont.' - '.$item->varNumeroDoc];
                            });
                            }
                            else{
                                $r = \App\Models\Tecnico::where('IdTecnicos',$id)->get()
                                ->map(function ($item) {
                                    return ['id'=>$item->IdTecnicos,'text'=>$item->varNombreCont];
                                });
                            }
            
                            break;

        }

        return ['results'=>$r,$request->all()];
    }
}