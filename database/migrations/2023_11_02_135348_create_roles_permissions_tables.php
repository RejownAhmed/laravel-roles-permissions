<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //E.g manager
            $table->string('label')->nullable(); // E.g Manager
            $table->timestamps();

        });

        //Permissions Table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); //E.g edit_item
            $table->string('label')->nullable(); // E.g Edit Items
            $table->timestamps();

        });

        //Permission role Relationship
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignIdFor(Permission::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(Role::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->primary(['permission_id', 'role_id']);

        });

        //Role user Relationship
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignIdFor(Role::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnDelete();

            $table->primary(['role_id', 'user_id']);


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_permissions');
        Schema::dropIfExists('user_roles');
    }
};
