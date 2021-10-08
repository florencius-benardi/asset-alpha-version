<?php

use App\Domain\Orange\Employee\Entities\Employee;
use App\Domain\Orange\Grade\Entities\Grade;
use App\Domain\Orange\Level\Entities\Level;
use App\Domain\Orange\Organization\Entities\Organization;
use App\Domain\Orange\Position\Entities\Position;
use App\Domain\System\Users\Entities\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Employee::ATTR_TABLE, function (Blueprint $table) {
            $table->increments(Employee::ATTR_INT_ID);
            $table->string(Employee::ATTR_CHAR_CODE, 15)->unique();
            $table->string(Employee::ATTR_CHAR_NAME);
            $table->integer(Employee::ATTR_INT_ORGANIZATION)->nullable()->unsigned();
            $table->integer(Employee::ATTR_INT_POSITION)->nullable()->unsigned();
            $table->integer(Employee::ATTR_INT_GRADE)->nullable()->unsigned();
            $table->integer(Employee::ATTR_INT_LEVEL)->nullable()->unsigned();
            $table->integer(Employee::ATTR_INT_CREATED_BY)->nullable()->unsigned();
            $table->integer(Employee::ATTR_INT_UPDATED_BY)->nullable()->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign(Employee::ATTR_INT_LEVEL)->constrained(Level::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Employee::ATTR_INT_GRADE)->constrained(Grade::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Employee::ATTR_INT_POSITION)->constrained(Position::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Employee::ATTR_INT_ORGANIZATION)->constrained(Organization::ATTR_TABLE)->onDelete('NO ACTION');
            $table->foreign(Employee::ATTR_INT_CREATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
            $table->foreign(Employee::ATTR_INT_UPDATED_BY)->references(User::ATTR_INT_ID)->on(User::ATTR_TABLE)->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Employee::ATTR_TABLE);
    }
}
