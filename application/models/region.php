<?php

class Region extends Eloquent
{
    public static $table = 'regions';
    public static $key = 'id';

    public function campuses()
    {
        return $this->has_many_and_belongs_to('Campus', 'region_has_campus', 'region_fk', 'campus_fk')->get();
    }
}
