<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    //RGB to gray
    public function index()
    {
    	return view('welcome');
    }

    public function imgToGreyscale(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
              'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
          ]);

          $image = $input['file'];
          $input['file'] = time().'.'.$image->getClientOriginalExtension();
          $img = Image::make($image->getRealPath());
          $img->greyscale()->save(public_path('/uploads').'/'.$input['file']);

          return redirect()->back()->with('success','Grayscale file uploaded.')->with('image', $input['file']);
    }

    //Image resizing
    public function index1()
    {
    	return view('resize');
    }

    public function resizeImage(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $image = $request->file('file');
        $input['file'] = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = public_path('/uploads');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['file']);

        return back()
            ->with('success','Image has successfully uploaded.')
            ->with('fileName',$input['file']);
    }

    //download resize image
    public function download($filename)
    {
        // Path to the resized image
        $filePath = public_path('/uploads/' . $filename);

        // Check if the file exists
        if (file_exists($filePath)) {
            // Return the file as a response with appropriate headers for download
            return response()->download($filePath, $filename);
        } else {
            // If file not found, return a 404 Not Found response
            abort(404);
        }
    }

    //convert to red, blue or green image
    public function showForm()
    {
        return view('convert');
    }

    public function convert(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'color' => 'required|in:red,green,blue',
        ]);

        $image = $request->file('image');
        $color = $request->input('color');

        // Load image using Intervention Image
        $img = Image::make($image);

        // Define the overlay color based on the selected color
        $overlayColor = ($color === 'red') ? '#ff0000' : (($color === 'green') ? '#00ff00' : '#0000ff');

        // Define color component values for the colorize effect
        $red = ($color === 'red') ? 100 : 0;
        $green = ($color === 'green') ? 100 : 0;
        $blue = ($color === 'blue') ? 100 : 0;

        // Apply the color overlay effect
        $img->colorize($red, $green, $blue);

        // Generate a unique filename
        $fileName = Str::random(10) . '.' . $image->getClientOriginalExtension();

        // Define the directory within the public directory to save the image
        $destinationPath = 'uploads/converted/';

        // Save the converted image
        $img->save(public_path($destinationPath . $fileName));

        // Pass the converted image path to the Blade view
        return view('convert')->with('convertedImagePath', $destinationPath . $fileName);
    }

    //Adjust contrast
    public function index2()
    {
        return view('contrast');
    }

    public function adjustContrast(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'contrast' => 'required|numeric|min:-100|max:100',
        ]);

        $image = $request->file('image');
        $contrast = $request->input('contrast');

        // Load image using Intervention Image
        $img = Image::make($image);

        // Adjust contrast
        $img->contrast($contrast);

        // Save the adjusted image
        $destinationPath = public_path('/uploads/');
        $fileName = time() . '.' . $image->getClientOriginalExtension();
        $img->save($destinationPath . $fileName);

        // Pass the adjusted image path to the Blade view
        return view('contrast')->with('adjustedImagePath', asset('/uploads/' . $fileName));
    }
}
