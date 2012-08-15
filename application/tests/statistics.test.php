<?php
class TestStatistics extends PHPUnit_Framework_TestCase
{
    /**
     * Test that intake nationality statistics return expected figures.
     *
     * @return void
     */
    public function testIntakeNationalityStats()
    {
        $intake = Intake::find(1);  // wd1111
        $data = $intake->get_nationalities();

        /* $data is an array of Student model objects.
        Rather than going throught the hassel of creating student mock objects,
        we just extract the data we're interested in and make sure it matches.
        */
        $actual = array();
        foreach($data as $nationality)
        {
            $record = new stdClass;
            $record->nationality_name = $nationality->nationality_name;
            $record->students = $nationality->students;

            $actual[]= $record;
        }

        $uk = (object) array('nationality_name' => 'UK', 'students' => 5);
        $eu = (object) array('nationality_name' => 'EU', 'students' => 1);
        $int = (object) array('nationality_name' => 'International', 'students' => 2);
        $expected = array(
            $uk,
            $eu,
            $int
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that intake age statisticts return expected figures.
     *
     * @return void
     */
    public function testIntakeAgeStats()
    {
        $intake = Intake::find(1);  // wd1111
        $actual = $intake->get_ages();

        $expected = array(
            'under 21' => 2,
            '21 - 24' => 2,
            '25 - 29' => 2,
            '30 and over' => 2
        );

        $this->assertEquals($expected, $actual);
    }
}
