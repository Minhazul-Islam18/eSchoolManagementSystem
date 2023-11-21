<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckUniqueAsClassID implements ValidationRule
{
    private $table;
    private $column;
    private $class_id;
    private $id;

    public function __construct($class_id, $table, $column, $id = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->class_id = $class_id;
        $this->id = $id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the title is unique within the given class_id
        $exists = DB::table($this->table)
            ->where('school_class_id', $this->class_id)
            ->where($this->column, $value)
            ->where('id', '!=', $this->id)
            ->doesntExist();


        if (!$exists) {
            $fail("The " . $this->column . " must be unique within the selected class.");
        }
    }
}
