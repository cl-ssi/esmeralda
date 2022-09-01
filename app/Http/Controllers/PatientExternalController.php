<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Patient;

class PatientExternalController extends Controller
{

    public function autenticar(Request $request)
    {
        /* Primer paso, redireccionar al login de clave única */
        $url_base       = "https://accounts.claveunica.gob.cl/openid/authorize/";
        $client_id      = env("CLAVEUNICA_CLIENT_ID");
        $redirect_uri   = urlencode(env("CLAVEUNICA_CALLBACK"));

        $state = csrf_token();
        $scope      = 'openid run name';

        $params     = '?client_id='.$client_id.
                      '&redirect_uri='.$redirect_uri.
                      '&scope='.$scope.
                      '&response_type=code'.
                      '&state='.$state;

        return redirect()->to($url_base.$params)->send();
    }

    public function callback(Request $request) {
        /* Segundo paso, el usuario ya se autentificó correctamente en CU y retornó a nuestro sistema */

        /* Recepcionamos los siguientes parametros desde CU */
        $code   = $request->input('code');
        $state  = $request->input('state'); 
        
        $url_base       = "https://accounts.claveunica.gob.cl/openid/token/";
        $client_id      = env("CLAVEUNICA_CLIENT_ID");
        $client_secret  = env("CLAVEUNICA_SECRET_ID");
        $redirect_uri   = urlencode(env("CLAVEUNICA_CALLBACK"));

        $scope = 'openid+run+name';

        $response = Http::asForm()->post($url_base, [
            'client_id'     => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri'  => $redirect_uri,
            'grant_type'    => 'authorization_code',
            'code'          => $code,
            'state'         => $state,
        ]);

       
        $access_token = json_decode($response)->access_token ?? null;

        /** Si no existe el acces token */
        if(is_null($access_token))
        {
            return redirect()->route('welcome');
        }

        /* Paso 3, obtener los datos del usuario en base al $access_token */
        $url_base = "https://www.claveunica.gob.cl/openid/userinfo/";
        $response = Http::withToken(json_decode($response)->access_token)->post($url_base);
        
        $userClaveUnica = json_decode($response,true);

        $run = $userClaveUnica['RolUnico']['numero'] ?? null;

        $patient = Patient::where('run', $run)->first();

        if($patient AND $run != null) {
            Auth::guard('patients')->login($patient);            
            return redirect()->route('examenes.home');
        }
        else {
            $request->session()->put('run_not_found', $run);
            return redirect()->route('examenes.logout-cu');
        }     

    }

    public function home()
    {
        return view('homepatient');
    }
    
    public function logoutCu() {
        /* Nos iremos al cerrar sesión en clave única y luego volvermos a nuestro sistema */
        if(env('APP_ENV') == 'local')
        {
            /* Si es ambiente de desarrollo cerramos sólo localmente */
            return redirect()->route('examenes.logout');
        }
        else
        {
            /** Cerrar sesión clave única */
            /* Url para cerrar sesión en clave única */
            $url_logout     = "https://accounts.claveunica.gob.cl/api/v1/accounts/app/logout?redirect=";
            /* Url para luego cerrar sesión en nuestro sisetema */
            $url_redirect   = env('APP_URL')."/examenes/logout";
            $url            = $url_logout.urlencode($url_redirect);
            return redirect($url);
        }        

    }

    public function logout(Request $request) {
        if ($request->session()->has('run_not_found')) {
            $run = $request->session()->pull('run_not_found');
        }
        
        Auth::guard('patients')->logout();

        if(isset($run)) {
            session()->flash('danger', 'El RUN '.$run.' no tiene registro de exámenes en el sistema');
        }

        return redirect()->route('welcome');
    }

}
