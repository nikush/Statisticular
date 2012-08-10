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
     * Show the nationality statistics of an intake.
     *
     * @return string
     */
    public function action_nationalities($campus_slug, $intake_slug)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);
        
        if ($url_result !== true) return $url_result;
        
        Section::inject('crumbs', BreadCrumbs::intakeSingle($campus));
        Section::inject('side-nav', Sidebar::getIntake($campus, $intake, 'Nationalities'));
        return View::make('intakes.nationalities')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('nationalities', $this->get_nationalities($intake->id));
    }
    
    /**
     * Check that parameters passed into url are valid entries in the database.
     *
     * If they are valid, the corresponding models will be instanciated and 
     * assigned to the $campus and $intake parameters, and the method will 
     * true, else the error response object will be returned.
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
     * Get the breakdown of student nationalities for the specified intake.
     *
     * @return array
     */
    public function get_nationalities($intake_id)
    {
        /*
        select nationalities.name as nationality, count(students.nationality_fk) as students
        from students
        inner join intake_has_student
            on intake_has_student.student_fk = students.id
        inner join nationalities
            on students.nationality_fk = nationalities.id
        where intake_has_student.intake_fk = ?
        group by nationality_fk;
        */
        
        return Student::join('intake_has_student', 'intake_has_student.student_fk', '=', 'students.id')
            ->join('nationalities', 'students.nationality_fk', '=', 'nationalities.id')
            ->where('intake_has_student.intake_fk', '=', $intake_id)
            ->group_by('nationality_fk')
            ->get(array('nationalities.name as nationality_name', DB::raw('count(students.nationality_fk) as students')));
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
