@extends('layouts.admin-login')
@section('content')
<div class="login-form-yellow-shadow">
	<div class="login-form-bg">
		<h1>Welcome, <span>Admin</span></h1>
		<form id="sign_in_adm" method="POST" action="{{ route('admin.login') }}">
			{{ csrf_field() }}
			<div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email Address" value="{{ old('email') }}" autofocus required>
			</div>
			@if($errors->has('email'))
				<span class="text-danger">{{ $errors->first('email') }}</span>
			@endif
			<div class="form-group">
				<input type="password" class="form-control" name="password" placeholder="Password" minlength=6 required>
			</div>
			@if($errors->has('password'))
				<span class="text-danger">{{ $errors->first('password') }}</span>
			@endif
			@include('includes.message')
			<div class="login-btn">
				<input type="submit" name="" value="Login to Dashboard">
			</div>
		</form>
	</div>
</div>
@endsection
