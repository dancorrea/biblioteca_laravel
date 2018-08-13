<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/livros', ['uses'=>'BookController@index', 'as'=>'book.index']);
Route::get('/livros/add', ['uses'=>'BookController@add', 'as'=>'book.add']);
Route::post('/livros/save', ['uses'=>'BookController@save', 'as'=>'book.save']);
Route::get('/livros/edit/{id}', ['uses'=>'BookController@edit', 'as'=>'book.edit']);
Route::post('/livros/update/{id}', ['uses'=>'BookController@update', 'as'=>'book.update']);
Route::get('/livros/delete/{id}', ['uses'=>'BookController@delete', 'as'=>'book.delete']);
Route::put('/livros/search', ['uses'=>'BookController@search', 'as'=>'book.search']);

Route::get('/autores', ['uses'=>'AuthorController@index', 'as'=>'author.index']);
Route::get('/autores/add', ['uses'=>'AuthorController@add', 'as'=>'author.add']);
Route::post('/autores/save', ['uses'=>'AuthorController@save', 'as'=>'author.save']);
Route::get('/autores/edit/{id}', ['uses'=>'AuthorController@edit', 'as'=>'author.edit']);
Route::post('/autores/update/{id}', ['uses'=>'AuthorController@update', 'as'=>'author.update']);
Route::get('/autores/delete/{id}', ['uses'=>'AuthorController@delete', 'as'=>'author.delete']);
Route::put('/autores/search', ['uses'=>'AuthorController@search', 'as'=>'author.search']);

Route::get('/emprestimos', ['uses'=>'LendingController@index', 'as'=>'lending.index']);
Route::get('/emprestimos/add', ['uses'=>'LendingController@add', 'as'=>'lending.add']);
Route::post('/emprestimos/save', ['uses'=>'LendingController@save', 'as'=>'lending.save']);
Route::get('/emprestimos/edit/{id}', ['uses'=>'LendingController@edit', 'as'=>'lending.edit']);
Route::post('/emprestimos/update/{id}', ['uses'=>'LendingController@update', 'as'=>'lending.update']);
Route::get('/emprestimos/delete/{id}', ['uses'=>'LendingController@delete', 'as'=>'lending.delete']);