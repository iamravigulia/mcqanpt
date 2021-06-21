<?php
use Illuminate\Support\Facades\Route;

// Route::get('greeting', function () {
//     return 'Hi, this is your awesome package! Mcqanpt';
// });

// Route::get('picmatch/test', 'EdgeWizz\Picmatch\Controllers\PicmatchController@test')->name('test');

Route::post('fmt/mcqanpt/store', 'EdgeWizz\Mcqanpt\Controllers\McqanptController@store')->name('fmt.mcqanpt.store');

Route::post('fmt/mcqanpt/update/{id}', 'EdgeWizz\Mcqanpt\Controllers\McqanptController@update')->name('fmt.mcqanpt.update');

Route::post('fmt/mcqanpt/csv_upload', 'EdgeWizz\Mcqanpt\Controllers\McqanptController@csv_upload')->name('fmt.mcqanpt.csv');

Route::any('fmt/mcqanpt/delete/{id}', 'EdgeWizz\Mcqanpt\Controllers\McqanptController@delete')->name('fmt.mcqanpt.delete');


Route::any('fmt/mcqanpt/inactive/{id}',  'EdgeWizz\Mcqanpt\Controllers\McqanptController@inactive')->name('fmt.mcqanpt.inactive');
Route::any('fmt/mcqanpt/active/{id}',  'EdgeWizz\Mcqanpt\Controllers\McqanptController@active')->name('fmt.mcqanpt.active');
