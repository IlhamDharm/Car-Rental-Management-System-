<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmailVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_requires_validation(): void
    {
        $response = $this->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'alamat' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'alamat', 'ktp_file', 'sim_file', 'password']);
    }

    public function test_registration_saves_documents_and_sets_status_pending(): void
    {
        Storage::fake('public');

        $ktp = UploadedFile::fake()->image('ktp.jpg');
        $sim = UploadedFile::fake()->image('sim.jpg');

        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'alamat' => 'Jl. Merdeka No. 45',
            'ktp_file' => $ktp,
            'sim_file' => $sim,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/email/verify');

        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'alamat' => 'Jl. Merdeka No. 45',
            'verification_status' => 'pending',
        ]);

        $user = User::where('email', 'johndoe@example.com')->first();

        // Assert files are stored
        Storage::disk('public')->assertExists($user->ktp_file);
        Storage::disk('public')->assertExists($user->sim_file);
    }

    public function test_pending_user_is_redirected_to_verify_page(): void
    {
        $user = User::factory()->create([
            'verification_status' => 'pending',
        ]);

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertRedirect('/email/verify');
    }

    public function test_approved_user_can_access_profile(): void
    {
        $user = User::factory()->create([
            'verification_status' => 'approved',
        ]);

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertStatus(200);
    }

    public function test_rejection_restricts_profile_access(): void
    {
        $user = User::factory()->create([
            'verification_status' => 'rejected',
        ]);

        $response = $this->actingAs($user)->get('/user/profile');

        $response->assertRedirect('/email/verify');
    }
}
