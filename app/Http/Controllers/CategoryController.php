<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;


class CategoryController extends Controller

{

   // Dummy kategori

   protected $kategoriDummy = [

       ['id' => 1, 'nama' => 'Fantasi'],

       ['id' => 2, 'nama' => 'Slice of Life'],

       ['id' => 3, 'nama' => 'Geologi'],

       ['id' => 4, 'nama' => 'Horor'],

       ['id' => 5, 'nama' => 'Romansa'],

   ];

 public function store(Request $request)

   {

       $validated = $request->validate([

           'nama' => 'required|string|max:255'

       ]);



       $newKategori = [

           'id' => count($this->kategoriDummy) + 1,

           'nama' => $validated['nama']

       ];



       $this->kategoriDummy[] = $newKategori;



       return response()->json($newKategori, 201);

   }



   // Update kategori

   public function update(Request $request, $id)

   {

       $index = collect($this->kategoriDummy)

           ->search(fn($k) => $k['id'] == $id);



       if ($index === false) {

           return response()->json(['message' => 'Kategori tidak ditemukan'], 404);

       }



       $validated = $request->validate([

           'nama' => 'required|string|max:255',

       ]);



       $this->kategoriDummy[$index] = [

           'id' => $id,

           'nama' => $validated['nama']

       ];



       return response()->json($this->kategoriDummy[$index]);

   }



   // Hapus kategori

   public function destroy($id)

   {

       $index = collect($this->kategoriDummy)

           ->search(fn($k) => $k['id'] == $id);



       if ($index === false) {

           return response()->json(['message' => 'Kategori tidak ditemukan'], 404);

       }



       array_splice($this->kategoriDummy, $index, 1);



       return response()->json(['message' => 'Kategori berhasil dihapus']);

   }

}
