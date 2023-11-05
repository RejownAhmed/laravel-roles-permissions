
# Laravel Roles And Permissions

This project implements a simple yet powerful role permission feature in Laravel. Before diving into this project, let me clarify something, there is no front-end associated to create user, roles or permissions. You must create users, roles and permissions manually from the database or from the ``php artisan tinker`` command. After that, check the **``router/web.php``** file how I have authenticated the user and tested the permissions. 

### User manual
- copy ``.env.example`` to ``.env`` and Update the ``.env`` file with your database informations and migrate
- Create an user. Required fields are: ``full_name`` ``email`` ``password``

  ``php artisan tinker``

  ```php
  namespace App\Models;
  $user = new User();
  $user->full_name = 'John doe';
  $user->email = 'john@demo.com';
  $user->password = 12345;
  $user->save();
  ```
- Create a role. Required fields: ``name`` and ``label``
  
  ``php artisan tinker``

  ```php
  namespace App\Models;
  $role = new Role();
  $role->name = 'manager';
  $role->label = 'Manager of the site';
  $role->save();
  ```
  
- Create a permission. Required fields: ``name`` and ``label``
    
  ``php artisan tinker``

  ```php
  namespace App\Models;
  $permission = new Permission();
  $permission->name = 'view_posts';
  $permission->label = 'Can view posts';
  $permission->save();
  ```
  
### Assign the role to the user
To assign the created role to the user use the User method ``assignRole()``. Here's the process: 
- Either pass the name of the role like: 

  ```php 
  $user = User::first();
  $user->assignRole('manager');
  ```

- Or pass in the role model directly. E.g 
  
  ```php
  $role = Role::first();
  $user->assignRole($role);
  ```

### Detach the role from the user
To detach the created role from the user use the User method ``detachRole()``. Here's the process: 
- Either pass the name of the role like: 

  ```php 
  $user = User::first();
  $user->detachRole('manager');
  ```

- Or pass in the role model directly. E.g 
  
  ```php
  $role = Role::first();
  $user->detachRole($role);
  ```

### Add permissions to the role

To add permissions to a role the Role method ``givePermissionTo()``. Here's the process: 
- Either pass the name of the permission like: 

  ```php 
  $role = Role::first();
  $role->givePermissionTo('view_posts')
  ```

- Or pass in the permission model directly. E.g 
  
  ```php
  $permission = Permission::first();
  $role->givePermissionTo($permission);
  ```
### Revoke permission from the role

To revoke/detach/remove a permission from a role the Role method ``revokePermission()``. Here's the process: 
- Either pass the name of the permission like: 

  ```php 
  $role = Role::first();
  $role->revokePermission('view_posts')
  ```

- Or pass in the permission model directly. E.g 
  
  ```php
  $permission = Permission::first();
  $role->revokePermission($permission);
  ```

### Implementation/Uses
To test if the permission and role is working, you can simply use the ``can()`` method either on the route or in the blade file. For example:-
**NOTE: By default checks for the authenticated user**
- On the route itself. 
  
  ```php 
  Route::get('/posts')->can('view_posts');
  ```
- Maybe through middleware
  ```php 
  Route::get('/posts')->middleware('can:view_posts');
  ```
- Maybe in controller constructor
  ```php 
  $this->middleware('can:view_posts')->only(['index', 'show']);
  ```
- Maybe in controller methods
  ```php 
  $user->can('view_posts');
  ```
  - Maybe using the help of Gate
      ```php
      Gate::allows('view_posts'); // Check if allowed
      Gate::denies('view_posts');// Check if not allowed
      
      // Check by specific user
      Gate::allows('view_posts', $user); // Check if allowed
      Gate::denies('view_posts', $user);// Check if not allowed
      
      // Or maybe this way
      Gate::forUser($user)->allows('view_posts'); // Check if allowed
      Gate::forUser($user)->denies('view_posts');// Check if not allowed
      ```
- In laravel blade. 
  
  ```blade
  @can('view_posts')
   Yes I can view the post
  @endcan
  ```

## Code Debugging
Check the ``AuthServiceProvider`` for debugging the Gates and update anything if you need.
