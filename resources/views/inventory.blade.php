<!DOCTYPE html>
<html>
    <head>
        <title>Hillcroft Laravel Tech Test</title>
    </head>
    <body>
        <div>
            <h1>All Products</h1>
            <p>Below are all {{ count($products) }} products:<br/></p>
            <table>
                <thead>
                    <td>Code</td>
                    <td>Cat</td>
                    <td>Name</td>
                    <td>Price ex VAT</td>
                    <td>Price inc VAT</td>
                    <td>Stock</td>
                    <td>Short Desc</td>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product['code'] }}</td>
                            <td>{{ $product['cat'] }}</td>
                            <td>{{ $product['name'] }}</td>
                            <td>{{ $product['price_ex_vat'] }}</td>
                            <td>{{ $product['price_inc_vat'] }}</td>
                            <td>{{ $product['stock'] }}</td>
                            <td>{{ $product['short_desc'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>
