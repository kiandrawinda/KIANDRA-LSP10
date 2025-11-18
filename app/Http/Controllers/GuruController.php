<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends BaseCrudController
{
    // Model yang dipakai
    protected $modelClass = Guru::class;

    // Folder view (resources/views/guru/)
    protected $viewPath = 'guru';

    // Prefix route, misal route('guru.index')
    protected $routePrefix = 'guru';

    /**
     * Validasi request untuk create/update
     */
    protected function validateRequest(Request $request, $action = 'store', $id = null)
    {
        return $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|unique:gurus,email' . ($id ? ',' . $id : ''),
        ]);
    }
}

