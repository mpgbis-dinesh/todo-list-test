<?php

namespace App\Http\Controllers\Userprofile;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use storeHash;
use DB;
use View;
use Validator;
use Response;
use Input;
use Redirect;
use Auth;
use Mail;
use Log;
use PDF;
use Config;
use File;
use Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
	{
        if(Auth::check()){

        }
    }
}