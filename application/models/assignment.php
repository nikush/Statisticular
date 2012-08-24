<?php

class Assignment extends Eloquent
{
    public static $key = 'id';
    public static $table = 'intake_has_assignment';

    private $name;
    private $code;

    /**
     * Get the intake object this assignment belongs to.
     *
     * @return Intake
     */
    public function intake()
    {
        return $this->belongs_to('Intake', 'intake_fk');
    }

    /**
     * Get the name of this assignment.
     *
     * @return string
     */
    public function name()
    {
        if (is_null($this->name)) $this->get_data();
        return $this->name;
    }

    /**
     * Get the shorthand code for this assignment.
     *
     * @return string
     */
    public function code()
    {
        if (is_null($this->code)) $this->get_data();
        return $this->code;
    }

    /**
     * Get the name and code for the assignment.
     *
     * @return void
     */
    private function get_data()
    {
        $data = DB::table('assignments')
            ->where('id', '=', $this->assignment_fk)
            ->take(1)->first(array('name', 'code'));

        $this->name = $data->name;
        $this->code = $data->code;
    }
}
