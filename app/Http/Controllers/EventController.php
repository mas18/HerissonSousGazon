<?php 

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Repository\EventRepository;


class EventController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

    protected $eventRepository;

    protected $nbrPerPage = 3;

    public function __construct(EventRepository $eventRepository)
    {
        // $this->middleware('admin',['except'=>'index']);
        $this->eventRepository = $eventRepository;
    }

    public function index()
    {
       $events = $this->eventRepository->getPaginate($this->nbrPerPage);
       return view('event/event')->with('events', $events);
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
  public function store(EventRequest $request)
  {
      $this->eventRepository->store($request->all());
      return redirect()->route('event.show');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
     $event = $this->eventRepository->getById($id);
     return view('event')->with('events', $event);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit(EventRequest $request)
  {
      $this->eventRepository->update($request->all());
      return redirect()->route('event.show');
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