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
        $this->assertEquals(200, $this->response('campuses@individual', array('london')), 'individual campus page not working');
        
        $this->assertEquals(200, $this->response('regions@index'), 'regions page not working');
        $this->assertEquals(200, $this->response('regions@uk'), 'indiviudal region page not working');
        
        $this->assertEquals(200, $this->response('intakes@route', array('london', 'wd1111')), 'intake page not working');
    }
    
    /**
	 * Test that pages do not work in general by returning a 404 response code.
	 *
	 * @return void
	 */
    public function testPagesDontWork()
    {
        $this->assertEquals(404, $this->response('home@broke'), 'root 404 not working (/broke)');
        $this->assertEquals(404, $this->response('campuses@individual', array('broke')), 'individual campus page not working');
        $this->assertEquals(404, $this->response('regions@broke'), 'individual region page not working');
        $this->assertEquals(404, $this->response('intakes@route', array('london', 'broke')), 'intake page not working (/campuses/london/broke)');
        $this->assertEquals(404, $this->response('intakes@route', array('broke', 'broke')), 'intake page not working (/campuses/broke/broke)');
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
