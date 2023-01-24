<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
class PortfolioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $portfolios = Portfolio::latest()->paginate(5);
  
        return view('portfolio.index',compact('portfolios'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Auth()->user();
        $portfolio = new Portfolio();
        request()->validate([
            'name' => 'required|string|max:255',
        ]);
        $portfolio->name = $request->name;
        $portfolio->date = $request->date;

        if ($request->file('image')) {
            request()->validate([
                'image' => 'mimes:jpg,jpeg,gif,png,bmp',
            ]);
            $file = $request->file('image');
           
            $image = Image::make($file);
          
            // // Crop and resize image to fixed size
             $image->resize(128, 128, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
             });

            // // Orientation fix with intervention
            $image->orientate();
            $destinationPath = public_path(config('app.basepath')).strtolower($file->getClientOriginalName());
            //save image
            $image->save($destinationPath);
            //store path in database
            $portfolio->image = config('app.basepath').strtolower($file->getClientOriginalName());
        }
        $portfolio->user_id = $user->id;
        // $portfolio->views = 100;
        $portfolio->save();
        return redirect()->route('portfolio.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function edit(Portfolio $portfolio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        //
    }
}
