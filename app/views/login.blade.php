@extends('layout')
@section('content')
<article role="main" id="main">
	<div id="main-body">
		<br>
		<form id="login-form" name="login-form" method="POST" action="{{ url('/login') }}" accept-charset="UTF-8"> 
			<section id="login-container">	
				<div id="login-container-box">
					<div class="login-container-column">
						<div class="login-container-column-row login-container-column-label">Username : </div>
						<div class="login-container-column-row login-container-column-label">Password : </div>
					</div>	
					<div class="login-container-column">
						<div class="login-container-column-row">
							{{ Form::text('username', Input::get('username'), array('id'=>'username','class'=>'login-container-column-input')) }}
						</div>
						<div class="login-container-column-row">
							<input id="password" name="password" type="password" class="login-container-column-input">
						</div>
					</div>		
					<div class="login-container-column">
						<div id="login-btn">
							Login
						</div>
					</div>
				</div>
				@if ($errors->has())
					<div id="login-errors-container">
						<span style="font-weight:bold; padding-bottom:10px;">{{ Session::get("message") }}</span>
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
				@if (Session::has("usernotfoundmsg") || Session::has("wrongpasswordmsg"))
					<div id="login-errors-container">
						<span style="font-weight:bold; padding-bottom:10px;">{{ Session::get("message") }}</span>
						<ul>
							@if (Session::has("usernotfoundmsg"))
								<li>{{ Session::get("usernotfoundmsg") }}</li>
							@endif
							@if (Session::has("wrongpasswordmsg"))
								<li>{{ Session::get("wrongpasswordmsg") }}</li>
							@endif
						</ul>
					</div>
				@endif
			</section>
		</form>
		<section id="login-container-sp">
			<br>
			<div>[ The CMS is only accessible from widescreen devices. ]</div>
		</section>
	</div>
</article>
@stop