<?php

class Campuses_Controller extends Base_Controller
{
    /**
     * List all campuses.
     *
     * @return string
     */
	public function action_index()
	{
	    $campuses = Campus::order_by('name', 'asc')->get();
		return View::make('campuses.list')->with('campuses', $campuses);
	}
    
    /**
     * Show a single campus and list all its intakes.
     *
     * @return string
     */
	public function action_single($slug)
	{
	    $campus = Campus::where('slug', '=', $slug)->take(1)->first();
	    if (is_null($campus)) {
	        return $this->show_404($slug);
	    }
	    
        $intakes = $campus->intakes()->order_by('start_date', 'asc')->get();
        
        Section::inject('title', $campus->name);
        return View::make('campuses.single')
            ->with('campus_name', $campus->name)
            ->with('intakes', $intakes);
	}

    /**
     * Show the campus not found page with a 404 header.
     *
     * @return Response
     */
	protected function show_campus_404($slug)
	{
	    $view = View::make('thing-not-found')
	        ->with('thing', 'campus')
	        ->with('name', $slug)
	        ->with('url', URL::to('campuses'));
	    return Response::make($view, 404, array());
	}

}
