<?php

class field_input_choices 
{

    use \ue\utils;
    use \ue\wp;

    private $result;

    public function __construct()
    {
        $this->options = (new \ue\options)->get_options();
        $this->run();
        
    }

    public function get_result()
    {
        return $this->result;
    }



    private function run()
    {
        foreach ($this->options as $key => $value)
        {

            if ($value['ue_job_content_id']['ue_content_input'] == 'query')
            {
                $query   = $value['ue_job_content_id']['ue_content_query'];
                $args    = $this::string_to_array($query);
                $results = $this::wp_get_posts_with_meta($args);
                $result  = $results[0];
            } else {
                $result = $value['ue_job_content_id']['ue_content_posts'][0];
            }

            $flattened_record = $this::array_flat($result, '', '->');

            foreach ($flattened_record as $key => $value)
            {
                if (in_array($key, $this->result)){ continue; }
                $this->result[$key] = $key; 
            }
        }
    }

}

function acf_populate_ue_mutation_input_select_choices($field)
{
    $options = new field_input_choices;
    
    $field['choices'] = $options->get_result();

    return $field;
}

add_filter('acf/prepare_field/name=ue_mutation_input_select', 'acf_populate_ue_mutation_input_select_choices');