<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    private User $user;
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_get_posts_page_and_no_posts_found()
    {
        $response = $this->actingAs($this->user)->get('/posts');

        $response->assertStatus(200);
        $response->assertSee('No Posts to display.');
    }

    public function test_get_create_post_page()
    {
        $response = $this->actingAs($this->user)->get('/posts/create');

        $response->assertStatus(200);
        $response->assertSee('Title');
        $response->assertSee('Body');
    }

    public function test_create_post_successful()
    {
        $user = $this->user;
        $post = [
            'user_id' => $user->id,
            'title' => 'test title',
            'body' => 'test body'
        ];

        $response = $this->actingAs($user)->post(route('posts.store'), $post);

        $response->assertRedirect('posts');
        $this->assertDatabaseHas('posts', $post);
    }

    public function test_create_post_failed()
    {
        $user = $this->user;
        $post = [
            'user_id' => $user->id,
            'title' => '',
            'body' => 'test body'
        ];

        $response = $this->actingAs($user)->post(route('posts.store'), $post);
        
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('posts', $post);
    }
    
    public function test_get_edit_post_page()
    {
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        
        $response = $this->actingAs($user)->get('posts/'.$post->id .'/edit');

        $response->assertStatus(200);
        $response->assertViewHas('post', $post);
    }

    public function test_update_post_successful()
    {
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $newPost = [
            'title' => 'updated title',
            'body' => 'updated body'
        ];

        $response = $this->actingAs($user)->put(route('posts.update', $post->id), $newPost);
        
        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', $newPost);
    }

    public function test_update_post_failed()
    {
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);
        $newPost = [
            'title' => 'updated title',
            'body' => ''
        ];

        $response = $this->actingAs($user)->put(route('posts.update', $post->id), $newPost);

        $response->assertSessionHasErrors();
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function test_updating_post_doesnt_belong_to_current_user(){
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id + 1
        ]);

        $newPost = [
            'title' => 'updated title',
            'body' => 'updated body'
        ];
        
        $response = $this->actingAs($user)->put(route('posts.update', $post->id), $newPost);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', $post->toArray());
    }

    public function test_delete_post(){
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->actingAs($user)->delete(route('posts.destroy', $post->id));
        
        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', $post->toArray());
    }

    public function test_deleting_post_doesnt_belong_to_current_user(){
        $user = $this->user;
        $post = Post::factory()->create([
            'user_id' => $user->id + 1
        ]);
        
        $response = $this->actingAs($user)->delete(route('posts.destroy', $post->id));

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', $post->toArray());
    }
}
