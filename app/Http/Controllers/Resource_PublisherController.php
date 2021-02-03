<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Resource_PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:book_details-list|book_details-create|book_details-edit|book_details-delete', ['only' => ['index','show']]);
         $this->middleware('permission:book_details-create', ['only' => ['create','store']]);
         $this->middleware('permission:book_details-edit', ['only' => ['update_detail']]);
         $this->middleware('permission:book_details-delete', ['only' => ['delete']]);
         $this->middleware('permission:data-import', ['only' => ['import']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = book_cat::orderBy('id','ASC')->paginate(5);
        return view('books_details.book_publisher.index',compact('details'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required',
        ]);
    
        $form_data = array(
            'category' =>  $request->name,   
        );
        book_cat::create($form_data);
        return redirect()->route('books_category.index')->with('success','Details created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update_detail(Request $request)
    {
         request()->validate([
            'name_update' => 'required',
        ]);
    
        $detail=book_cat::find($request->id_update);
        $detail->category=$request->name_update;
        $detail->save();
        return redirect()->route('books_category.index')->with('success','Details Updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $detail=book_cat::find($request->id_delete);
        $detail->delete();
        return redirect()->route('books_category.index')->with('success','Details Removed successfully.');
    }
}
