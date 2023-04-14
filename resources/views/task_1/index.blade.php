@extends('layouts.app')
@section('title', 'Users Table')
@section('content')
<h3>Users Table</h3>
 <a href="{{ route('user.create') }}" class="btn btn-primary">New User</a>
<!-- Bootstrap Table -->
<table class="table">
  <thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Email</th>
      <th>Mobile</th>
      <th>Role</th>
      <th>Password</th>
      <th>Image</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @if(!empty($userArray))
      @foreach($userArray as $key => $userArr)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $userArr['name'] }}</td>
        <td>{{ $userArr['email'] }}</td>
        <td>{{ $userArr['number'] }}</td>
        <td>{{ $userArr['role'] }}</td>
        <td>{{ $userArr['password'] }}</td>
        <td>
          <img src="{{ asset('storage/'.$userArr['profile']) }}" width="80px" height="80px"> 
        </td>
        <td>{{ $userArr['date'] }}</td>
        <td>
          <a href="{{ route('user.edit', $userArr['id']) }}" class="btn btn-primary"><i class='fa fa-edit'></i></a>
          <a href="{{ route('user.delete', $userArr['id']) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
        </td>
      </tr>
      @endforeach
    @else
    <td colspan="8">No records found...<td>
    @endif
  </tbody>
</table>
@if(!empty($userArray))
  <div class="text-center">
    <a href="
    {{ route('user.finalSubmission') }}" class="btn btn-success">Final Submit</a>
  </div>
@endif
@endsection
