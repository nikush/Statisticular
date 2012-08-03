<?php

class Intake extends Eloquent
{
    public static $table = 'intakes';
    public static $key = 'id';
    public static $timestamps = false;

    /**
     * Get all students for this intake.
     *
     * @return array
     */
    public function students()
    {
        return $this->has_many_and_belongs_to('Student', 'intake_has_student', 'intake_fk', 'student_fk');
    }
}
