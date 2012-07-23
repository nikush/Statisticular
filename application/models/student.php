<?php

class Student extends Eloquent
{
    public static $table = 'students';
    public static $key = 'id';
    
    public function get_full_name()
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    public function get_age()
    {
        list($year, $month, $day) = explode("-", $this->birth_date);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($day_diff < 0 || $month_diff < 0)
        $year_diff--;
        return $year_diff;
    }
    
    public function get_nationality()
    {
        return DB::table('nationalities')->where('id', '=', $this->nationality_fk)->first(array('name'));
    }
    
    public function is_male()
    {
        return ((int) $this->gender) == 1;
    }
    
    public function is_female()
    {
        return ((int) $this->gender) == 0;
    }
    
    public function get_on_visa()
    {
        return ((int) $this->visa) == 1;
    }

    public function intakes()
    {
        return $this->has_many_and_belongs_to('Intake', 'intake_has_student', 'student_fk', 'intake_fk')->get();
    }
}
