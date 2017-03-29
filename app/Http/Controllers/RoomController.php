<?php 

namespace App\Http\Controllers;
use App\Http\Requests\RoomRequest;
use App\Repository\ScheduleRepository;

class RoomController extends Controller {


    protected $scheduleRepository;


    public function __construct(ScheduleRepository $scheduleRepository)
    {
        $this->middleware('admin');
        $this->scheduleRepository = $scheduleRepository;
    }


  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(RoomRequest $request)
  {
      $this->scheduleRepository->storeRoom($request->all());
      return redirect()->route('schedule.show');
  }


  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>