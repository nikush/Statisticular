<?php

class Campus extends Eloquent
{
    public static $table = 'campuses';
    public static $key = 'id';
    
    /**
     * Indicates wether the campus in degree centre.
     *
     * @return boolean
     */
    public function is_degree_centre()
    {
        return ((int) $this->degree_centre == 1);
    }
    
    /**
     * Get all intakes for this campus.
     *
     * @return array
     */
    public function intakes()
    {
        return $this->has_many('Intake', 'campus_fk');
    }
}
