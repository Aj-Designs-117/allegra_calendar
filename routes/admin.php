<?php

use Illuminate\Support\Facades\Route;

Route::view('/administrador', 'admin.index')->middleware('can:admin.index')->name('admin.index');

Route::view('/users', 'admin.users.index')->middleware('can:admin.users.index')->name('admin.users.index');

Route::view('/roles-permisos', 'admin.rolesPermissions.index')->middleware('can:admin.rolesPermissions.index')->name('admin.rolesPermissions.index');

Route::view('/create', 'admin.rolesPermissions.create')->middleware('can:admin.rolesPermissions.create')->name('admin.rolesPermissions.create');

Route::view('/roles', 'admin.roles.index')->middleware('can:admin.roles.index')->name('admin.roles.index');

Route::view('/permisos', 'admin.permisos.index')->middleware('can:admin.permissions.index')->name('admin.permisos.index');

Route::view('/events', 'admin.events.index')->middleware('can:admin.events.index')->name('admin.events.index');

Route::view('/subscriptions', 'admin.subscriptions.index')->middleware('can:admin.subscriptions.index')->name('admin.subscriptions.index');

Route::view('/agendados', 'admin.appointments.index')->name('admin.appointments.index');
