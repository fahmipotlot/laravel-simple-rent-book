<html lang="en">
<head>
	<title>Soal  Algoritma 2</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Get Fibonanci Number</div>
            <div class="panel-body">
                <form action="" method="GET">
                    <div class="control-group after-add-more">
                        <label>Number</label>
                        <input type="text" name="input" class="form-control" value={{ request()->get('input') }}>
                    </div>
                    <br/>
                    <button class="btn btn-success" type="submit">Submit</button>
                </form>
				<br/>
				@isset($fibonanci)
					@foreach($fibonanci as $fib)
						<li>{{ $fib }}</li>
					@endforeach
				@endisset
			</div>
        </div>
    </div>
</body>
</html>