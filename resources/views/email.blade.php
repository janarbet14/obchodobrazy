<html>
<head></head>
<body style="background: white; color: black">
<h1>Objednávka obrazov</h1>
@foreach($cart as $item)
    <p>{{$item->price}}</p>
@endforeach
<p>{{$fakt_udaje}}</p>
</body>
</html>