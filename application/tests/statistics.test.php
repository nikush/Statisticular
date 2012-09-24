<?php
class TestStatistics extends PHPUnit_Framework_TestCase
{
    private $intake;

    public function setUp()
    {
        $this->intake = Intake::find(1);    // wd1111
    }

    /**
     * Test that intake nationality statistics return expected figures.
     *
     * @return void
     */
    public function testIntakeNationalityStats()
    {
        $data = $this->intake->get_nationalities();

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
        $actual = $this->intake->get_ages();

        $expected = array(
            'under 21' => 2,
            '21 - 24' => 2,
            '25 - 29' => 2,
            '30 and over' => 2
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that intake gender statistics return expected figures.
     *
     * @return void
     */
    public function testIntakeGenderStats()
    {
        $actual = $this->intake->get_genders();

        $expected = new stdClass;
        $expected->males = 7;
        $expected->females = 1;

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that intake grade statistics return expected figures.
     *
     * @return void
     */
    public function testIntakeGradeStats()
    {
        $assignment = $this->intake->assignments()
            ->where('assignment_fk', '=', 1)->take(1)->first();    // sdk

        $actual = $assignment->grades();

        $data = array(
            array(
                'id' => 14270,
                'name' => 'Bender Rodriguez',
                'grade' => 3,
            ),
            array(
                'id' => 14271,
                'name' => 'Philip Fry',
                'grade' => 5,
            ),
            array(
                'id' => 14272,
                'name' => 'Walter White',
                'grade' => null,
            ),
            array(
                'id' => 14273,
                'name' => 'Harvey Spectar',
                'grade' => null,
            ),
            array(
                'id' => 14274,
                'name' => 'Eric Cartman',
                'grade' => null,
            ),
            array(
                'id' => 14275,
                'name' => 'Eddard Stark',
                'grade' => null,
            ),
            array(
                'id' => 14276,
                'name' => 'Tarunga Lila',
                'grade' => null,
            ),
            array(
                'id' => 14277,
                'name' => 'Jesse Pinkman',
                'grade' => null,
            ),
        );

        $expected = array();
        foreach($data as $student) {
            $expected[] = (object) $student;
        }

        $this->assertEquals($expected, $actual);
    }

    /**
     * Test that intake attendance statistics return expected figures.
     *
     * @return void
     */
    public function testIntakeAttendanceStats()
    {
        $actual = $this->intake->get_attendance();

        $lesson1 = new stdclass;
        $lesson1->id = '1';
        $lesson1->name = 'Lecture 1';
        $lesson1->timestamp = '2012-09-24 12:00:00';
        $lesson1->attended = '2';
        $lesson2 = new stdclass;
        $lesson2->id = '2';
        $lesson2->name = 'Lecture 2';
        $lesson2->timestamp = '2012-09-24 13:00:00';
        $lesson2->attended = '1';

        $expected = array($lesson1, $lesson2);

        $this->assertEquals($expected, $actual);
    }
}
