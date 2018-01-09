<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\validations;
use Illuminate\Support\Facades\Storage;
use App\Group;
use App\Post;
use App\Comment;
use App\User;
use App\Like;

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

		/*mostra tutti i post presenti e utenti iscritti all'interno di un gruppo

		e i gruppi a cui l'utente NON è ancora iscritto*/

		public function show($id){

			$appartiene = GROUP::find($id)->users()->where('id',Auth::id())->get();

			$user_log = User::find(Auth::id());

			$other_groups = DB::table('groups')->whereNotIn('id',$user_log->groups->pluck('id'))->get();

			$group = Group::find($id);


			$access = 1;

			if($appartiene->count()==0){

				$access = 0;

				return view('groups.show', compact('access','other_groups','group'));

			}else{

				$all_posts = Group::find($id)->posts;

				foreach ($all_posts as $post) {

					$user[$post->id] = POST::find($post->id)->user;
					$like[$post->id] = POST::find($post->id)->likes->count();

					$result = LIKE::getLikeForPost($post->id)->where('id_utente',Auth::id());

					if ($result->count()) {
					
						$my_like[$post->id] = 1;

					}else{

						$my_like[$post->id] = 0;
					}

				}

				$group = Group::find($id);

				return view('groups.show', compact('all_posts','user','like','id','group','other_groups','my_like','access'));

			}

		}

		/* sposta l'utente alla view di creazione del gruppo */

		public function create(){

			return view('groups.create');
		}

		/*inserisce un nuovo gruppo nel db, prima dell'inserimento viene eseguito 
		un controllo lato server sui campi inseriti in input: validations $request*/

		public function store(Request $request){

			$gruppo = new Group;

			$path = $request->file('new_group_pic')->store('public');
			$url = Storage::url($path);

			$gruppo->name = request('name_group');
			$gruppo->description = request('description_group');
			$gruppo->image = $url;
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