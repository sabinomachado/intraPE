<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', function () {
    return view('auth.login');
});


Route::group(['middleware'=>['auth']],function(){

    Route::get('/logout',function(){
        Auth::logout();
        return redirect()->route('/');
    });

    /*Route::get('/', function () {
        return view('auth.login');
    });*/

    Route::get('/ponto', function () {
        return view('ponto');
    });

    Route::get('/planejamento', function () {
        return view('planejamento');
    });

    Route::get('/home', 'HomeController@index')->name('home');




    /* ------------------------------------Destroy---------------------------------------- */
    Route::get('/tarefas/destroy/{id}', 'TarefaController@destroy')->name('tarefas/destroy');

    Route::get('/acoes/destroy/{id}', 'AcaoController@destroy')->name('acoes/destroy');

    Route::get('/metas/destroy/{id}', 'MetaController@destroy')->name('metas/destroy');

    Route::get('perspectivas/destroy/{id}', 'PerspectivaController@destroy')->name('perspectivas/destroy');

    Route::get('/reunioes/destroy/{id}', 'ReuniaoController@destroy')->name('reunioes/destroy');

    Route::get('/objetivos/destroy/{id}', 'ObjetivoController@destroy')->name('objetivos/destroy');
    /* ------------------------------------Destroy---------------------------------------- */




    /* ------------------------------------Resources---------------------------------------- */
    Route::resource('/estrategico', 'EstrategicoController');

    Route::resource('/objetivos', 'ObjetivoController');

    Route::resource('/metas', 'MetaController');

    Route::resource('/perspectivas', 'PerspectivaController');

    Route::resource('/acoes', 'AcaoController');

    Route::resource('/reunioes', 'ReuniaoController');
    /* ------------------------------------Resources---------------------------------------- */



    /* -------------------------------------Except------------------------------------------ */
    Route::resource('/tarefas', 'TarefaController',[
        'except' => [ 'destroy' ]
        ]
    );

    Route::resource('/perspectivas', 'PerspectivaController',[
        'except' => [ 'destroy' ]
        ]
    );

    Route::resource('/acoes', 'AcaoController',[
        'except' => [ 'destroy' ]
        ]
    );

    Route::resource('/metas', 'MetaController',[
        'except' => [ 'destroy' ]
        ]
    );

    Route::resource('/objetivos', 'ObjetivoController',[
        'except' => [ 'destroy' ]
        ]
    );

    Route::resource('/reunioes', 'ReuniaoController',[
        'except' => [ 'destroy' ]
        ]
    );
  /* -------------------------------------Except------------------------------------------ */





});




?>

