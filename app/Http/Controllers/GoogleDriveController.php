<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class GoogleDriveController extends Controller
{
    private function getClient()
    {
        $client = new Client();
        $client->setAuthConfig(storage_path('app/google/credenciales.json'));
        $client->addScope(Drive::DRIVE_FILE);
        $client->setRedirectUri(url('/oauth2callback'));
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        // Si ya hay un token guardado, úsalo
        if (Session::has('google_token')) {
            $client->setAccessToken(Session::get('google_token'));

            // Si el token expiró, refrescarlo
            if ($client->isAccessTokenExpired()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
                Session::put('google_token', $client->getAccessToken());
            }
        }

        return $client;
    }

    // Redirigir al usuario para autorizar acceso
    public function redirectToGoogle()
    {
        $client = $this->getClient();
        return redirect()->away($client->createAuthUrl());
    }

    // Guardar token cuando Google redirige
    public function handleCallback(Request $request)
    {
        $client = $this->getClient();
        $token = $client->fetchAccessTokenWithAuthCode($request->code);
        Session::put('google_token', $token);

        return redirect()->route('google.auth')->with('success', 'Conexión establecida correctamente con Google Drive.');
    }

    // Subir imagen
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|file|mimes:jpg,jpeg,png|max:4096'
        ]);

        $client = $this->getClient();

        if (!$client->getAccessToken()) {
            return redirect()->route('google.auth');
        }

        $service = new Drive($client);

        $filePath = $request->file('image')->getRealPath();
        $fileName = $request->file('image')->getClientOriginalName();

        $fileMetadata = new Drive\DriveFile(['name' => $fileName]);
        $content = file_get_contents($filePath);

        $file = $service->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => $request->file('image')->getMimeType(),
            'uploadType' => 'multipart',
            'fields' => 'id, webViewLink, webContentLink'
        ]);


        // Hacerlo público
        $permission = new Drive\Permission([
            'type' => 'anyone',
            'role' => 'reader'
        ]);
        $service->permissions->create($file->id, $permission);

      ///  $url = "https://drive.google.com/uc?id=" . $file->id;
       // $url = "https://drive.google.com/uc?export=view&id=".$file->id;

$url = $file->webContentLink ?? $file->webViewLink ?? "https://drive.google.com/uc?id=" . $file->id;

        return response()->json([
            'success' => true,
            'url' => $url,
            'message' => 'Imagen subida correctamente'
        ]);
    }
   
public function upload2(Request $request)
{
    $request->validate([
        'image' => 'required|file|mimes:jpg,jpeg,png|max:4096'
    ]);

    try {
        $file = $request->file('image');

        $response = Http::attach(
            'image',
            file_get_contents($file->getRealPath()),
            $file->getClientOriginalName()
        )->post('http://mysqltablas.atwebpages.com/public/upload.php');

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Error en la conexión al servidor remoto'
            ]);
        }
    } catch (\Throwable $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
}



}
