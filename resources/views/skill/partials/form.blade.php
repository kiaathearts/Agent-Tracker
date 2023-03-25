{{Form::select('skilltype_id', $skilltypes, $skilltype_id)}} <br />
{{Form::text('name', null, array('placeholder' => 'Name'))}} <br />
{{Form::textarea('description', null, array('placeholder' => 'Description'))}}<br />
<input type='submit' name='submit' value="{{$submit}}" >