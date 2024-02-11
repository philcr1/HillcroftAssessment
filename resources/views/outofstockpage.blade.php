<!DOCTYPE html>
    <head>
        <title>Hillcroft Laravel Tech Test</title>
    </head>
    <body>
        <div>
            <h1>Out Of Stock Products</h1>
            <p>The following items are out of stock:<br/></p>
            @foreach($emailContent as $outOfStockItem)
                {{ "- " . $outOfStockItem }}<br/>
            @endforeach
        </div>
    </body>
</html>
