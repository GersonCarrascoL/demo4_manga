<?php
    namespace App\Http\Repositories;

    use DB;
    use Validator;

    class MangaRepository
    {
        public function __construct()
    {
        //
    }
        public function getMangas()
        {
            $mangas = DB::table('manga')->select('*')->get();
            
            return response()->json([
                'data'=>$mangas
            ],200);
        }

        public function getManga($id)
        {
            $manga = DB::table('manga')->select('*')->where('idmanga','=',$id)->get();
            
            return response()->json([
                'data'=>$manga
            ],200);
        }

        public function postManga($request)
        {
            $validate = Validator::make($request->all(),[
                'mangaName' => 'required',
                'mangaAuth' => 'required',
                'mangaDate' => 'required',
                'mangaDescription' => 'required',
                'mangaImage' => 'required',
                'idCategory' => 'required|numeric',
            ]);

            if ($validate->fails()) {
                return response()->json(["message" => 'Validate fails', "errors" => $validate->errors()]);
            }

            $mangaName = $request->input('mangaName');
            $mangaAuth = $request->input('mangaAuth');
            $mangaDate = $request->input('mangaDate');
            $mangaDescription = $request->input('mangaDescription');
            $mangaImage = $request->input('mangaImage');
            $idCategory = $request->input('idCategory');

            $manga = DB::table('manga')
                ->insertGetId([
                    'mangaName' => $mangaName,
                    'mangaAuth' => $mangaAuth,
                    'mangaDate' => $mangaDate,
                    'mangaDescription' => $mangaDescription,
                    'mangaImage' => $mangaImage,
                    'category_idCategory' => $idCategory
                ]);

            return response()->json(["message" => 'Insert successfull'],201);
        }

        public function patchManga($request,$id)
        {
            $mangaName = $request->input('mangaName');
            $mangaAuth = $request->input('mangaAuth');
            $mangaDate = $request->input('mangaDate');
            $mangaDescription = $request->input('mangaDescription');
            $mangaImage = $request->input('mangaImage');
            $idCategory = $request->input('idCategory');

            $manga = DB::table('manga')
                ->where('idmanga',$id)
                ->update([
                    'mangaName' => $mangaName,
                    'mangaAuth' => $mangaAuth,
                    'mangaDate' => $mangaDate,
                    'mangaDescription' => $mangaDescription,
                    'mangaImage' => $mangaImage,
                    'category_idCategory' => $idCategory
                ]);

            return response()->json(["message" => 'Update successfull'],200);
        }
    }
?>