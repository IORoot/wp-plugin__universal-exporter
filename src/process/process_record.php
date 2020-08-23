<?php

namespace ue;

class process_record
{
    public $config;
    public $current_config;

    public $record;
    public $smaller_record;

    public $field_key;
    public $field_value;

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
        $this->remove_all_unneeded_fields();
        $this->loop_through_all_fields();
        return $this->result;
    }



    public function loop_through_all_fields()
    {
        foreach ($this->record as $this->field_key => $this->field_value)
        {
            $this->get_moustache_value();
            $this->process_field();
        }
        return;
    }


    public function get_moustache_value()
    {
        foreach ($this->config as $key => $value)
        {
            if ($value['ue_mutation_input'] == $this->field_key)
            {
                $this->moustache = $value['ue_mutation_moustache'];
            }
        }
    }


    public function remove_all_unneeded_fields()
    {
        // check against each config field.
        foreach ($this->config as $this->current_config) {

            $exploded_field = explode('->', $this->current_config['ue_mutation_input']);
            $field_value = $this->record;

            foreach ($exploded_field as $field_depth)
            {
                $field_value = $field_value[$field_depth];
            }
            
            $smaller_record[$this->current_config['ue_mutation_input']] = $field_value;
        }
        $this->record = $smaller_record;
    }



    
    public function process_field()
    {
        $field = new process_field;
        $field->set_config($this->config);
        $field->set_field_key($this->field_key);
        $field->set_field_value($this->field_value);
        $this->result[$this->moustache] = $field->run();
    }
}