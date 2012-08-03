<?php

class Intakes_Controller extends Campuses_Controller
{

    public function action_route($campus_slug, $intake_slug)
    {
        $campus = Campus::where('slug', '=', $campus_slug)->take(1)->first();
        
        if (is_null($campus))  {
            // campus not found
            return parent::show_404($campus_slug);
        }
        
        // show specific intake
        return $this->get_intake($intake_slug, $campus);
    }
    
    private function get_intake($intake_slug, $campus)
    {
        $intake = $campus->intakes()->where('slug', '=', $intake_slug)->take(1)->first();
        
        if (is_null($intake)) {
            $campus_name = Str::lower($campus->name);
            $view = View::make('thing-not-found')
                ->with('name', $intake_slug)
                ->with('thing', 'intake')
                ->with('url', URL::to("campuses/{$campus_name}"));
            return Response::make($view, 404, array());
        }
    
        Section::inject('title', $intake->name);
        return View::make('intakes.individual')
            ->with('intake', $intake->name)
            ->with('campus', $campus);
    }

}
