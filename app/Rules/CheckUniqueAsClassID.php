<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class CheckUniqueAsClassID implements ValidationRule
{
    private $table;
    private $column;
    private $classId;

    public function __construct($classId, $table, $column)
    {
        $this->table = $table;
        $this->column = $column;
        $this->classId = $classId;
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
            ->where('school_class_id', $this->classId)
            ->where($this->column, $value)
            ->exists();

        if ($exists) {
            $fail("The " . $this->column . " must be unique within the selected class.");
        }
    }
}
