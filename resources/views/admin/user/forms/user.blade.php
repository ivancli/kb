<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 13/06/2016
 * Time: 4:59 PM
 */
?>

<div class="form-group">
    {!! Form::label('name', 'Full name') !!}
    {!! Form::text('name', old('name'), ['class' => 'form-control input-sm', 'placeholder' => 'full name']) !!}
</div>
<div class="form-group">
    {!! Form::label('email', 'Email') !!}
    {!! Form::text('email', old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'email', 'disabled' => 'disabled']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status') !!} &nbsp;
    {!! Form::select('status', array('active' => 'active', 'inactive' => 'inactive', 'locked' => 'locked', 'deleted' => 'deleted'), old('status'), ['class' => 'control-inline form-control input-sm m-b-5']) !!}
</div>