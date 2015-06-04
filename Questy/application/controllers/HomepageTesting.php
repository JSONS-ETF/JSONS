<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: Stevan
 * Date: 6/4/2015
 * Time: 9:43 PM
 */

class HomepageTesting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('newsfeed','',TRUE);
    }

    public function index()
    {
        $this->load->library('unit_test');

        $this->test1();
        $this->test2();
        $this->test3();

        echo $this->unit->report();
    }

    function test1()
    {
        $questions = $this->newsfeed->getQuestions(2, 55);
        $this->unit->run(count($questions), 10, 'Question test');
    }

    function test2()
    {
        $statuses = $this->newsfeed->getStatuses(2, 55);
        $this->unit->run(count($statuses), 10, 'Status test');
    }

    function test3()
    {
        $id = $this->newsfeed->findUser('Wiggly');
        $this->unit->run($id, 5, 'Status test');
    }
}

?>