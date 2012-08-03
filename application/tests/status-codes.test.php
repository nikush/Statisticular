<?php

class TestStatusCodes extends PHPUnit_Framework_TestCase
{

	/**
	 * Test that pages work in general by returning a 200 response code.
	 *
	 * @return void
	 */
    public function testPagesWork()
    {
        $this->assertEquals(200, $this->response('home@index'), 'home page not working');
        
        $this->assertEquals(200, $this->response('campuses@index'), 'campus list page not working');
        $this->assertEquals(200, $this->response('campuses@single', array('london')), 'individual campus page not working');
        
        $this->assertEquals(200, $this->response('regions@index'), 'regions page not working');
        $this->assertEquals(200, $this->response('regions@uk'), 'indiviudal region page not working');
        
        $this->assertEquals(200, $this->response('intakes@intakes_single', array('london', 'wd1111')), 'intake page not working');
        
        $this->assertEquals(200, $this->response('students@students_single', array('london', 'wd1111', 14270)), 'student page not working');
    }
    
    /**
	 * Test that pages do not work in general by returning a 404 response code.
	 *
	 * @return void
	 */
    public function testPagesDontWork()
    {
        $this->assertEquals(404, $this->response('home@broke'), 'root 404 not working (/broke)');
        $this->assertEquals(404, $this->response('campuses@single', array('broke')), 'individual campus page not working');
        $this->assertEquals(404, $this->response('regions@broke'), 'individual region page not working');
        $this->assertEquals(404, $this->response('intakes@intakes_single', array('london', 'broke')), 'intake page not working (/campuses/london/broke)');
        $this->assertEquals(404, $this->response('intakes@intakes_single', array('broke', 'broke')), 'intake page not working (/campuses/broke/broke)');
        
        $this->assertEquals(404, $this->response('students@students_single', array('london', 'wd1111', 0)), 'student page not working (/campuses/london/wd1111/14270)');
        $this->assertEquals(404, $this->response('students@students_single', array('london', 'broke', 0)), 'student page not working (/campuses/london/broke/14270)');
        $this->assertEquals(404, $this->response('students@students_single', array('broke', 'wd1111', 0)), 'student page not working (/campuses/broke/wd1111/14270)');
    }
    
    /**
     * Get the response code for a controller route.
     *
     * @param  string   $controller
     * @param  array    $params
     * @return int
     */
    private function response($controller, $params = array())
    {
        return Controller::call($controller, $params)->status();
    }

}
