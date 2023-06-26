<html>
    <head>
      <title>@yield('title')</title>
			<meta name="csrf-token" content="{{ csrf_token() }}">
			<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
			<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    </head>
    <body>
		<nav class="navbar navbar-expand-lg bg-body-tertiary">
			<div class="container-fluid">
				<a class="navbar-brand" href="/">Book Rentals</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('users.index') }}">User</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('books.index') }}">Book</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('rentals.index') }}">Rental</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
								Tugas
							</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="{{ route('satu') }}">Soal 1</a></li>
								<li><a class="dropdown-item" href="{{ route('dua') }}">Soal 2</a></li>
								<li><a class="dropdown-item" href="{{ route('tiga') }}">Soal 3</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
        @show
 
        <div class="container">
            @yield('content')
        </div>		
				@stack('scripts')
    </body>
</html>