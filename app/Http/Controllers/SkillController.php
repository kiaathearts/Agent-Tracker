<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShortFormRequest;
use App\Facades\RequestHandle;
use App\Skill;
use App\Skilltype;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $skills = Skill::all();
        return view()->make('skill.index')->with(array('skills' => $skills));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $skilltypes = $this->getSkillTypes();
        return view()->make('skill.create')->with(array('skilltypes' => $skilltypes));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShortFormRequest $request)
    {
        /*
         * Check request for cancel or delete and return correlating redirect.
         */
        if($return = RequestHandle::checkRequest($request, 'skill')){return $return;}
        
        /*
         * Set skill values.
         */
        $skill = fillItem($request, new Skill, 'skills');
       
        /*
         * Save new skill and return success message.
         */
        if($skill->save()){
            session()->flash('success message', 'Skill has been successfully saved!');
            return view()->make('skill.show')->with(array('skill' => $skill));
        }else{
            session()->flash('success message', 'Skill has not saved successfully. Please, try again later.');
            $skills = Skill::all();
            return view()->make('skill.index')->with(array('skills' => $skills));
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
        //
        $skill = Skill::find($id);
        return view()->make('skill.show')->with(array('skill' => $skill));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $skill = Skill::find($id);
        $skilltypes = Skilltype::lists('name', 'id')->all();
        
        return view()->make('skill.edit')->with(array(
            'skill' => $skill,
            'skilltypes' => $skilltypes,
            ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShortFormRequest $request, $id)
    {
        /*
         * Check request for cancel or delete and return correlating redirect.
         */
        if($return = RequestHandle::checkRequest($request, 'skill', $id)){return $return;}
        
        /*
         * Update skill values.
         */
        $skill = fillItem($request, Skill::find($id), 'skills');
        
        /*
         * Update skill and return success message.
         */
        $success_message = $skill->update() ? 'Skill has been successfully updated' :
            'Update unsuccessful. Please, try again.';
        
        return view()->make('skill.show')->with(array('skill' => $skill));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Skill::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
}
