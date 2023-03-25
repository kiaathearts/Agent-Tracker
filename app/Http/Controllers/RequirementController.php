<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requirement;
use App\Solicitation;
use App\Skill;

class RequirementController extends Controller
{
    public function __construct()
    {
        $this->middleware('iauth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @param int $solicitationid ID of corresponding solicitation object.
     * @return \Illuminate\Http\Response
     */
    public function create($solicitationid)
    {
        $skills = Skill::lists('name', 'id')->all();
        return view()->make('requirement.create')->with(array(
            'skills' => $skills,
            'solicitationid' => $solicitationid));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
         * Check for cancel or delete request.
         */
        if($return = $this->checkRequirementRequest($request)){return $return;}
       
        /*
         * Validate input.
         */
        $validator = $this->getRequirmentValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Set requirement values.
         */
        $solicitationid = $request['solicitation_id'];
        $requirement = fillItem($request, new Requirement(), 'requirements');
        
        /*
         * Save requirement and return success message.
         */
        if($requirement->save()){
            session()->flash('success message', 'Requirement has been successfully saved!');
            return view()->make('requirement.show')->with(array('requirement' => $requirement));
        }else{
            session()->flash('success message', 'Requirement has not saved successfully. Please, try again later.');
            $solicitation = Solicitation::find($solicitationid);
            return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
        }
        
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $requirement = retrieveItemFromArgs(func_get_args(), 'Requirement');
        return view()->make('requirement.show')->with(array('requirement' => $requirement));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($solicitationid)
    {
        $skills = Skill::lists('name', 'id')->all();
        $requirement = $this->retrieveItemFromArgs(func_get_args(), 'Requirement');
        return view()->make('requirement.edit')->with(array(
            'skills' => $skills, 
            'requirement' => $requirement));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
         * Check for delete or cancel request.
         */
        if($return = $this->checkRequirementRequest($request, $id)){return $return;};

        /*
         * Validate input.
         */
        $validator = $this->getRequirmentValidator($request);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        /*
         * Update requirement values.
         */
        $requirement = fillItem($request, Requirement::find($id), 'requirements');
       
        /*
         * Update requirement and return a success message.
         */
        $success_message = $requirement->update() ? 'Requirement successfully updated.' :
            'Requirement update failed. Please, try again.';
        session()->flash('success message', $success_message);
        
        return view()->make('requirement.show')->with(array('requirement' => $requirement));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Requirement::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * Validates requirement and returns a validator object.
     * 
     * @param Request $request.
     * @return Validator
     */
    private function getRequirmentValidator($request)
    {
        $messages = [
            'experience.required' => 'Please add required years of experience',
        ];
        $validation = [
            'experience' => 'required',
        ];
      return validator()->make($request->all(), $validation, $messages);
    }
    
    /**
     * Check request for cancel or delete and return correlating request.
     * 
     * Returns redirect or false.
     * 
     * @param Request $request The request object.
     * @param int|null $id ID of requirement
     * @return View|bool
     */
    private function checkRequirementRequest($request, $id = null){
        /*
         * If cancel requested, return requirement page if id present. Otherwise, return list.
         */
        if($request->input('cancel')){
            if(!empty($id)) {
                return redirect("requirement/{$id}");
            } else {
                $solicitation = Solicitation::find($request['solicitation_id']);
                return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
            }
        } elseif($request->input('delete')) {
            $requirement = Requirement::find($id);
            $solicitation = $requirement->solicitation;
            
            /*
             * If delete is success return correlating solicitation page. Otherwise, return requirement page.
             * Return success message.
             */
            if(Requirement::destroy($id)){
                session()->flash('success message', "The requirement has been successfully removed.");
                return view()->make('solicitation.show')->with(array('solicitation' => $solicitation));
            } else {
                session()->flash('success message', 'Requirement delete unsuccessful. Please try again.');
                return view()->make('requirement.show')->with(array('requirement' => $requirement));
            }
        } else {
            return false;
        }
    }
}
