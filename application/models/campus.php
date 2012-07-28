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

    public static function find_by_name($slug)
    {
        $name = Str::title($slug);
	    return Campus::where('name', '=', $name)->take(1)->first();
    }
}
