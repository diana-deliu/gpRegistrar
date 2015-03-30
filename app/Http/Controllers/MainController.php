<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use DB;

class MainController extends Controller {

	public function index() {
		return DB::select('select * from all_tables');
	}

}
