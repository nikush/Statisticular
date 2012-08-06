<?php
class TestStatistics extends PHPUnit_Framework_TestCase
{
    /**
     * Test that intake nationality statistics return expected figures.
     *
     * @return void
     */
    public function testIntakdeNationalityStats()
    {
        $controller = new Intakes_Controller();
        $data = $controller->get_nationalities(1); // wd1111
        
        $stats = array();
        foreach($data as $nationality)
        {
            $record = new stdClass;
            $record->nationality_name = $nationality->nationality_name;
            $record->students = $nationality->students;
            
            $stats[]= $record;
        }
        
        $uk = (object) array('nationality_name' => 'UK', 'students' => 5);
        $eu = (object) array('nationality_name' => 'EU', 'students' => 1);
        $int = (object) array('nationality_name' => 'International', 'students' => 2);
        $expected = array(
            $uk,
            $eu,
            $int
        );
        
        $this->assertEquals($expected, $stats);
    }
}
