<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller {

	public function index() {
		return view('pages.index');
	}
	
	public function test() {
		return view('pages.test');
	}

}
