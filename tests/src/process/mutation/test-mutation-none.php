<?php


/**
 * Class mutationNoneTest
 *
 * @package Andyp_processor
 */

/**
 * @testdox Testing mutation 'none'
 */
class mutationNoneTest extends WP_UnitTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->class_instance = new \ue\mutation\none;
    }

    public function tearDown()
    {
        $this->remove_added_uploads();
        parent::tearDown();
    }
    /**
     * @test
     *
     * @testdox Testing class exists and returns an object.
     *
     */
    public function test_mutation_none_class_exists()
    {
        $this->assertIsObject($this->class_instance);
    }

    /**
     * @test
     *
     * @testdox Testing the config() method.
     *
     */
    public function test_config_method()
    {
        $input = 'config';

        $this->class_instance->config($input);

        $expected = null;

        $got = $this->class_instance->config;

        $this->assertEquals($expected, $got);
    }

    /**
     * @test
     *
     * @testdox Testing the in() method.
     *
     */
    public function test_in_method()
    {
        $input = 'test input';

        $this->class_instance->in($input);

        $expected = $input;

        $got = $this->class_instance->input;

        $this->assertEquals($expected, $got);
    }

    /**
     * @test
     *
     * @testdox Testing out() returns the same as the input.
     *
     */
    public function test_out_method()
    {
        $input = 'test output is same as input';

        $this->class_instance->in($input);

        $expected = $input;

        $got = $this->class_instance->out();

        $this->assertEquals($expected, $got);
    }

    /**
     * @test
     *
     * @testdox Testing out_collection() returns the same as the input.
     *
     */
    public function test_out_collection_method()
    {
        $input = 'test output is same as input';

        $this->class_instance->in($input);

        $expected = $input;

        $got = $this->class_instance->out_collection();

        $this->assertEquals($expected, $got);
    }
}
