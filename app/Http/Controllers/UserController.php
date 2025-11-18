<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;



class UserController extends Controller
{
    protected $userDummy = [

        [

            'id' => 1,

            'nama' => 'Andi Wijaya',

            'email' => 'andi@example.com',

        ],

        [

            'id' => 2,

            'nama' => 'Budi Santoso',

            'email' => 'budi@example.com',

        ],

        [

            'id' => 3,

            'nama' => 'Cici Amelia',

            'email' => 'cici@example.com',

        ],

    ];



    // Menampilkan semua user

    public function index()
    {

        return response()->json($this->userDummy);

    }



    // Menampilkan user berdasarkan ID

    public function show($id)
    {

        $user = collect($this->userDummy)->firstWhere('id', $id);



        if (!$user) {

            return response()->json(['message' => 'User tidak ditemukan'], 404);

        }



        return response()->json($user);

    }



    // Menambahkan user baru

    public function store(Request $request)
    {

        $validated = $request->validate([

            'nama' => 'required|string|max:255',

            'email' => 'required|email',

        ]);



        $newUser = [

            'id' => count($this->userDummy) + 1,

            'nama' => $validated['nama'],

            'email' => $validated['email'],

        ];



        $this->userDummy[] = $newUser;



        return response()->json($newUser, 201);

    }



   public function update(Request $request, $id)

   {

       $userIndex = collect($this->userDummy)->search(fn($u) => $u['id'] == $id);



       if ($userIndex === false) {

           return response()->json(['message' => 'User tidak ditemukan'], 404);

       }



       $validated = $request->validate([

           'nama' => 'required|string|max:255',

           'email' => 'required|email',

       ]);



       $this->userDummy[$userIndex] = [

           'id' => $id,

           'nama' => $validated['nama'],

           'email' => $validated['email'],

       ];



       return response()->json($this->userDummy[$userIndex]);

   }



   // Menghapus user

   public function destroy($id)

   {

       $userIndex = collect($this->userDummy)->search(fn($u) => $u['id'] == $id);



       if ($userIndex === false) {

           return response()->json(['message' => 'User tidak ditemukan'], 404);

       }



       array_splice($this->userDummy, $userIndex, 1);



       return response()->json(['message' => 'User berhasil dihapus']);

   }

}