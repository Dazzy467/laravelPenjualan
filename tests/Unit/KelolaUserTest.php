<?php

namespace Tests\Unit;
use Illuminate\Foundation\Testing\Concerns\InteractsWithFacade;
use PHPUnit\Framework\TestCase;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class kelolaUserTest extends TestCase
{
    use InteractsWithFacade;
    /**
     * A basic unit test example.
     */
    // Membuat pengguna baru dan mengalihkan ke tampilan manageuser dengan pesan keberhasilan ketika adduser() dipanggil dengan data yang valid.
    public function test_membuat_pengguna_baru_dan_mengalihkan_ke_manageuser_dengan_pesan_keberhasilan()
    {
        $controller = new AdminController();
        $request = new Request([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => 1
        ]);
    
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'role' => ['required','integer','in:0,1']
        ]);
        
    
        if ($validator->fails()) {
            // Handle validation errors
        }
    
        $response = $controller->adduser($request);
        $response->assertRedirect('admin/manageuser', $response->name());
        $this->assertEquals('User berhasil ditambahkan !', $response->session()->get('success'));
    }
}
