@extends('layouts.app')
@section('title', 'User Create Form')
@section('content')
<h3>Create User Form</h3>
<form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
	@csrf
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="name">Name</label>
			<input type="text" class="form-control" required name="name" id="name" placeholder="Enter your name">
		</div>
		<div class="form-group col-md-6">
			<label for="email">Email address</label>
			<input type="email" class="form-control" required name="email" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
			<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="number">Mobile number</label>
			<input type="text" class="form-control" required name="number" id="number" placeholder="Enter your number">
		</div>
		<div class="form-group col-md-6">
			<label for="number">Role</label>
			<select class="form-control" required name="role" >
				<option selected="" disabled="">--Select--</option>
				<option value="admin">ADMIN</option>
				<option value="user">User</option>
			</select>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="password">Password</label>
			<input type="password" class="form-control" required name="password" id="password" placeholder="Enter your password">
		</div>
		<div class="form-group col-md-6">
			<label for="password">Image</label>
			<input type="file" class="form-control" accept="image" required name="profile">
		</div>
	</div>
	<div class="form-group">
		<label for="password">Date</label>
		<input type="date" class="form-control" required name="date">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
