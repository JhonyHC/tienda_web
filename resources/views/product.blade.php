<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
</head>
<body>
    @isset($product)
    <h1>{{$product->name}}</h1>
    <div>
        <p>Price: <b>{{$product->price}}</b></p>
        <p>Category: <b>{{$product->category}}</b></p>
        <p>Description: <b>{{$product->description}}</b></p>
        <p>Stock: <b>{{$product->stock}}</b></p>
    </div>

    @endisset
    
    @empty($product)
        <h1>Error, el producto no existe</h1>
    @endempty

    <div>
        <p><a href="/products">Volver</a></p>
    </div>
</body>
</html>