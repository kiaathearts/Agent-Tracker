{{--Form::select('term_id', $terms, $term_id)--}} <br />
{{Form::select('term_id', $terms)}} <br />
{{Form::text('date_of', null, array('placeholder' => 'Date'))}} <br />
{{Form::text('position', null, array('placeholder' => 'Position'))}} <br />
{{Form::text('company', null, array('placeholder' => 'Company'))}} <br />
{{Form::text('compensation', null, array('placeholder' => 'Compensation'))}} <br />
{{Form::hidden('agent_id', $agentid)}}
<input type='submit' name='submit' value="{{$submit}}" >