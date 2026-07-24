<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SystemAuditTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Seed default Super Admin
        User::create([
            'name' => 'Super Administrator',
            'username' => 'atlasstudio90',
            'email' => 'atlasstudio90@gmail.com',
            'password' => Hash::make('mikaliso77-90ky-zack'),
            'is_admin' => true,
            'role' => 'super_admin',
            'status' => 'active',
            'provider' => 'local',
            'email_verified_at' => now(),
        ]);
    }

    /** @test */
    public function test_admin_authentication_with_email_and_password()
    {
        $response = $this->post(route('admin.login.submit'), [
            'username' => 'atlasstudio90@gmail.com',
            'password' => 'mikaliso77-90ky-zack',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    /** @test */
    public function test_phone_otp_verification_creates_and_authenticates_user()
    {
        $response = $this->postJson(route('auth.phone.verify'), [
            'phone' => '081234567890',
            'otp' => '888888',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('users', [
            'phone' => '081234567890',
            'provider' => 'phone',
        ]);
    }

    /** @test */
    public function test_non_admin_cannot_access_admin_dashboard()
    {
        $student = User::create([
            'name' => 'Regular Student',
            'username' => 'student1',
            'email' => 'student1@example.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
            'role' => 'student',
        ]);

        $this->actingAs($student);

        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function test_super_admin_can_access_users_management()
    {
        $admin = User::where('role', 'super_admin')->first();
        $this->actingAs($admin);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
        $response->assertSee('User Management');
    }

    /** @test */
    public function test_user_export_csv_excel_pdf_endpoints()
    {
        $admin = User::where('role', 'super_admin')->first();
        $this->actingAs($admin);

        $csv = $this->get(route('admin.users.export.csv'));
        $csv->assertStatus(200);

        $excel = $this->get(route('admin.users.export.excel'));
        $excel->assertStatus(200);

        $pdf = $this->get(route('admin.users.export.pdf'));
        $pdf->assertStatus(200);
    }

    /** @test */
    public function test_multilingual_locale_switching()
    {
        $response = $this->get(route('lang.switch', 'en'));
        $response->assertSessionHas('locale', 'en');

        $responseId = $this->get(route('lang.switch', 'id'));
        $responseId->assertSessionHas('locale', 'id');
    }

    /** @test */
    public function test_ai_analyzer_file_upload_validation()
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('test_photo.jpg', 500, 'image/jpeg');

        $response = $this->postJson(route('ai.analyze'), [
            'image' => $file,
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    /** @test */
    public function test_inactive_user_cannot_login()
    {
        $inactive = User::create([
            'name' => 'Inactive User',
            'username' => 'inactive1',
            'email' => 'inactive@example.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
            'status' => 'inactive',
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'username' => 'inactive@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }
}
