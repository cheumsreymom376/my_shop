@extends('layouts.admin')

@section('content')

<h2>Users</h2>

<table class="table">

<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Action</th>
</tr>


@foreach($users as $user)

<tr>

<td>{{ $user->name }}</td>

<td>{{ $user->email }}</td>

<td>
    <span class="badge bg-primary">
        {{ $user->role }}
    </span>
</td>


<td>

<a href="{{ route('admin.users.edit',$user->id) }}"
   class="btn btn-warning btn-sm">
    Edit
</a>


<form action="{{ route('admin.users.destroy',$user->id) }}"
      method="POST"
      class="d-inline">

@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</table>

@endsection