<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use SimpleXMLElement;
use XMLReader;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Mail\OutOfStockProducts;

class ProductController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function importProducts(Request $request)//: RedirectResponse
    {
       $file = $request->file("fileSelector");
       $uploadPath = "productupload";
       $fileName = time() . '.' . $file->getClientOriginalName();  
       
       // Upload file to server
       if($file->move($uploadPath, $fileName)){
            // File has been successfully moved          

            $batchSize = 5; // Max batch size
            $batchData = [];
            $reader = new XMLReader();
            $reader->open($uploadPath . '/'. $fileName);
            $allProductsData = [];
            $outOfStockData = [];
            $totalProductsRead = 0;
            $totalOutOfStock = 0;
            try {
                while ($reader->read()) {
                    if ($reader->nodeType == XMLReader::ELEMENT && $reader->name === 'ExportData') {
                        // Loop through all parts of ExportData
                        $innerXML = $reader->readOuterXml();
                        $innerReader = new XMLReader();
                        $innerReader->xml($innerXML);
                
                        $productData = [];
                        while ($innerReader->read()) {
                            if ($innerReader->nodeType == XMLReader::ELEMENT) {
                                // Read through ExportData tags
                                if($innerReader->name != "ExportData"){
                                    $innerNodeName = $innerReader->name;
                                    $innerNodeValue = $innerReader->readString();
                                    $productData[$innerNodeName] = $innerNodeValue;

                                    if($innerNodeName == "stock" && $innerNodeValue == 0){
                                        // Out of stock item, save for email
                                        $outOfStockData[] = $productData["name"];
                                        $totalOutOfStock = $totalOutOfStock + 1;
                                    }
                                }
                            }
                        }
                
                        $batchData[] = $productData;
                        $allProductsData[] = $productData;
                        $totalProductsRead = $totalProductsRead + 1;
                
                        if (count($batchData) >= $batchSize) {
                            // Perform batch insert
                            try {
                                DB::table('products')->insert($batchData);
                            } catch (\Exception $e) {
                                echo "<h1>Error</h1>There was an error whilst connecting to the database.<br/><br/><a href='/'>Return Home</a>";
                            }
                
                            // Clear batch data
                            $batchData = [];
                        }
                
                        $innerReader->close();
                    }
                }
                                
            } catch (\Exception $e) {
                echo "<h1>Error</h1>Incorrect XML Data detected whilst processing \"" . $file->getClientOriginalName() . "\"<br/><br/><a href='/'>Return Home</a>";
            }
            
            // Insert any remaining data
            if (!empty($batchData)) {
                try {
                    DB::table('products')->insert($batchData);
                } catch (\Exception $e) {
                    echo "<h1>Error</h1>There was an error whilst connecting to the database.<br/><br/><a href='/'>Return Home</a>";
                }
            }

            // Send out of stock email
            if ($totalOutOfStock > 0 && $request->lowStockEmail != ""){;
                // Send out of stock email.  Viewable using Mailpit http://localhost:8025
                Mail::to($request->lowStockEmail)->send(new OutOfStockProducts($outOfStockData));
            }

            // Close XML reader
            $reader->close();

            // Delete product file
            File::delete($uploadPath . '/'. $fileName);

            return view('inventory', ["products" => $allProductsData]);

       } else {
            // Error moving file
            echo "<h1>Error</h1>An error occured whilst processing \"" . $file->getClientOriginalName() . "\"<br/><br/><a href='/'>Return Home</a>";
       }   
    }
}
