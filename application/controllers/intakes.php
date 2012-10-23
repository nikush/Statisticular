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
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);

        if ($url_result !== true) return $url_result;

        $students = $intake->students()->get();

        Section::inject('title', $intake->name);
        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Students'));
        return View::make('intakes.single')
            ->with('intake', $intake->name)
            ->with('campus', $campus)
            ->with('students', $students);
    }

    /**
     * Show the age statistics of an intake.
     *
     * @return  string
     */
    public function action_ages($campus_slug, $intake_slug)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);

        if ($url_result !== true) return $url_result;

        $graph = new BarGraph(800, 400, $intake->get_ages());

        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Ages'));
        Section::inject('main', $graph->render());
        return View::make('intakes.ages')
            ->with('campus', $campus)
            ->with('intake', $intake);
    }

    /**
     * Show the nationality statistics of an intake.
     *
     * @return string
     */
    public function action_nationalities($campus_slug, $intake_slug)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);

        if ($url_result !== true) return $url_result;

        $nationalities = array();
        $data = $intake->get_nationalities();
        foreach($data as $obj) {
            $nationalities[$obj->nationality_name] = $obj->students;
        }

        $graph = new BarGraph(800, 400, $nationalities);

        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Nationalities'));
        Section::inject('main', $graph->render());
        return View::make('intakes.nationalities')
            ->with('campus', $campus)
            ->with('intake', $intake);
    }

    /**
     * Show the gender statistics of an intake.
     *
     * @return string
     */
    public function action_genders($campus_slug, $intake_slug)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);

        if ($url_result !== true) return $url_result;

        $genders = (array) $intake->get_genders();
        $graph = new BarGraph(800, 400, $genders);

        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Genders'));
        Section::inject('main', $graph->render());
        return View::make('intakes.genders')
            ->with('campus', $campus)
            ->with('intake', $intake);
    }

    /**
     * Show attendance statistics for an intake.
     *
     * @return  string
     */
    public function action_attendance($campus_slug, $intake_slug)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);

        if ($url_result !== true) return $url_result;

        $tmp = $intake->get_attendance();
        $attendance = array();
        foreach ($tmp as $lecture) {
            $attendance[$lecture->name] = $lecture->attended;
        }

        $graph = new LineGraph(800, 400, $attendance);

        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Attendance'));
        Section::inject('main', $graph->render());
        return View::make('intakes.attendance')
            ->with('campus', $campus)
            ->with('intake', $intake);
    }

    /**
     * Check that parameters passed into url are valid entries in the database.
     *
     * If they are valid, the corresponding models will be instanciated and
     * assigned to the $campus and $intake parameters, and the method will
     * return true, else the error response object will be returned.
     *
     * @param   string  $campus_slug
     * @param   string  $intake_slug
     * @param   $campus reference
     * @param   $intake reference
     * @return  boolean
     */
    protected function validate_url($campus_slug, $intake_slug, &$campus, &$intake)
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

        return true;
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
