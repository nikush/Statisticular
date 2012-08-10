<?php

class Regions_Controller extends Base_Controller
{
    /**
     * List all regions.
     *
     * @return string
     */
	public function action_index()
	{
	    $regions = Region::order_by('name', 'asc')->get();
	    Section::inject('crumbs', BreadCrumbs::regionList());
	    Section::inject('side-nav', Sidebar::getCampuses('Regions'));
	    return View::make('regions.list')->with('regions', $regions);
	}
	
	/**
	 * Catch all method for any region name.
	 *
	 * Shows page for a single region.
	 *
	 * @return string
	 */
	public function __call($method_name, $args)
	{
	    // remove 'action_' from the start
	    $region_slug = substr($method_name, 7);
	    $region = Region::where('slug', '=', $region_slug)->take(1)->first();
	    if (is_null($region)) {
	        $view = View::make('thing-not-found')
	            ->with('name', $region_slug)
	            ->with('thing', 'region')
	            ->with('url', URL::to('regions'));
	        Return Response::make($view, 404, array());
	    }
	    
	    Section::inject('title', $region->name);
	    Section::inject('crumbs', BreadCrumbs::regionSingle());
	    return View::make('regions.single')->with('region', $region);
	}

}
