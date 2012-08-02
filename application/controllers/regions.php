<?php

class Regions_Controller extends Base_Controller {

	public function action_index()
	{
	    $regions = Region::order_by('name', 'asc')->get();
	    return View::make('regions.index')->with('regions', $regions);
	}
	
	// catch all method for any region name
	public function __call($method_name, $args)
	{
	    // remove 'action_' from the start
	    $region_slug = substr($method_name, 7);
	    $region = Region::where('slug', '=', $region_slug)->take(1)->first();
	    if (is_null($region))
	    {
	        $view = View::make('thing-not-found')
	            ->with('name', $region_slug)
	            ->with('thing', 'region')
	            ->with('url', URL::to('regions'));
	        Return Response::make($view, 404, array());
	    }
	    
	    Section::inject('title', $region->name);
	    return View::make('regions.individual')->with('region', $region);
	}

}
