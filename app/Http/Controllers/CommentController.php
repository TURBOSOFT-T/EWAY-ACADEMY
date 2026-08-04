<?php

namespace App\Http\Controllers;

use App\Http\Requests\Front\CommentRequest;
use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Blog;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'body' => 'required|string|max:1000',
        ]);
    
        $blog->comments()->create([
            'nom' => $request->nom,
            'email' => $request->email,
            'body' => $request->body,
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'approved' => false,
        ]);
        return response()->json(['message' => 'Commentaire soumis avec succès.']);
      //  return back()->with('success', 'Votre commentaire a été soumis et attendez une validation.');

       // return back()->with('success', 'Votre commentaire a été soumis pour validation.');
    }
    

   
    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    
     public function approve($id)
     {
         $comment = Comment::find($id);
         
         if ($comment) {
             $comment->active = true; 
             $comment->save();
             
             return redirect()->back()
                              ->with('success', 'Commentaire approuvé avec succès.');
         }
     
         return redirect()->back()
                          ->with('error', 'Commentaire introuvable.');
     }
 
     public function disapprove($id)
 {
     $comment = Comment::find($id);
 
     if ($comment) {
         $comment->active = false; 
         $comment->save();
 
         return redirect()->back()
                          ->with('success', 'Commentaire désapprouvé avec succès.');
     }
 
     return redirect()->back()
                      ->with('error', 'Commentaire introuvable.');
 }
 
  
     public function destroy($id)
     {
         $comment = Comment::find($id);
     
         if ($comment) {
             $comment->delete();
     
             return redirect()->back()
                              ->with('success', 'Commentaire supprimé avec succès.');
         }
     
         return redirect()->back()
                          ->with('error', 'Commentaire introuvable.');
     }
}
