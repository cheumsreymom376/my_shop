@extends('layouts.admin')

@section('content')

<div class="container">

<h2>Edit User</h2>


<form action="{{ route('admin.users.update',$user->id) }}"
      method="POST">

@csrf
@method('PUT')


<div class="mb-3">

<label>Name</label>

<input type="text"
       name="name"
       class="form-control"
       value="{{ $user->name }}">

</div>


<div class="mb-3">

<label>Email</label>

<input type="email"
       name="email"
       class="form-control"
       value="{{ $user->email }}">

</div>


<div class="mb-3">

<label>Role</label>

<select name="role" class="form-control">

<option value="user"
@if($user->role == 'user') selected @endif>
User
</option>


<option value="admin"
@if($user->role == 'admin') selected @endif>
Admin
</option>

</select>

</div>


<button class="btn btn-primary">
Update
</button>


</form>

</div>

@endsection