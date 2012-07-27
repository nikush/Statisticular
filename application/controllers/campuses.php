<?php

class Campuses_Controller extends Base_Controller {

	public function action_index()
	{
	    $campuses = Campus::order_by('name', 'asc')->get();
		return View::make('campuses.index')->with('campuses', $campuses);
	}
	
	public function action_individual($slug)
	{
	    $name = Str::title($slug);
	    $campus = Campus::where('name', '=', $name)->take(1)->first();
	    
	    if (is_null($campus))
	    {
	        $view = View::make('campuses.404')->with('name', $slug);
	        return Response::make($view, 404, array());
	    } else
	    {
	        Section::inject('title', $campus->name);
	        return View::make('campuses.individual')->with('campus_name', $campus->name);
	    }
	}

}
