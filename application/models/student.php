<?php

class Student extends Eloquent
{
    public static $table = 'students';
    public static $key = 'id';
    
    /**
     * Get the students full name
     *
     * @return string
     */
    public function get_full_name()
    {
        return $this->first_name.' '.$this->last_name;
    }
    
    /**
     * Get the students age
     *
     * @return int
     */
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
    
    /**
     * Get the students nationality
     *
     * @return string
     */
    public function get_nationality()
    {
        return DB::table('nationalities')->where('id', '=', $this->nationality_fk)->first(array('name'));
    }
    
    /**
     * Indicates if the student is a male.
     *
     * @return boolean
     */
    public function is_male()
    {
        return ((int) $this->gender) == 1;
    }
    
    /**
     * Opposite of `is_male()`.
     *
     * @return boolean
     */
    public function is_female()
    {
        return ((int) $this->gender) == 0;
    }
    
    /**
     * Indicates if the student is on a visa.
     *
     * @return boolean
     */
    public function get_on_visa()
    {
        return ((int) $this->visa) == 1;
    }

    /**
     * Get all intakes the student belongs to.
     *
     * @return array
     */
    public function intakes()
    {
        return $this->has_many_and_belongs_to('Intake', 'intake_has_student', 'student_fk', 'intake_fk')->get();
    }
}
