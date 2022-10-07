<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stories;
use App\Models\Articles;
use App\Models\Book;
use App\Models\Author;
use App\Models\Link;
use App\Models\Olink;
use App\Models\User;
use App\Models\Narrator;
use App\Models\Audiobook;
use App\Models\Contact;
use DB;
use Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'book_details', 'stories', 'article', 'articles', 'show_author', 'all_authors', 'contact', 'contact_form']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sb = $request->input('search_books');

        if($sb){
            $books = Book::leftjoin('authors', 'book_author_id' , '=', 'author_id')
            ->where(DB::Raw('lower(title)'), 'like', '%' . strtolower($sb) . '%')
            ->orwhere(DB::Raw('lower(genre)'), 'like', '%' . strtolower($sb) . '%')
            ->orwhere(DB::Raw('lower(pen_name)'), 'like', '%' . strtolower($sb) . '%')
            ->orderby('books.id', 'asc')
            ->paginate(100);
        } else {
            $books = Book::leftjoin('authors', 'book_author_id' , '=', 'author_id')
            ->orderby('books.id', 'desc')
            ->paginate(12);            
        }
        $stories = Stories::inRandomOrder()->with('users')->limit(12)->get();

            return view('home')->with('books', $books)->with('stories', $stories);
    }

    public function admin()
    {
        $id = auth()->user()->id;

        $books = Book::count();
        $stories = Stories::count();
        $articles = Articles::count();

        $users = User::count();
        $authors = Author::count();
        $narrators = Narrator::count();

        $mybooks = Book::where('user_id', $id)->count();
        $mystories = Stories::where('uid', $id)->count();
        $myarticles = Articles::where('uid', $id)->count();

        return view('admin')
             ->with('books', $books)
             ->with('stories', $stories)
             ->with('articles', $articles)
             ->with('users', $users)
             ->with('authors', $authors)
             ->with('narrators', $narrators)
             ->with('mybooks', $mybooks)
             ->with('mystories', $mystories)
             ->with('myarticles', $myarticles);
    }

    public function book_details($id) {
        $book = Book::with('authors')->orderby('books.id', 'asc')->where('books.id', $id)->get();
        $book_links = Link::where('book_id', $id)->get();
        $author_id = Book::where('books.id', $id)->pluck('book_author_id');
        $other_books = Book::where('book_author_id', $author_id[0])->paginate(2);
        $audiobook = Audiobook::with('narrators')->where('book_id', $id)->get();

        return view('book_details')
             ->with('book', $book)
             ->with('book_links', $book_links)
             ->with('other_books', $other_books)
             ->with('audiobook', $audiobook);  
    }

    public function my_books() {
        $id  = auth()->user()->id;
        $my_books = Book::withTrashed()->where('user_id', $id)->get();
        
        return view('mybooks')->with('my_books', $my_books);  
    }

    public function my_stories() {
        $id  = auth()->user()->id;
        $my_stories = Stories::where('uid', $id)->get();
        
        return view('mystories')->with('my_stories', $my_stories);  
    }

    public function my_articles() {
        $id  =auth()->user()->id;
        $my_articles = Articles::where('uid', $id)->get();
        
        return view('myarticles')->with('my_articles', $my_articles);  
    }

    public function show_add_book(){

        $genres = Author::where('user_id', auth()->user()->id)->get();

        return view('add_book')->with('genres', $genres);

    }
    public function add_book(Request $request){
                
        $this->validate($request, [
            'book_image' => 'required',
            'title' => 'required',
            'blurb' => 'required',
			'genre' => 'required',
            'sname' => 'required',
            'status' => 'required',
            'price' => 'required',
			'pformat' => 'required'
          ]);
		  
		  $author_id = Author::where('user_id', auth()->user()->id)->pluck('author_id');
		  $k = $request->input('Kindle');
		  $p = $request->input('Paperback');
		  $h = $request->input('Hardback');
		  $a = $request->input('Audiobook');

		  if($k){ $k = $k .', '; } else { $k = ''; }
		  if($p){ $p = $p .', '; } else { $p = ''; }
		  if($h){ $h = $h .', '; } else { $h = ''; }
		  if($a){ $a = $a; } else { $a = ''; }
		  
		  $aformats = $k . $p . $h . $a;

        //Handle File Upload
        if($request->hasFile('book_image')){

            //Get original filename
            $filenameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Just filename extension
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //Concatenate filename with date / time to make it unique
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image
			$img = $request->file('book_image');
            $img->move('bookcovers', $fileNameToStore);	
		} else {
            //If no image add defaukt filename to db
            $fileNameToStore = 'bookcovers/noimage.jpg';
        }		  
		  
            //Create new entry into Messages get_html_translation_table
            try{
                
                $app = new Book;
                $app->user_id = auth()->user()->id;
                $app->title = $request->input('title');
				$app->book_author_id = $author_id[0];
                $app->blurb = $request->input('blurb');
				$app->genre = $request->input('genre');
				$app->c_image = 'bookcovers/'.$fileNameToStore;
                $app->available_formats = $aformats;
				$app->series_name = $request->input('sname');
				$app->status = $request->input('status');
				$app->price = $request->input('price');
				$app->pformat = $request->input('pformat');
                $app->save();
			
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error', 'A Book Advert for this book has already been created.');
                }
            }
              	
                return redirect('/home')->with('success', 'Your New Book Advert has been successfully created. Thank you!');


    }

    public function edit_book($id){

        $book = Book::where('id', $id)->get();
        $genres = Author::where('user_id', auth()->user()->id)->get();

        return view('edit_book')->with('book', $book)->with('genres', $genres);

    }
    public function store_book(Request $request){
                
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'blurb' => 'required',
			'genre' => 'required',
            'sname' => 'required',
            'status' => 'required',
            'price' => 'required',
			'pformat' => 'required'
          ]);

          $id = $request->input('id');
		  
		  $author_id = Author::where('user_id', auth()->user()->id)->pluck('author_id');
		  $k = $request->input('Kindle');
		  $p = $request->input('Paperback');
		  $h = $request->input('Hardback');
		  $a = $request->input('Audiobook');

		  if($k){ $k = $k .', '; } else { $k = ''; }
		  if($p){ $p = $p .', '; } else { $p = ''; }
		  if($h){ $h = $h .', '; } else { $h = ''; }
		  if($a){ $a = $a; } else { $a = ''; }
		  
		  $aformats = $k . $p . $h . $a;

        //Handle File Upload
        if($request->hasFile('book_image')){

            //Get original filename
            $filenameWithExt = $request->file('book_image')->getClientOriginalName();
            //Get just the filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //Get Just filename extension
            $extension = $request->file('book_image')->getClientOriginalExtension();
            //Concatenate filename with date / time to make it unique
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            //Upload image
			$img = $request->file('book_image');
            $img->move('bookcovers', $fileNameToStore);	
		}
		  
            //Create new entry into Messages get_html_translation_table
            try{
                
                $app = Book::find($id);
                $app->user_id = auth()->user()->id;
                $app->title = $request->input('title');
				$app->book_author_id = $author_id[0];
                $app->blurb = $request->input('blurb');
				$app->genre = $request->input('genre');
				if($request->hasFile('book_image')){
                    $app->c_image = 'bookcovers/'.$fileNameToStore;
                } else {
                    $app->c_image = $request->input('current_image');
                }
                $app->available_formats = $aformats;
				$app->series_name = $request->input('sname');
				$app->status = $request->input('status');
				$app->price = $request->input('price');
				$app->pformat = $request->input('pformat');
                $app->update();
			
            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                return $e;
            }
              	
                return redirect('/admin/mybooks')->with('success', 'Your Book Advert has been successfully updated. Thank you!');


    }

    public function book_destroy($id){
        $book = Book::find($id);
        $book->delete();
        return back()->with('error', 'Book Deleted');
    }

    public function book_undestroy($id){
        $book = Book::withTrashed()->find($id);
        $book->restore();
        return back()->with('success', 'Book Successfully Restored');
    }

    public function story($id) {
        $stories = Stories::with('users')->where('id', $id)->get();
        $articles = Articles::inRandomOrder()->limit(4)->get();
        return view('story')->with('stories', $stories)->with('articles', $articles);   
    }

    public function stories() {
        $stories = Stories::get();
        $articles = Articles::inRandomOrder()->limit(12)->get();
        return view('stories')->with('stories', $stories)->with('articles', $articles);  
    }

    public function article($id) {
        $articles = Articles::with('users')->where('id', $id)->get();
        $books = Book::leftjoin('authors', 'book_author_id' , '=', 'author_id')
        ->inRandomOrder()
        ->orderby('books.id', 'desc')
        ->paginate(1);  
        return view('article')->with('articles', $articles)->with('books', $books);   
    }

    public function articles() {
        $articles = Articles::get();
        $books = Book::leftjoin('authors', 'book_author_id' , '=', 'author_id')
        ->inRandomOrder()
        ->orderby('books.id', 'desc')
        ->limit(3)
        ->get(); 
        return view('articles')->with('articles', $articles)->with('books', $books);  
    }

    public function show_add_article()
    {
        return view('add_article');
    }

    public function edit_article($id)
    {

        $article = Articles::where('id', $id)->get();
        
        return view('edit_article')->with('article', $article);
    }

    public function store_article(){
        $content = $_POST['content1'];
        $title = $_POST['title1'];

        //Validate Posted Content

        if($content){
            //Update Post
            $post = New Articles;
            $post->uid = auth()->user()->id;
            $post->title = $title;
            $post->content = $content;
            $post->created_at = time();
            $post->updated_at = time();
            $post->save();

        }
    }

    public function update_article($id){
        $content = $_POST['content1'];
        $title = $_POST['title1'];
        //if $content is not empty update DB

        if($content){
            //Update Post
            $post = Articles::find($id);
            $post->title = $title;
            $post->content = $content;
            $post->updated_at = time();
            $post->save();

        }
    }

    public function all_authors()
    {
       $authors = Author::orderby('pen_name','asc')->get();

        return view('all_authors')->with('authors', $authors);
    }

    public function show_author($id)
    {

        //More books by the same author
        $author_id = Author::where('user_id', $id)->pluck('author_id');
        $books = Book::with('authors')->with('narrators')->orderby('books.id', 'asc')->where('user_id', $id)->get();
        
        $author = Author::where('user_id', $id)->get();
        $author_details = Author::where('user_id', $id)->get();
        
        $audiobook = Audiobook::where('author_id', $author_id[0])->get();
        $other_links = Olink::where('author_id', $author_id[0])->orderby('platform', 'asc')->get();
  
                      
        return view('ind_author')
                  ->with('books', $books)
                  ->with('author', $author)
                  ->with('other_links', $other_links)
                  ->with('audiobook', $audiobook)
                  ->with('author_details', $author_details);
    }

    // public function authors()
    // {
    //    $author = Author::orderby('pen_name','asc')->get();

    //     //return view('authors')->with('author', $author);
    // }

    public function author($id)
    {


        //More books by the same author
        $author_id = Author::where('user_id', $id)->pluck('author_id');
        $books = Book::with('authors')->with('narrators')->orderby('books.id', 'asc')->where('user_id', $id)->get();
        
        $author = Author::where('user_id', $id)->get();
        $author_details = Author::where('user_id', $id)->get();
        
        $audiobook = Audiobook::where('author_id', $author_id[0])->get();
        $other_links = Olink::where('author_id', $author_id[0])->orderby('platform', 'asc')->get();
  
                      
        return view('myauthor')
                  ->with('books', $books)
                  ->with('author', $author)
                  ->with('other_links', $other_links)
                  ->with('audiobook', $audiobook)
                  ->with('author_details', $author_details);
    }

// ============================ AUTHORS =========================================================

    public function show_add_author(){
      $author_check = Author::where('user_id', auth()->user()->id)->get();
      return view('add_author')->with('author_check', $author_check);
    }

    public function store_author(Request $request){
      
      $this->validate($request, [
          'pen_name' => 'required',
          'bio' => 'required',
          'keywords' => 'required',
          'genre_check_list' => 'required',
          'author_image' => 'required'
        ]);


        $genre = $request->input('genre_check_list');
        $genres = implode(", ", $genre);

                //Handle File Upload
      if($request->hasFile('author_image')){

          //Get original filename
          $filenameWithExt = $request->file('author_image')->getClientOriginalName();
          //Get just the filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //Get Just filename extension
          $extension = $request->file('author_image')->getClientOriginalExtension();
          //Concatenate filename with date / time to make it unique
          $fileNameToStore = $filename . '_' . time() . '.' . $extension;
          //Upload image
          //$path = $request->file('author_image')->storeAs('public/authors', $fileNameToStore);
          
          $img = $request->file('author_image');
          $img->move('authors', $fileNameToStore);	    
           
      }
        
        
          //Create new entry into Messages get_html_translation_table
          try{
              
              $app = new Author;
              $app->user_id = auth()->user()->id;
              $app->pen_name = $request->input('pen_name');
              $app->image = 'authors/'.$fileNameToStore;
              $app->bio = $request->input('bio');
              $app->keywords = $request->input('keywords');
              $app->genres = $genres;
              $app->save();
  
              return redirect('/admin')->with('success', 'Your New Author Page has been successfully created. Thank you!');
              
          } catch (\Illuminate\Database\QueryException $e) {
              $errorCode = $e->errorInfo[1];
              echo $e->errorInfo[1];
              if($errorCode == 1062){
                  return back()->with('error', 'An Author Page has already been created under your given Pen Name. Please try another.');
              }
          }
              
              

    }

   public function edit_author($id){
       
       $author = Author::where('id', $id)->get();
       
       return view('authors.author_edit')->with('author', $author);
       
   }
  
    public function update_author(Request $request){
      $this->validate($request, [
          'id' => 'required',
          'pen_name' => 'required',
          'bio' => 'required',
          'keywords' => 'required',
          'genre_check_list' => 'required'
        ]);

        $id = $request->input('id');
        $genre = $request->input('genre_check_list');
        $genres = implode(", ", $genre);

                //Handle File Upload
      if($request->hasFile('author_image')){

          //Get original filename
          $filenameWithExt = $request->file('author_image')->getClientOriginalName();
          //Get just the filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          //Get Just filename extension
          $extension = $request->file('author_image')->getClientOriginalExtension();
          //Concatenate filename with date / time to make it unique
          $fileNameToStore = $filename . '_' . time() . '.' . $extension;
          //Upload image
          $path = $request->file('author_image')->storeAs('public/authors', $fileNameToStore);
          
          $request->file('author_image')->move('/var/www/vhosts/bookiwrote.co.uk/httpdocs/storage/authors/', $fileNameToStore);
              
          try{
              $app = Author::find($id);
              $app->user_id = auth()->user()->id;
              $app->pen_name = $request->input('pen_name');
              $app->image = 'authors/'.$fileNameToStore;
              $app->bio = $request->input('bio');
              $app->keywords = $request->input('keywords');
              $app->genres = $genres;
              $app->save();
             } catch (\Illuminate\Database\QueryException $e) {
                  $errorCode = $e->errorInfo[1];
                  if($errorCode == 1062){
                      return back()->with('error', 'An Author Page has already been created under your given Pen Name. Please try another.');
                  }
              }
          
      } else {
          
          try{
              $app = Author::find($id);
              $app->user_id = auth()->user()->id;
              $app->pen_name = $request->input('pen_name');
              $app->bio = $request->input('bio');
              $app->keywords = $request->input('keywords');
              $app->genres = $genres;
              $app->save();
             } catch (\Illuminate\Database\QueryException $e) {
                  $errorCode = $e->errorInfo[1];
                  if($errorCode == 1062){
                      return back()->with('error', 'There was an issue updating your page.');
                  }
              }
      }	
             
              return redirect('/admin')->with('success', 'Your Author Page has been successfully updated. Thank you!');


    }

    public function delete_author(Request $request){


    }

  // ================= PRIVACY =================================
    public function privacy() {
        return view('privacy');  
    }


    public function contact()
    {
        return view('contact');
    }

    public function contact_form(Request $request){
        $this->validate($request, [
          'name' => 'required',
          'email' => 'required',
          'message' => 'required',
		  'antispam' => 'required'
        ]);

        if(Auth::check()){
            $user_id = auth()->user()->id;
        } else {
            $user_id = Null;
        }
  
	  if($request->input('antispam') == 14){
      //Create new entry into Contact Us
      try{
        $chk = SHA1($request->input('name').$request->input('email').$request->input('message'));
  
        $app = new Contact;
        $app->user_id = $user_id;
        $app->name = $request->input('name');
        $app->email = $request->input('email');
        $app->message = $request->input('message');
        $app->chk = $chk;
        $app->save();


      } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          if($errorCode == 1062){
              return back()->with('error', 'We have already receieved this message from you! Duplicated messages can\'t be sent...');
          }
     }
  
        return back()->with('success', 'Your message has been sent successfully. Thank you!');
		  
		  
	  } else {
		 return back()->with('error', 'Spam Filter Incorrect. Please try again!'); 
	  }
  
      }

      public function message_form()
      {
          $recipient = User::get();
          return view('message_form')->with('recipient', $recipient);
      }

      public function store_message(Request $request){
        $this->validate($request, [
        //   'name' => 'required',
        //   'email' => 'required',
          'message' => 'required',
          'recipient_id' => 'required',
		  'antispam' => 'required'
        ]);
  
	  if(Auth::check() && $request->input('antispam') == 14){
      //Create new entry into Contact Us
      try{
        $chk = SHA1($request->input('name').$request->input('email').$request->input('message'));
  
        $app = new Contact;
        $app->r_id = $request->input('recipient_id');
        $app->user_id = auth()->user()->id;
        $app->name = auth()->user()->name;
        $app->email = auth()->user()->email;
        $app->message = $request->input('message');
        $app->chk = $chk;
        $app->is_read = 0;
        $app->save();


      } catch (\Illuminate\Database\QueryException $e) {
          $errorCode = $e->errorInfo[1];
          if($errorCode == 1062){
              return back()->with('error', 'You have already sent this message! Duplicated messages can\'t be sent...');
          }
     }
  
        return back()->with('success', 'Your message has been sent successfully. Thank you!');
		  
		  
	  } else {
		 return back()->with('error', 'Spam Filter Incorrect. Please try again!'); 
	  }
  
      }

      public function view_messages($id)
      {
        if(Auth::check()){

            //validate form data
            

            $id_check = Contact::where('id', $id)->pluck('r_id');
            if(!empty($id_check[0]) && $id_check[0] === auth()->user()->id || auth()->user()->id === 1 && $id_check[0] === Null){
                //Mark as read
                $message_update = Contact::find($id);
                $message_update->is_read = 1;
                $message_update->update();
                $my_messages = Contact::where('id', $id)->get();
                
                return view('view_messages')->with('my_messages', $my_messages);
            } else {
                $my_messages = [];
                $error_message = 'You do not have necessary permission to access this message. This is a contravention of BOOKiWROTE rules. Further attempts to gain access to other users messages may render your account void.';
                return view('view_messages')->with('my_messages', $my_messages)->with('error_message', $error_message);
            }
        } else {
            return view('view_messages')->with('error', 'Please log in to view messages.');
        }

      }

      public function reply_messages(Request $request)
      {
        if(Auth::check()){
            $this->validate($request, [
                'original_message' => 'required',
                'rid' => 'required',
                'email' => 'required|email'
              ]);

              $original_message = $request->input('original_message');
              $rid = $request->input('rid');
              $email = $request->input('email');
            
              //Show form with vars

            return view('reply_to_message')
                 ->with('original_message', $original_message)
                 ->with('rid', $rid)
                 ->with('email', $email);
        } else {
            $original_message = [];
            $error_message = 'You do not have necessary permission to access this message. This is a contravention of BOOKiWROTE rules. Further attempts to gain access to other users messages may render your account void.';
            return view('reply_to_message')->with('original_message', $original_message)->with('error_message', $error_message);
        }

      }

      public function send_reply_message(Request $request)
      {
        if(Auth::check()){
            $this->validate($request, [
                'message' => 'required',
                'original_message' => 'required',
                'rid' => 'required',
                'email' => 'required|email'
              ]);

              $message = $request->input('message');
              $original_message = $request->input('original_message');
              $rid = $request->input('rid');
              $email = $request->input('email');

              try {
              $chk = SHA1(auth()->user()->name.auth()->user()->email.$message);
  
              $app = new Contact;
              $app->r_id = $rid;
              $app->user_id = auth()->user()->id;
              $app->name = auth()->user()->name;
              $app->email = auth()->user()->email;
              $app->message = $message;
              $app->chk = $chk;
              $app->is_read = 0;
              $app->save();

            } catch (\Illuminate\Database\QueryException $e) {
                $errorCode = $e->errorInfo[1];
                if($errorCode == 1062){
                    return back()->with('error', 'You have already sent this message! Duplicated messages can\'t be sent...');
                }
           }
            
              //Show form with vars

            return redirect('/admin');
        } else {
            $original_message = [];
            $error_message = 'You do not have necessary permission to access this message. This is a contravention of BOOKiWROTE rules. Further attempts to gain access to other users messages may render your account void.';
            return view('reply_to_message')->with('original_message', $original_message)->with('error_message', $error_message);
        }

      }

// ========================= ACCOUNT SETINGS =====================================
			
public function myAccount()
{
    return view('account');
}

    public function updateAccount(Request $request){
        
        //Validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'id' => 'required'
        ]);
        
        
        
        $nm = $request->input('name');
        $email = $request->input('email');
        $id = $request->input('id');
        $current_email = User::where('id', $id)->pluck('email');
        
        try {
        
            $user = User::find($id);
            $user->name = $nm;
            $user->email = $email;
            $user->save();

            $contact = new Contact;
            $contact->r_id = auth()->user()->id;
            $contact->user_id = auth()->user()->id;
            $contact->name = 'SYSTEM MESSAGE';
            $contact->email = $email;
            $contact->message = 'Your user account details have been successfully updated.';
            $contact->chk = sha1(Str::random(60));
            $contact->is_read = 0;
            $contact->save();

        } catch (QueryException $e) {
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                return back()->with('warning', 'You cannot use that email address, as it has already been registered. Please try again!');
            }
        }
                
        return back()->with('success', 'Your Account Details have been Updated Successfully!');
    }


    public function changePassword(Request $request){
        
        //Validation
        $this->validate($request, [
            'password' => 'required',
            'confirm_password' => 'required',
            'id' => 'required'
        ]);
        
        $pw1 = $request->input('password');
        $pw2 = $request->input('confirm_password');
        $id = $request->input('id');
        
        if($pw1 === $pw2){
            $user = User::find($id);
            $user->password = bcrypt($pw1);
            $user->save();
            
            

          $mail = User::where('id', $id)->pluck('email');

          $contact = new Contact;
          $contact->r_id = auth()->user()->id;
          $contact->user_id = auth()->user()->id;
          $contact->name = 'SYSTEM MESSAGE';
          $contact->email = $mail;
          $contact->message = 'Your account password has been successfully updated.';
          $contact->chk = sha1(Str::random(60));
          $contact->is_read = 0;
          $contact->save();

            return back()->with('success', 'Your Password has been Changed Successfully!');
        } else {
            return back()->with('error', 'Your Passwords didn\'t match! Please try again.');
        }
    }

// ========================== NARRATORS ====================================== 

public function all_narrators()
{
    $narrators = Narrator::orderby('name','asc')->get();
    return view('all_narrators')->with('narrators', $narrators);
}

public function ind_narrator($id)
{

    $books = Book::orderby('id', 'asc')->get();
    $narrator = Narrator::orderby('id', 'asc')->where('id', $id)->get();
    $narrator_links = Nlink::where('narrator_id', $id)->get();
    $audiobook = Audiobook::where('narrator_id', $id)->get();
    $author = Audiobook::where('narrator_id', $id)->pluck('author_id');
    if(count($author)>0){
    $author_details = Author::where('id', $author[0])->get();
    } else {
        $author_details = '';
    }
    $author_ids = DB::table('audio_snippets')
    ->select('author_id')
    ->groupBy('author_id')
    ->where('narrator_id', $id)
    ->get();
    return view('ind_narrator')
              ->with('books', $books)
              ->with('narrator', $narrator)
              ->with('narrator_links', $narrator_links)
              ->with('audiobook', $audiobook)
              ->with('author_details', $author_details)
              ->with('author_ids', $author_ids);
}


}
