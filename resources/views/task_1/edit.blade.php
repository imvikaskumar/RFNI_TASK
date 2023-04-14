@extends('layouts.app')
@section('title', 'User Edit Form')
@section('content')
<h3>Edit User Form</h3>
<form method="POST" action="{{ route('user.update', $userArray['id']) }}" enctype="multipart/form-data">
	@csrf
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="name">Name</label>
			<input type="text" class="form-control" value="{{ $userArray['name'] }}" name="name" id="name" placeholder="Enter your name">
		</div>
		<div class="form-group col-md-6">
			<label for="email">Email address</label>
			<input type="email" class="form-control" value="{{ $userArray['email'] }}" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="number">Mobile number</label>
			<input type="text" class="form-control" value="{{ $userArray['number'] }}" name="number" id="number" placeholder="Enter your number">
		</div>
		<div class="form-group col-md-6">
			<label for="number">Role</label>
			<select class="form-control" name="role" >
				<option disabled="">--Select--</option>
				<option value="admin" {{ $userArray['role'] == "admin" ? 'selected' : '' }}>ADMIN</option>
				<option value="user" {{ $userArray['role'] == "user" ? 'selected' : '' }}>User</option>
			</select>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="password">Password</label>
			<input type="password" class="form-control" value="{{ $userArray['password'] }}" name="password" id="password" placeholder="Enter your password">
			
		</div>
		<div class="form-group col-md-6">
			<label for="password">Image</label>
			<input type="file" class="form-control" name="profile">
		<img src="{{ asset('storage/'.$userArray['profile']) }}" width="80px" height="80px"> 
		</div>
	</div>
	<div class="form-group">
		<label for="password">Date</label>
		<input type="date" value="{{ $userArray['date'] }}" class="form-control" name="date">
	</div>
	<button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection