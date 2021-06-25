<?php

Route::prefix('epanel/content')->as('epanel.')->middleware(['auth', 'check.permission:Agenda'])->group(function() 
{
    Route::resources([
        'agenda' => 'AgendaController'
    ]);
});