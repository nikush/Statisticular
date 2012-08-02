<?php

class Campus extends Eloquent
{
    public static $table = 'campuses';
    public static $key = 'id';
    
    public function is_degree_centre()
    {
        return ((int) $this->degree_centre == 1);
    }
    
    public function intakes()
    {
        return $this->has_many('Intake', 'campus_fk');
    }
}
