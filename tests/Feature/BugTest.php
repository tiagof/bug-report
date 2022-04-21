<?php

namespace Tests\Feature;

use App\Models\Contract;
use Tests\TestCase;

class BugTest extends TestCase
{
    /*
     * https://github.com/laravel/framework/issues/42075
     */

    public function testBug(): void
    {
        static::assertEquals(
            'select * from `contracts` where exists (select * from `contracts` as `laravel_reserved_0` where `contracts`.`id` = `laravel_reserved_0`.`contract_id` and `laravel_reserved_0`.`deleted_at` is not null) and `contracts`.`deleted_at` is null',
            Contract::whereHas('relationSelf')->toSql()
        );
    }

    public function testOk(): void
    {
        static::assertEquals(
            'select * from `contracts` where exists (select * from `clients` where `contracts`.`id` = `clients`.`contract_id` and `clients`.`deleted_at` is not null) and `contracts`.`deleted_at` is null',
            Contract::whereHas('relationOther')->toSql()
        );
    }
}
