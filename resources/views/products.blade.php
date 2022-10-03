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
    <div>
        <a href="/products/create">Create Product</a>
        <br><br><br>
    </div>
    @isset($products)
        <table border="dashed" style="text-align: center;">
            <thead>
                <th>Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Description</th>
                <th>Stock</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><a href="/products/{{ $product->id}}">{{ $product->name}}</a></td>
                    <td>{{ $product->price}}</td>
                    <td>{{ $product->category}}</td>
                    <td>{{ $product->description}}</td>
                    <td>{{ $product->stock}}</td>
                    <td><a href="/products/{{ $product->id }}/edit">Update</a></td>
                    <td>
                        <form action="/products/{{ $product->stock }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="delete">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul>
        </ul>
    @endisset
    
    @empty($products)
        <p>No Products Registered</p>
    @endempty
</body>
</html>