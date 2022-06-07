<?php

namespace App\Http\Controllers\Api;

use App\Classes\Meta;
use App\Classes\ResponseHandler;
use App\Http\Controllers\Controller;
use App\Models\Integration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class IntegrationsController extends Controller
{
    //
    public function create(Request $request) {
        try{

            $requestValidations = [
                'marketplace' => ['required', Rule::in(['AMAZON', 'EBAY'])],
                'username' => 'required|unique:integrations,username|min:3',
                'password' => 'required|min:8'
            ];

            $validator = Validator::make($request->toArray(), $requestValidations);

            //Validations Handler
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $integration = Integration::create([
                'marketplace' => $request->marketplace,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);


            return ResponseHandler::successResponse($integration, Meta::SUCCESSFUL);

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

    public function update(Request $request, Integration $integration) {
        try{

            $requestValidations = [
                'marketplace' => ['required', Rule::in(['AMAZON', 'EBAY'])],
                'username' => 'required|unique:integrations,username,'.$integration->id.'|min:3',
                'password' => 'required|min:8'
            ];

            $validator = Validator::make($request->toArray(), $requestValidations);

            //Validations Handler
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $integration->update([
                'marketplace' => $request->marketplace,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);


            return ResponseHandler::successResponse($integration, Meta::SUCCESSFUL);

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
    public function delete(Request $request, Integration $integration) {

        $integration->delete();
        return ResponseHandler::successResponse(['message' => 'Integration has been deleted successfully'], Meta::SUCCESSFUL);

    }

}
