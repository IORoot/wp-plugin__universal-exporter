<?php

namespace ue;

class process_record
{
    public $config;

    public $record;
    public $record_key;
    public $record_field;

    public $result;

    public function set_config($config)
    {
        $this->config = $config;
    }

    public function set_record($record)
    {
        $this->record = $record;
    }

    public function run()
    {
        $this->loop_through_all_fields();
        return $this->result;
    }

    //  ┌─────────────────────────────────────────────────────────────────────────┐
    //  │                                                                         │░
    //  │                                                                         │░
    //  │                         Loop through each field                         │░
    //  │                                                                         │░
    //  │                                                                         │░
    //  └─────────────────────────────────────────────────────────────────────────┘░
    //   ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░

    public function loop_through_all_fields()
    {

        foreach ($this->record as $this->record_key => $this->record_field)
        {
            $this->record_field = $this->process_field();
        }

    }

    
    public function process_field()
    {
        $field = new process_field;
        $field->set_config($this->config);
        $field->set_field_key($this->record_key);
        $field->set_field_value($this->record_field);
        return $field->run();
    }
}