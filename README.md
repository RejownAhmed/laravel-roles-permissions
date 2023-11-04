
# Laravel Roles And Permission

This project implements a simple yet powerful role permission features in Laravel

### User manual
- copy ``.env.example`` to ``.env`` and Update the ``.env`` file with your database informations and migrate
- Create an user. Required fields are: ``full_name`` ``email`` ``password``
- Create a role. Fields: ``name`` and ``label``
- Create a permission. Fields: ``name`` and ``label``
### Assign role to user
To assign the created role to the user use the User method ``assignRole()``. Here's the process: 
- Either pass the name of the role like: 

  ```php 
  $user = User::first();
  $user->assignRole('manager');
  ```

- Or pass in the role model directly. E.g 
  
  ```php
  $role = Role::first();
  $user->detachRole($role);
  ```

### Detach a role from user
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

### Add permissions to role

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
### Revoke permission from a role

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

### Test the permissions
To test if the permission and role is working, you can simply use the ``can()`` method either on the route or in the blade file. For example:-
- On the route itself. 
  
  ```php 
  Route::get('/posts')->can('view_posts');
  ```
- Maybe through middleware
  ```php 
  Route::get('/posts')->middleware('can:view_posts');
  ```
- In laravel blade. 
  
  ```php
  @can('view_posts')
   Yes I can view the post
  @endcan()
  ```

## Code Debugging
Check the ``AuthServiceProvider`` for debugging the Gates and update anything if you need.
