@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-person-circle"></i>
                        My Profile
                    </h4>
                </div>


                <div class="card-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    <form action="{{ route('profile.update') }}" method="POST">

                        @csrf
                        @method('PUT')


                        <!-- Name -->
                        <div class="mb-3">

                            <label class="form-label">
                                Name
                            </label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   value="{{ $user->name }}"
                                   required>

                        </div>


                        <!-- Email -->
                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ $user->email }}"
                                   required>

                        </div>


                        <!-- Role -->
                        <div class="mb-3">

                            <label class="form-label">
                                Role
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ ucfirst($user->role) }}"
                                   disabled>

                        </div>


                        <!-- Created -->
                        <div class="mb-3">

                            <label class="form-label">
                                Member Since
                            </label>

                            <input type="text"
                                   class="form-control"
                                   value="{{ $user->created_at->format('d M Y') }}"
                                   disabled>

                        </div>


                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i>
                            Update Profile
                        </button>


                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection