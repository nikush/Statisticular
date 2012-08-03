<?php

class Intakes_Controller extends Campuses_Controller
{
    /**
     * Show a single intake and list all its students.
     *
     * @return string
     */
    public function action_intakes_single($campus_slug, $intake_slug)
    {
        $campus = Campus::where('slug', '=', $campus_slug)->take(1)->first();
        
        if (is_null($campus))  {
            // campus not found
            return $this->show_campus_404($campus_slug);
        }
        
        // show specific intake
        $intake = $campus->intakes()->where('slug', '=', $intake_slug)->take(1)->first();
        
        if (is_null($intake)) {
            $campus_name = Str::lower($campus->name);
            return $this->show_intake_404($intake_slug, $campus_name);
        }
        
        $students = $intake->students()->get();
    
        Section::inject('title', $intake->name);
        return View::make('intakes.single')
            ->with('intake', $intake->name)
            ->with('campus', $campus)
            ->with('students', $students);
    }
    
    
    /**
     * Show the intake not found page with a 404 header.
     *
     * @return Response
     */
    protected function show_intake_404($intake_slug, $campus_name)
    {
        $view = View::make('thing-not-found')
                ->with('name', $intake_slug)
                ->with('thing', 'intake')
                ->with('url', URL::to("campuses/{$campus_name}"));
            return Response::make($view, 404, array());
    }

}
