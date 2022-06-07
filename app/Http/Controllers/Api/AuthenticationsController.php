<?php

namespace App\Http\Controllers\Api;

use App\Classes\Meta;
use App\Classes\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
class AuthenticationsController extends Controller
{
    public function register(Request $request) {
        try{

            $requestValidations = [
                'email' => 'required|email|unique:users',
                'name' => 'required|min:3',
                'password' => 'required|min:8'
            ];
            $validator = Validator::make($request->toArray(), $requestValidations);

            //Validations Handler
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $access_token = $user->createToken('authToken')->plainTextToken; // Generate token

            return ResponseHandler::successResponse([
                'token' => $access_token
            ], Meta::SUCCESSFUL);

        }catch(ValidationException $e){
            $errors = $e->errors();
            $errors = flattenArray(array_values((array)$errors));
            $message = $errors[0];
            $status = Meta::VALIDATION_ERROR;

        } catch(\Exception $e) {
            $message = 'Oops, something went wrong.';
            $status = Meta::SERVER_ERROR;

        }

        return ResponseHandler::errorResponse($message, $status);

    }
}
