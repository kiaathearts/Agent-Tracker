{{Form::text('name', null, array('placeholder' => 'Name'))}}   <br/>
{{Form::textarea('description', null, array('placeholder' => 'Description'))}} <br />

<input type='submit' name='submit' value="{{$submit}}" >
<input type='submit' name='cancel' value='Cancel' >