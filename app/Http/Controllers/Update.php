<?php

namespace App\Http\Controllers;

use App\Models\CargoModel;
use App\Models\Container;
use App\Models\ContainerSize;
use App\Models\PortDestination;
use App\Models\ShippingLine;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Str;

class Update extends Controller
{
    public function save()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        CargoModel::truncate();
        PortDestination::truncate();
        ShippingLine::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $destination =  Container::distinct()->pluck('DESTINATION');
        $container_size =  Container::distinct()->pluck('TYPE');
        $SHIPPING_LINE =  Container::distinct()->pluck('SHIPPING_LINE');


        try {
            foreach ($container_size as $key => $value) {
                $PortDestination =  new ContainerSize();
                $PortDestination->name =  $value;
                $PortDestination->save();
            }
        } catch (\Throwable $th) {
        }



        try {
            foreach ($destination as $key => $value) {
                $PortDestination =  new PortDestination();
                $PortDestination->name =  $value;
                $PortDestination->save();
            }
        } catch (\Throwable $th) {
        }

        try {
            foreach ($SHIPPING_LINE as $key => $value) {
                $PortDestination =  new ShippingLine();
                $PortDestination->name =  $value;
                $PortDestination->save();
            }
        } catch (\Throwable $th) {
        }



        $containerSave =  Container::all();

        foreach ($containerSave as $key => $value) {
            $Cargo =  new CargoModel();
            $Cargo->uuid =  Str::uuid();
            $Cargo->consigne =  $value->CONSIGNEE;
            $Cargo->container_number =  $value->CONTAINER_NUMBER;
            $Cargo->cost_price =  $value->COST_PRICE;
            $Cargo->delivery_slip =  $value->BL;
            $Cargo->agent_price =  $value->AGENT_PRICE ;
            $Cargo->agent_name =  $value->SHIPPING_AGENT;
            $Cargo->agent_price =  $value->AGENT_PRICE;
            $Cargo->cbm =  $value->CBM;
            $Cargo->petit_balle =  $value->PTES_BALLES;
            $Cargo->hand_balle =  $value->HAND_BALLES;
            $Cargo->grd_balle =  $value->GRD_BALLES;
            $Cargo->loading_time =  $value->LOADING_TIME;
            $Cargo->arrival_time =  $value->ARRIVAL_TIME;


            $Cargo->port_destination_id = PortDestination::where('name', $value->DESTINATION)->first()?->id;
            $Cargo->container_size_id = ContainerSize::where('name', $value->TYPE)->first()?->id;
            $Cargo->shipping_lines_id = ShippingLine::where('name' , $value->SHIPPING_LINE)->first()?->id;


            $Cargo->save();
        }





        return CargoModel::all();
    }
}
