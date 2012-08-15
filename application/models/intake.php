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
    
    /**
     * Get all allingments set for this intake.
     *
     * @return array
     */
    public function assignments()
    {
        return $this->has_many_and_belongs_to('Assignment', 'intake_has_assignment', 'intake_fk', 'assignment_fk');
    }

    /**
     * Get breakdown of ages for this intake.
     *
     * @return  array
     */
    public function get_ages()
    {
        $data = DB::query('SELECT
            SUM(IF(age < 21, 1, 0)) as "Under 21",
            SUM(IF(age BETWEEN 21 and 24, 1, 0)) as "21 - 24",
            SUM(IF(age BETWEEN 25 and 29, 1, 0)) as "25 - 29",
            SUM(IF(age >= 30, 1, 0)) as "30 And Over"
        FROM
            (SELECT
                TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age
            FROM
                students
            inner join intake_has_student ON intake_has_student.student_fk = students.id
                and intake_has_student.intake_fk = '.$this->id.') as ages;');
        return (array) $data[0];
    }

    /**
     * Get the breakdown of student nationalities for this intake.
     *
     * @return array
     */
    public function get_nationalities()
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
            ->where('intake_has_student.intake_fk', '=', $this->id)
            ->group_by('nationality_fk')
            ->get(array('nationalities.name as nationality_name', DB::raw('count(students.nationality_fk) as students')));
    }
}
