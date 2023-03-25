{{Form::label('photo', 'Photo')}}
{{Form::file('photo')}} <br />
{{Form::text('firstName', null, array('placeholder' => 'First Name'))}} <br />
{{Form::text('lastName', null, array('placeholder' => 'Last Name'))}} <br />
{{Form::text('agency', null, array('placeholder' => 'Agency'))}} <br />
{{Form::text('location', null, array('placeholder' => 'Location'))}} <br />
{{Form::text('email', null, array('placeholder' => 'Email'))}} <br />
{{Form::text('phone', null, array('placeholder' => 'Phone'))}} <br/>
{{Form::select('agenttype_id', $types, $selected)}} <br />

<input type='submit' name='submit' value="{{$submit}}" >
<input type='submit' name='cancel' value='Cancel' >