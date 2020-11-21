<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowAllArticles(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(route('articles.index'));
        $response->assertSee($article->title);
    }


    public function testCreateArticlePage(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('articles.create'));
        $response
            ->assertSee('Title')
            ->assertSee('Content')
            ->assertSee('Create');
    }

    public function testCreateNewArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->followingRedirects();

        $response = $this->post(route('articles.store'), [
            'title' => 'Example title',
            'content' => 'Example content'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'user_id' => $user->id,
            'title' => 'Example title',
            'content' => 'Example content'
        ]);
    }

    public function testShowOneArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->get(route('articles.show', $article));
        $response->assertSee($article->title);
    }

    public function testEditArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create([
            'user_id' => $user->id,
            'title' => 'Example title',
            'content' => 'Example content'
        ]);

        $response = $this->get(route('articles.edit', $article));
        $response
            ->assertSee('Example title')
            ->assertSee('Example content');
    }

    public function testUpdateArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->followingRedirects();

        $response = $this->put(route('articles.update', $article), [
            'title' => 'Edited title',
            'content' => 'Edited content'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('articles', [
            'title' => 'Edited title',
            'content' => 'Edited content'
        ]);
    }

    public function testDeleteArticle(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('articles', [
            'user_id' => $user->id,
            'title' => $article->title,
            'content' => $article->content
        ]);

        $this->followingRedirects();

        $response = $this->delete(route('articles.destroy', $article));

        $response->assertStatus(200);
        $this->assertDatabaseMissing('articles', [
            'user_id' => $user->id,
            'title' => $article->title,
            'content' => $article->content
        ]);
    }
}
