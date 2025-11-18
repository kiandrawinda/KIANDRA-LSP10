<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BaseCrudController extends Controller
{
    // override di child
    protected $modelClass;        // E.g. App\Models\Mapel::class
    protected $viewPath;         // E.g. 'mapel'
    protected $routePrefix;      // E.g. 'mapel'

    public function index()
    {
        $items = ($this->modelClass)::paginate(15);
        return view("{$this->viewPath}.index", compact('items'));
    }

    public function create()
    {
        return view("{$this->viewPath}.create");
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request, 'store');
        ($this->modelClass)::create($data);
        return redirect()->route("{$this->routePrefix}.index")->with('success','Berhasil disimpan');
    }

    public function edit($id)
    {
        $item = ($this->modelClass)::findOrFail($id);
        return view("{$this->viewPath}.edit", compact('item'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateRequest($request, 'update', $id);
        $item = ($this->modelClass)::findOrFail($id);
        $item->update($data);
        return redirect()->route("{$this->routePrefix}.index")->with('success','Berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = ($this->modelClass)::findOrFail($id);
        $item->delete();
        return redirect()->route("{$this->routePrefix}.index")->with('success','Berhasil dihapus');
    }

    /**
     * Override this in child controllers to provide validation logic.
     * Default: return all request data.
     */
    protected function validateRequest(Request $request, $action = 'store', $id = null)
    {
        return $request->all();
    }
}
