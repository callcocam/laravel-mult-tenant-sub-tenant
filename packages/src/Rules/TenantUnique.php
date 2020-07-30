<?php

namespace Tenant\Rules;

use Tenant\ManagerTenant;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class TenantUnique implements Rule
{
    private $table;
    /**
     * @var null
     */
    private $column;
    /**
     * @var null
     */
    private $columnValue;

    /**
     * Create a new rule instance.
     *
     * @param $table
     * @param null $columnValue
     * @param string $column
     */
    public function __construct($table, $columnValue = null, $column = "id")
    {
        //
        $this->table = $table;
        $this->column = $column;
        $this->columnValue = $columnValue;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $tenant = app(ManagerTenant::class)->getTenantIdentify();

        $result = DB::table($this->table)->where($attribute, $value)
            ->where('tenant_id', $tenant)->first();

        if($result && $result->{$this->column} == $this->columnValue)
            return true;

        return  is_null($result);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.tenant.unique');
    }
}
