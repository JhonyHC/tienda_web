<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    @isset($createdProduct)
        <h2>New Product Added</h2>
        <b>{{ $createdProduct->name }}</b>
    @endisset
    <h1>Products List</h1>
    @isset($products)
        <ul>
            <p>Products List</p>
        @foreach($products as $product)
            <li>{{ $product->name}}</li>
        @endforeach
        </ul>
    @endisset
    
    @empty($products)
        <p>No Products Registered</p>
    @endempty
</body>
</html>