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
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);
        if ($url_result !== true) return $url_result;
        
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
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);
        if ($url_result !== true) return $url_result;
        
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
