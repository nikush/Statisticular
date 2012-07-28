<?php

class Campuses_Controller extends Base_Controller {

	public function action_index()
	{
	    $campuses = Campus::order_by('name', 'asc')->get();
		return View::make('campuses.index')->with('campuses', $campuses);
	}
	
	public function action_individual($slug)
	{
	    $campus = $this->get_campus($slug);
	    if (is_null($campus))
	    {
	        return $this->show_404($slug);
	    } else
	    {
	        Section::inject('title', $campus->name);
	        return View::make('campuses.individual')->with('campus_name', $campus->name);
	    }
	}
	
	protected function get_campus($slug)
	{
	    return Campus::find_by_name($slug);
	}
	
	protected function show_404($slug)
	{
	    $view = View::make('campuses.404')->with('name', $slug);
	    return Response::make($view, 404, array());
	}

}
