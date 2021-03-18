<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;

class FilterGraphController extends Controller
{
    public static function getListFilter(Request $request){
        if($request->session()->get("listFilterGraph") == null){
            FilterGraphController::initListFilter($request);
        }

        $listFilterGraph = $request->session()->get("listFilterGraph");

        return $listFilterGraph;

    }


    public static function initListFilter(Request $request){

        $listFilterGraph = 
        array(
            [
                'name' => 'display_filter_name_objet',
                'label' => 'Nom objet',
                'active' => $request->input('display_filter_name_objet') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_name_raccordement',
                'label' => 'Nom raccordement',
                'active' => $request->input('display_filter_name_raccordement') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_image',
                'label' => 'Image',
                'active' => $request->input('display_filter_image') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_color',
                'label' => 'Couleur',
                'active' => $request->input('display_filter_color') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_implant',
                'label' => 'Implant',
                'active' => $request->input('display_filter_implant') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_instrument',
                'label' => 'Instrument',
                'active' => $request->input('display_filter_instrument') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_outillage',
                'label' => 'Outillage',
                'active' => $request->input('display_filter_outillage') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_plateau',
                'label' => 'Plateau',
                'active' => $request->input('display_filter_plateau') != true ? "" : "checked"
            ],
            [
                'name' => 'display_filter_logiciel',
                'label' => 'Logiciel',
                'active' => $request->input('display_filter_logiciel') != true ? "" : "checked"
            ]
        );

        session(['listFilterGraph' => $listFilterGraph]);
    }


    public static function setListFilter(Request $request){

        $validator = Validator::make($request->all(), [
            'display_filter_name_objet' => 'required',
            'display_filter_name_raccordement' => 'required',
            'display_filter_image' => 'required',
            'display_filter_color' => 'required',
            'display_filter_implant' => 'required',
            'display_filter_instrument' => 'required',
            'display_filter_outillage' => 'required',
            'display_filter_plateau' => 'required',
            'display_filter_logiciel' => 'required',
            'display_filter_logiciel' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['success' => false, 'description' => $validator->errors()->all()], 403);
            //return abort(403);
        }

        FilterGraphController::initListFilter($request);

        return response()->json(['success' => true, 'description' => 'Session as been change.']);
    }
}
