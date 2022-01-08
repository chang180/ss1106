<?php

namespace App\Http\Controllers;

// use App\Models\Entities\Car;
use App\Repositories\CarRepository;
use Illuminate\Http\Request;

class CarController extends Controller
{

    private $carReporsity;
    public function __construct(CarRepository $carReporsity){
        $this->carReporsity = $carReporsity;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = $this->carReporsity->getAll();
        $data=array(
            'cars' => $cars,
            'lastpage' => $cars->lastPage(),
        );
        return view('car.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        dd($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except('_token', '_method');
        $this->carReporsity->addOne($input);
        return redirect()->route('car.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id=3;
        $data = $this->carReporsity->getById($id);
        dd($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Remove selected items.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function delAll(Request $request)
    {
        dd($request);
        $ids = $request->input('ids');
        // $this->carReporsity->deleteAll($ids);
        // return redirect()->route('car.index');
        // $current_page = ($request->current_page > $lastpage) ? $lastpage : $request->current_page;

        // return redirect('/cars?page=' . $current_page);
    }
}
