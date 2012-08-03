<?php
class Students_Controller extends Intakes_Controller
{
    public function action_students_index($campus_slug, $intake_slug, $student_num)
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
        
        $student = $intake->students()->where('students.id', '=', $student_num)->take(1)->first();
        if (is_null($student)) {
            $view = View::make('thing-not-found')
                ->with('name', $student_num)
                ->with('thing', 'student')
                ->with('url', URL::to("campuses/{$campus->slug}/{$intake->slug}"));
            return Response::make($view, 404, array());
        }
        
        Section::inject('title', $student->get_full_name());
        
        return View::make('students.single')
            ->with('campus', $campus)
            ->with('intake', $intake)
            ->with('student', $student);
    }
}
