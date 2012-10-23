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

        Section::inject('crumbs', BreadCrumbs::assignmentList($campus));
        Section::inject('title', $intake->name.': Assignments');
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Assignments'));

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
        $assignment_id = DB::table('assignments')
            ->where('code', '=', $assignment_code)->take(1)->only('id');

        $assignment = $intake->assignments()
            ->where('assignment_fk', '=', $assignment_id)->take(1)->first();

        if (is_null($assignment)) {
            $view = View::make('thing-not-found')
                ->with('name', $assignment_slug)
                ->with('thing', 'assignment')
                ->with('url', URL::to("campuses/{$campus->slug}/{$intake->slug}/assignments"));
            return Response::make($view, 404, array());
        }

        $assignment_tmp = array();
        foreach ($assignment->grades() as $student) {
            $assignment_tmp[$student->name] = $student->grade;
        }

        $graph = new BarGraph(800, 400, $assignment_tmp);

        Section::inject('main', $graph->render());
        Section::inject('crumbs', BreadCrumbs::assignmentSingle($campus, $intake));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake));
        return View::make('assignments.single')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('assignment', $assignment);
    }
}
