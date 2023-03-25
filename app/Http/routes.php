<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::any('/', function () {
        return View::make('main');
    });
    
    /*
     * Agents...
     */
    Route::post('agent/search', 'AgentController@agentSearch');
    Route::resource('agent', 'AgentController');
    
    /*
     * Solicitations...
     */
    Route::resource('solicitation', 'SolicitationController');
    Route::group(['prefix' => 'agent/{agentid}'], function(){
       Route::resource('solicitations', 'SolicitationController'); 
    });
    
    /*
     * Requirements...
     */
    Route::resource('requirement', 'RequirementController');
    Route::group(['prefix' => 'solicitations/{solicitationid}'], function(){
       Route::resource('requirement', 'RequirementController'); 
    });
     
    /*
     * Agent Notes...
     */
    Route::resource('note', 'NoteController');
    Route::group(['prefix' => 'agent/{agent_id}'], function(){
        Route::resource('notes', 'NoteController');
    });
    
    /*
     * Agent Types...
     */
    Route::resource('agenttype', 'AgenttypeController');
    
    /*
     * Messages...
     */
    Route::get('message/{message}/send', function($id){
        $agents = App\Agent::all();
        $message = App\Message::find($id);
        return View::make('send')->with(array(
            'message' => $message, 
            'agents' => $agents));
    });
    Route::post('message/search', 'MessageController@messageSearch');
    Route::post('message/send', 'BatchSenderController@postBatchSend');
    Route::resource('message', 'MessageController');
    
    /*
     * Email Preview...
     */
    Route::get('email', function(){
        return View::make('email.notification');
    });
    
    /*
     * Terms...
     */
    Route::resource('term', 'TermController');
    
    /*
     * Skills...
     */
     Route::resource('skill', 'SkillController');
     
    /*
     * Skilltypes...
     */
    Route::resource('skilltype', 'SkilltypeController');
    
    /**
     * Logout
     **/
    Route::any('logout', 'LoginController@logout');
     
});
     
Route::auth();

Route::get('/home', 'HomeController@index');