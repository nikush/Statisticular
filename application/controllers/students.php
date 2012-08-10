<?php
class Students_Controller extends Intakes_Controller
{
    /**
     * Show a single student.
     *
     * @return string
     */
    public function action_students_single($campus_slug, $intake_slug, $student_num)
    {
        $url_result = $this->validate_url($campus_slug, $intake_slug, $campus, $intake);
        if ($url_result !== true) return $url_result;
        
        $student = $intake->students()->where('students.id', '=', $student_num)->take(1)->first();
        if (is_null($student)) {
            $view = View::make('thing-not-found')
                ->with('name', $student_num)
                ->with('thing', 'student')
                ->with('url', URL::to("campuses/{$campus->slug}/{$intake->slug}"));
            return Response::make($view, 404, array());
        }
        
        Section::inject('title', $student->get_full_name());
        Section::inject('crumbs', BreadCrumbs::studentSingle($campus, $intake));
        Section::inject('side-nav', Sidebar::getStudent($campus, $intake, $student));
        
        return View::make('students.single')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('student', $student);
    }
}
