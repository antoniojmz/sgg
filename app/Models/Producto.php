<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;
use App\Exceptions\Handler;
use Illuminate\Mail\Mailable;

use DB;
use Log;
use DateTime;
use Session;
use Exception;
use Auth;

class Producto extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     * @var array
     */

    protected $table = 'productos';

    protected $primaryKey = 'IdProducto';

    protected $fillable = [
        'CodigoBarra','CodigoProveedor','NombreProducto','DescripcionProducto','IdUltimoProveedor','IdFamilia','IdSubFamilia','IdUnidadMedida','SeCompra','SeVende','EsProductoCombo','Descontinuado','StockMinimo','StockMaximo','StockRecomendado','PrecioUltimaCompra','PrecioVentaSugerido','IdBodega','auUsuarioModificacion','auUsuarioCreacion','EstadoProducto'
    ];

    protected $dates = [
        'auFechaModificacion','auFechaCreacion'
    ];

    public function listProductos(){
        return DB::table('v_productos')->get();
    }

    // Cargar combo de estados de Estado (Activo / Inactivo)
    public function listEstados(){
        return DB::table('v_estados')->get();
    }

    // Cargar combo Familia
    public function listFamilias(){
        return DB::table('v_familias_combo')->get();
    }

    // Cargar combo SubFamilia
    public function listSubfamilias(){
        return DB::table('v_subfamilias_combo')->get();
    }

    // Cargar combo Unidad de medida
    public function listUnidadmedidas(){
        return DB::table('v_unidadmedida_combo')->get();
    }

    // Cargar combo de Bodega
    public function listBodegas(){
        return DB::table('v_bodegas_combo')->get();
    }

    // registrar una nueva bodega
    public function regBodega($datos){
        $idAdmin = Auth::id();
        $datos['IdBodega']==null ? $Id=0 : $Id= $datos['IdBodega'];
        $sql="select f_registro_bodega(".$Id.",'".$datos['NombreBodega']."','".$datos['DescripcionBodega']."',".$datos['IdLocal'].",".$datos['EstadoBodega'].",".$idAdmin.")";
        $execute=DB::select($sql);
        foreach ($execute[0] as $key => $value) {
            $result['f_registro_bodega']=$value;
        }
        return $result;
    }

    // Activar / Desactivar bodega
    public function activarBodega($datos){
        $idAdmin = Auth::id();
        if ($datos['EstadoBodega']>0){
            $values=array('EstadoBodega'=>0,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }else{
            $values=array('EstadoBodega'=>1,'auFechaModificacion'=>date("Y-m-d H:i:s"),'auUsuarioModificacion'=>$idAdmin);
        }
        return DB::table('bodegas')
                ->where('IdBodega', $datos['IdBodega'])
                ->update($values);
    }

    public function localesProducto($IdBodega){    
        return DB::table('v_productos')->where('IdBodega',$IdBodega)->get(); 
    }

    public function getOneDetalle($IdBodega){
        return DB::table('v_bodegas')->where('IdBodega',$IdBodega)->get(); 
    }  

}