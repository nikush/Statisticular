<?php

class Intakes_Controller extends Campuses_Controller
{

    public function action_route($campus_slug, $intake_slug)
    {
        $campus = parent::get_campus($campus_slug);
        
        if (is_null($campus))  {
            // campus not found
            return parent::show_404($campus_slug);
        }
        
        // show specific intake
        return $this->get_intake($intake_slug, $campus);
    }
    
    private function get_intake($intake_slug, $campus)
    {
        $intake_name = Str::upper($intake_slug);
        $intake = $campus->intakes()->where('name', '=', $intake_name)->take(1)->first();
        
        if (is_null($intake)) {
            $campus_name = Str::lower($campus->name);
            $view = View::make('thing-not-found')
                ->with('name', $intake_slug)
                ->with('thing', 'intake')
                ->with('url', URL::to("campuses/{$campus_name}"));
            return $view;
        }
    
        Section::inject('title', $intake->name);
        return View::make('intakes.individual')
            ->with('intake', $intake->name)
            ->with('campus', $campus->name);
    }

}
