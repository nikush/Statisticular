<?php
class Assignments_Controller extends Intakes_Controller
{
    /**
     * Show the list of assignments for the specified intake.
     *
     * @return string
     */
    public function action_assignments_index($campus_slug, $intake_slug)
    {
        $campus = Campus::where('slug', '=', $campus_slug)->take(1)->first();
        if (is_null($campus)) {
            return $this->show_campus_404($campus_slug);
        }
        
        $intake = $campus->intakes()->where('slug', '=', $intake_slug)->take(1)->first();
        if (is_null($intake)) {
            $campus_name = Str::lower($campus->name);
            return $this->show_intake_404($intake_slug, $campus_name);
        }
        
        $assignments = $intake->assignments()->get();
        
        Section::inject('title', $intake->name.': Assignments');
        
        return View::make('assignments.list')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('assignments', $assignments);
    }
    
    /**
     * Show a single assignment for a particular intake.
     *
     * @return string
     */
    public function action_assignments_single($campus_slug, $intake_slug, $assignment_slug)
    {
        $campus = Campus::where('slug', '=', $campus_slug)->take(1)->first();
        if (is_null($campus)) {
            return $this->show_campus_404($campus_slug);
        }
        
        $intake = $campus->intakes()->where('slug', '=', $intake_slug)->take(1)->first();
        if (is_null($intake)) {
            $campus_name = Str::lower($campus->name);
            return $this->show_intake_404($intake_slug, $campus_name);
        }
        
        $assignment_code = Str::upper($assignment_slug);
        $assignment = $intake->assignments()->where('assignments.code', '=', $assignment_code)->take(1)->first();
        
        if (is_null($assignment)) {
            $view = View::make('thing-not-found')
                ->with('name', $assignment_slug)
                ->with('thing', 'assignment')
                ->with('url', URL::to("campuses/{$campus->slug}/{$intake->slug}/assignments"));
            return Response::make($view, 404, array());
        }
        
        return View::make('assignments.single')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('assignment', $assignment);
    }
}
