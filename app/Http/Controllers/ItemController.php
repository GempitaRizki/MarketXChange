<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function showitem()
	{
		$items = Item::all();
		return view('items.index', compact('items'));
	}

	
}
