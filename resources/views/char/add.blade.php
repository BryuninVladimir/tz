
@extends('layouts.app')

@section('content')

    <div class="char-add">
        <form action="{{ url('char/add') }}" method="POST" >
            {{ csrf_field() }}
            <legend>Adding a character</legend>
            <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Strength</label>
                <input type="number" min="1" max="999" class="form-control" value="1" name="Strength"  id="Strength">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Stamina</label>
                <input type="number" min="1" max="999" class="form-control" value="1" name="Stamina" id="Stamina">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>

@endsection
