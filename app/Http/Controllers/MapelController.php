<?php
namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends BaseCrudController
{
    protected $modelClass = Mapel::class;
    protected $viewPath = 'mapel';
    protected $routePrefix = 'mapel';

    protected function validateRequest(Request $request, $action = 'store', $id = null)
    {
        // Sesuaikan dengan kolom tabel: 'nama' dan 'durasi'
        return $request->validate([
            'nama' => 'required|string|max:255',
            'durasi' => 'required|string|max:50',
        ]);
    }
}
