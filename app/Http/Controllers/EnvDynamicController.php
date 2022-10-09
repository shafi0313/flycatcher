<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EnvDynamicController extends Controller
{
    public function index()
    {
        $default_values = [
            'MAIL_MAILER' => env('MAIL_MAILER'),
            'MAIL_HOST' => env('MAIL_HOST'),
            'MAIL_PORT' => env('MAIL_PORT'),
            'MAIL_USERNAME' => env('MAIL_USERNAME'),
            'MAIL_PASSWORD' => env('MAIL_PASSWORD'),
            'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
            'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
            'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        ];
        return view('admin.env-dynamic.index',compact('default_values'));
    }

    public function store(Request $request)
    {
        $env_settings =  $request->only([
            'MAIL_MAILER', 'MAIL_HOST', 'MAIL_PORT', 'MAIL_USERNAME', 'MAIL_PASSWORD', 'MAIL_ENCRYPTION', 'MAIL_FROM_ADDRESS','MAIL_FROM_NAME',
        ]);

        $found_envs = [];
        $env_path = base_path('.env');
        $env_lines = file($env_path);
        foreach ($env_settings as $index => $value) {
            foreach ($env_lines as $key => $line) {
                //Check if present then replace it.
                if (strpos($line, $index) !== false) {
                    $env_lines[$key] = $index . '="' . $value . '"' . PHP_EOL;
                    $found_envs[] = $index;
                }
            }
        }

        $env_content = implode('', $env_lines);
        if (is_writable($env_path) && file_put_contents($env_path, $env_content)) {
            \Toastr::success('Updated successfully', 'Success');
        } else {
            \Toastr::error('Some setting could not be saved, make sure .env file has 644 permission & owned by www-data user', 'Error');
        }

        return redirect()->back();
    }

}
