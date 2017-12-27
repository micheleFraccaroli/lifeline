<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use App\Group;
use App\Post;
use App\Comment;

class GroupController extends Controller
{
		/*mostra tutti i gruppi a cui un utente non è ancora iscritto*/
    	public function index(Request $request){

    		if ($request->ajax()) {

    			$max_id_index = $request->input('id');

    			$gruppi = DB::table('groups')->where('id','>',$max_id_index)->orderBy('id','desc')->get();

        		return Response()->json($gruppi);
   
    		}else{

    			$gruppi = Group::where('id','>',0)->orderBy('id','desc')->get();

    			$max_id_db = DB::table('groups')->max('id');
    				
    			return view('groups.index', compact('gruppi','max_id_db'));

    		}

		}

		/*mostra tutti i posts presenti all'interno di un gruppo*/
		public function show($id){

			$gruppo = Group::find($id);
			$posts_group = Post::all_posts_group($id);

			return view('groups.show', compact('gruppo','posts_group'));

		}

		/* sposta l'utente alla view di creazione del gruppo */

		public function create(){

			return view('groups.create');
		}

		/*inserisce un nuovo gruppo nel db, prima dell'inserimento viene eseguito 
		un controllo lato server sui campi inseriti in input*/

		public function store(validations $request){

			$gruppo = new Group;

			$gruppo->name = request('name_group');
			$gruppo->description = request('description_group');
			$gruppo->image = request('group_pic_value');
			$gruppo->save();

			return redirect('groups/index');
		}

		/*reindirizza l'utente alla pagina edit, 
		dove è presente il form con all'interno il contenuto del db fino a quel momento*/

		public function edit($id){

			$gruppo = Group::find($id);

			return view('groups.edit',compact('gruppo'));
		}


		/*Prende in input le modifiche apportate e le salva nel db*/
		public function update(validations $request, $id){

			$gruppo = Group::find($id);

			$gruppo->name = request('name_group');
			$gruppo->description = request('description_group');
			$gruppo->image = request('group_pic_value');
			$gruppo->save();

			return redirect('groups/index');
		}
}