<?php

class Intakes_Controller extends Campuses_Controller
{

    public function action_route()
    {
        $args = func_get_args();
        $num_args = count($args);
        $campus_slug = array_shift($args);
        
        $campus = parent::get_campus($campus_slug);
        if (is_null($campus))
        {
            // campus not found
            return parent::show_404($campus_slug);
        }
        
        if ($num_args == 1)
        {
            // list all intakes
            return $this->list_intakes($campus);
        } else
        {
            // 2 args
            // show specific intake
            $intake_slug = array_shift($args);
            return $this->get_intake($intake_slug, $campus);
        }
    }
    
    private function list_intakes($campus)
    {
        // list all intakes for campus
        $intakes = $campus->intakes()->order_by('start_date', 'asc')->get();
        $data = array(
            'campus' => $campus->name,
            'intakes' => $intakes
        );
        
        return View::make('intakes.list')->with($data);
    }
    
    private function get_intake($intake_slug, $campus)
    {
        $intake_name = Str::upper($intake_slug);
        $intake = $campus->intakes()->where('name', '=', $intake_name)->take(1)->first();
        
        if (is_null($intake))
        {
            $campus_name = Str::lower($campus->name);
            $view = View::make('thing-not-found')
                ->with('name', $intake_slug)
                ->with('thing', 'intake')
                ->with('url', URL::to("campuses/{$campus_name}/intakes"));
            return $view;
        }
    
        Section::inject('title', $intake->name);
        return View::make('intakes.individual')
            ->with('intake', $intake->name)
            ->with('campus', $campus->name);
    }

}
