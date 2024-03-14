<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ShipState;
class ShippingAreaController extends Controller
{
    public function DivisionView(){

        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.shipping.division.division_view',compact('divisions'));

    }

    public function DivisionStore(Request $req){

        $req->validate([
            'division_name'=>'required',
            
        ]);

       

        ShipDivision::insert([
            'division_name' => $req->division_name,
           
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function DivisionEdit($id){
        $division = ShipDivision::findOrFail($id);

        return view('backend.shipping.division.div_edit',compact('division'));
    }

    public function DivisionUpdate(Request $req,$id){
        $div_id = $req->id;
        

        
    
        ShipDivision::findOrFail($div_id)->update([
                'division_name' =>$req->division_name,
                
                'created_at'=>Carbon::now(),
            ]);
    
            return redirect()->route('manage-division');
        
        

    }

    public function DivisionDelete($id){
        
        ShipDivision::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function DistrictView(){
        $division = ShipDivision::orderBy('division_name','DESC')->get();

        $districts = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.shipping.district.district_view',compact('districts','division'));

    }

    public function DistrictStore(Request $req){

        $req->validate([
            'division_id'=>'required',
            'district_name'=>'required',
            
        ]);

       

        ShipDistrict::insert([
            'division_id' => $req->division_id,
            'district_name' => $req->district_name,
           
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back();
    }

    public function DistrictEdit($id){
        $division = ShipDivision::orderBy('division_name','DESC')->get();

        $district = ShipDistrict::findOrFail($id);
        

        return view('backend.shipping.district.dis_edit',compact('district','division'));
    }

    public function DistrictUpdate(Request $req,$id){
       
        

        
    
        ShipDistrict::findOrFail($id)->update([
                'division_id' =>$req->division_id,
                'district_name' =>$req->district_name,
                
                'created_at'=>Carbon::now(),
            ]);
    
            return redirect()->route('manage-district');
        
        

    }

    public function DistrictDelete($id){
        
        ShipDistrict::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function StateView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
            return view('backend.shipping.state.view_state',compact('division','district','state'));
    }

    public function StateStore(Request $request){

    	$request->validate([
    		'division_id' => 'required',  
    		'district_id' => 'required', 
    		'state_name' => 'required', 	 

    	]);


	ShipState::insert([

		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_name' => $request->state_name,
		'created_at' => Carbon::now(),

    	]);

	    

		return redirect()->back();

    } 


public function StateEdit($id){
    $division = ShipDivision::orderBy('division_name','ASC')->get();
    $district = ShipDistrict::orderBy('district_name','ASC')->get();
    $state = ShipState::findOrFail($id);
		return view('backend.shipping.state.edit_state',compact('division','district','state'));
    }
    
    public function StateUpdate(Request $request,$id){

    	ShipState::findOrFail($id)->update([

		'division_id' => $request->division_id,
		'district_id' => $request->district_id,
		'state_name' => $request->state_name,
		'created_at' => Carbon::now(),

    	]);

	    

		return redirect()->route('manage-state');


    }


public function StateDelete($id){

    	ShipState::findOrFail($id)->delete();

    	

		return redirect()->back();

    }
}
