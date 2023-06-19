<?php


//this is a test controller
//
//
//
namespace App\Controllers;
class TryAuto extends BaseController
{
	public function index()
	{
		echo view('try_autocompletion');
	}
	public function continuious_loading()
	{
		echo view('try_continuious_loading');
	}
	public function google_maps()
	{
		echo view('try_googlemaps_API');
	}

}
