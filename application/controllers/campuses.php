<?php

class Campuses_Controller extends Base_Controller
{

	public function action_index()
	{
	    $campuses = Campus::order_by('name', 'asc')->get();
		return View::make('campuses.index')->with('campuses', $campuses);
	}
	
	public function action_individual($slug)
	{
	    $campus = Campus::where('slug', '=', $slug)->take(1)->first();
	    if (is_null($campus)) {
	        return $this->show_404($slug);
	    } else {
	        $intakes = $campus->intakes()->order_by('start_date', 'asc')->get();
	        
	        Section::inject('title', $campus->name);
	        return View::make('campuses.individual')
	            ->with('campus_name', $campus->name)
	            ->with('intakes', $intakes);
	    }
	}
	
	protected function show_404($slug)
	{
	    $view = View::make('thing-not-found')
	        ->with('thing', 'campus')
	        ->with('name', $slug)
	        ->with('url', URL::to('campuses'));
	    return Response::make($view, 404, array());
	}

}
