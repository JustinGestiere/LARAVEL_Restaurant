<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Restaurant;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_autorise_peut_creer_une_commande()
    {
        $user = User::factory()->create(['role' => 'restaurateur']);
        $restaurant = Restaurant::factory()->create();
        $item = Item::factory()->create(['restaurant_id' => $restaurant->id]);

        // Associer le user au restaurant (ex: table restaurant_user)
        $restaurant->restaurateurs()->attach($user);

        $this->actingAs($user);

        $response = $this->post('/orders', [
            'restaurant_id' => $restaurant->id,
            'items' => [$item->id],
            'quantities' => [1],
            'order_type' => 'sur place',
        ]);

        $response->assertStatus(302); // Redirection après création
        $this->assertDatabaseHas('orders', [
            'restaurant_id' => $restaurant->id,
            'user_id' => $user->id,
        ]);
    }

    /** @test */
    public function un_utilisateur_non_autorise_ne_peut_pas_creer_une_commande()
    {
        $user = User::factory()->create(['role' => 'client']);
        $restaurant = Restaurant::factory()->create();
        $item = Item::factory()->create(['restaurant_id' => $restaurant->id]);

        $this->actingAs($user);

        $response = $this->post('/orders', [
            'restaurant_id' => $restaurant->id,
            'items' => [$item->id],
            'quantities' => [1],
            'order_type' => 'sur place',
        ]);

        $response->assertStatus(403); // Refusé
    }
}
