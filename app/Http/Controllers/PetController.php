<?php

namespace App\Http\Controllers;

use App\Services\PetService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PetController extends Controller
{
    private $petService;
    private $client;

    public function __construct(PetService $petService, Client $client)
    {
        $this->petService = $petService;
        $this->client = $client;
    }

    public function index()
    {
        $pets = $this->petService->getAllPets();

        $pets = array_map(function ($pet) {
            return [
                'id' => $pet['id'] ?? null,
                'name' => $pet['name'] ?? 'No name',
                'category' => $pet['category'] ?? ['name' => 'No category'],
                'status' => $pet['status'] ?? 'No status',
            ];
        }, $pets);

        return view('pets.index', compact('pets'));
    }

    public function create()
    {
        return view('pets.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        $data['category'] = ['name' => $data['category']];
        $data['photoUrls'] = [];

        $response = $this->petService->addPet($data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('pets.index');
    }

    public function edit($id)
    {
        $pet = $this->petService->getPetById($id);

        if (isset($pet['error'])) {
            return redirect()->route('pets.index')->withErrors(['error' => $pet['error']]);
        }

        if (!isset($pet['id'])) {
            return redirect()->route('pets.index')->withErrors(['error' => 'Pet not found']);
        }

        return view('pets.edit', compact('pet'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|string|in:available,pending,sold',
        ]);

        $data['category'] = ['name' => $data['category']];

        $data['id'] = $id;

        $response = $this->petService->updatePet($data);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('pets.index');
    }

    public function destroy($id)
    {
        $response = $this->petService->deletePet($id);

        if (isset($response['error'])) {
            return back()->withErrors(['error' => $response['error']]);
        }

        return redirect()->route('pets.index');
    }
}
