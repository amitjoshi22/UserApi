## REST API- Laravel

A low level HTTP based CRUD and basic authentication API that used Laravel Passport for Authentication.


## Roles & Permission

Create users with different roles and permission

#Grouped Route

```
Route::group(['middleware' => 'can:permission_name1|permission_name2'], function(){
    //route here
})
```

#Single Route

```
Route::get('route-elements')->middleware('can:permission_name1|permission_name2');
```
