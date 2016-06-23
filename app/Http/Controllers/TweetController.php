<?php



namespace App\Http\Controllers;



use App\Tweet;

use Illuminate\Http\Request;



class TweetController extends Controller

{

	public function index()

	{

		$tweets = Tweet::all();

		return response()->json($tweets);

	}



	public function read($id)

	{

		$tweet = Tweet::find($id);

		return response()->json($tweet);

	}



	public function create (Request $request)

	{

		$ok_content = strlen($request['content'])<=140;

		$set_img = ($request['img_url']!="");

		$set_vid = ($request['vid_url']!="");

		$ok_img_vid = ($set_vid==True && $set_img ==False) || ($set_img==True && $set_vid ==False);

		if($ok_content && $ok_img_vid){

			$tweet = Tweet::create($request->all());

			return response()->json($tweet);	

		}

		else{

			$result = array();

			if(!$ok_content){

				$result["Content Error"]="Tweet content can't exceed 140 characters";

			}

			if(!$ok_img_vid){

				$result["IMG_VID Error"]="You can't add both image and video";

			}

			return response()->json($result);

		}

		

	}



	public function update(Request $request,$id)

	{

		$ok_content = strlen($request['content'])<=140;

		$set_img = ($request['img_url']!="");

		$set_vid = ($request['vid_url']!="");

		$ok_img_vid = ($set_vid==True && $set_img ==False) || ($set_img==True && $set_vid ==False);

		if($ok_content && $ok_img_vid){$tweet = Tweet::find($id);

		$updated = $tweet->update($request->all());

		return response()->json(['updated'=> $updated]);

		}

		else{

			$result = array();

			if(!$ok_content){

				$result["Content Error"]="Tweet content can't exceed 140 characters";

			}

			if(!$ok_img_vid){

				$result["IMG_VID Error"]="You can't add both image and video";

			}

			return response()->json($result);

		}

	}



	public function delete($id)

	{

		$deletedRows = Tweet::destroy($id);

		$deleted = $deletedRows==1;

		return response()->json(['deleted'=>$deleted]);

	}

}

?>
