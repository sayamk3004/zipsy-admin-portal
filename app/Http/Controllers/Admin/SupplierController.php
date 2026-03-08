<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    // Constructor to apply admin authorization to the controller
    public function __construct()
    {
        // Ensure only admins can access these routes
        $this->middleware('auth'); // Ensure user is authenticated
        $this->middleware('admin'); // Ensure user is an admin
    }

    public function index(Request $request)
    {
        $suppliers = Supplier::when($request->search, function($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->search . '%');
        })->paginate(10);

        return view('admin.users.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('admin.users.suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.users.suppliers.index')->with('success', 'Supplier created successfully');
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.users.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.users.suppliers.index')->with('success', 'Supplier updated successfully');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()->route('admin.users.suppliers.index')->with('success', 'Supplier deleted successfully');
    }
}