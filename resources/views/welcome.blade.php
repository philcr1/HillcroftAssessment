<!DOCTYPE html>
<html>
    <head>
        <title>Hillcroft Laravel Tech Test</title>
    </head>
    <body>
        <div>
            <form method="POST" action="{{url('products')}}" enctype="multipart/form-data">
                @csrf
                <h1>Hillcroft Laravel Tech Test</h1>
                <label for="fileSelector">Select a product file: </label>
                <input type="file" id="fileSelector" name="fileSelector" /><br /><br />

                <label for="lowStockEmail">Low Stock email address: </label>
                <input type="text" id="lowStockEmail" name="lowStockEmail" placeholder="Enter address where low stock emails should be sent" /><br /><br />
                <button type="submit">Import Products</button>
            </form>
        </div>
    </body>
</html>
