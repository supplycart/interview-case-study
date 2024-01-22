<?php

use Illuminate\Database\Eloquent\Model;
use App\Models\Config;

    function getConfig($key) {
        $model = Config::where(["name" => $key])->first();
        if ($model) {
            return $model->data;
        }
        return null;
    }

    function generate_unique_id($prefix, $model, $column, $number_only = true, $length = 5, $random = false, $index_number = 0) {

        $class = 'App\\Models\\' . $model;
    
        $startWith = strlen($prefix)+1;
    
        if ($random) {
            $random_string = generateRandomString($length, $number_only);
            $full_random_string = $prefix.$random_string;
        } else {
            if (class_exists($class)) {
                $last_record = $class::withTrashed()->selectRaw("SUBSTRING(`$column`, $startWith) as `$column`")->orderBy('id', 'desc')->first();
                if ($index_number == 0) {
                    $last_unique_number = intval(preg_replace("/[^0-9]/", "", ($last_record ? $last_record->$column : 0)));
                    $index_number = $last_unique_number + 1;
                } else {
                    $index_number = $index_number + 1;
                }
                $proposed_uniqued_number = sprintf("%0".$length."s", $index_number);
                $full_random_string = $prefix.$proposed_uniqued_number;
            }
        }
        
        // check if database exist
        if (class_exists($class)) {
            $found = $class::where([$column => $full_random_string])->first();
            if ($found === null) {
                return $full_random_string;
            } else {
                // call function recursively
                return generate_unique_id($prefix, $model, $column, $number_only, $length, $random, $index_number);
            }
        } else {
            // abort(404);
            throw new \Exception("Failed to generate unique id");
        }
    
    }
