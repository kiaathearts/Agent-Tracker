<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Term;
use App\Http\Requests\ShortFormRequest;
use App\Facades\RequestHandle;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::all();
        return view()->make('term.index')->with(array('terms' => $terms));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view()->make('term.create');
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
         * Check for cancel or delete request.
         */
        if($return = RequestHandle::checkRequest($request, 'term')){return $return;}
        
        /*
         * Set item values.
         */
        $term = fillItem($request, new Term(), 'terms');
        
        /*
         * Save term and return success message.
         */
        if($term->save()){
            session()->flash('success message', 'Term has been successfully saved!');
            return view()->make('term.show')->with(array('term' => $term));
        }else{
            session()->flash('success message', 'Term has not saved successfully. Please, try again later.');
            $terms = Term::all();
            return view()->make('term.index')->with(array('terms'  => $terms));
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
        $term = Term::find($id);
        return view()->make('term.show')->with(array('term' => $term));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $term = Term::find($id);
        return view()->make('term.edit')->with(array('term' => $term));
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
         * Check for cancel or delete request.
         */
        if($return = RequestHandle::checkRequest($request, 'term', $id)){return $return;}
        
        /*
         * Set term values.
         */
        $term = fillItem($request, Term::find($id), 'terms');
        
        /*
         * Update term and return success message.
         */
        $success_message = $term->update() ? 'Term has been successfully updated.' :
            'Update unsuccessful. Please, try again.';
        session()->flash('success message', $success_message);
        
        return view()->make('term.show')->with(array('term' => $term));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Term::destroy($id)){
            return true;
        } else {
            return false;
        }
    }
}
