<?php

namespace Gitescire\LaravelVivoClient\Vivo\Infrastructure;

use Gitescire\LaravelVivoClient\Vivo\Infrastructure\Requests\LaravelVivoClient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class LaravelVivoClientController
 *
 * This class provides a set of methods that can be used to test the Vivo API.
 * The methods are named after the operations they perform: create, read, update, delete.
 *
 * @package Escire\LaravelVivoClient
 */
class LaravelVivoClientController
{

    /**
     * Perform a query operation to create, update or delete (read_only=false) or read (read_only=true) with the Vivo API.
     * It takes a SPARQL query as an input and returns a JSON response.
     * If the application is not in test mode, it returns a 403 error.
     * @param array $request The request with the "query_vivo" and the "read_only_vivo" flag.
     * @return JsonResponse The response of the query.
     */
    public function handler(array $request): JsonResponse
    {
        $query = $request['query_vivo'];
        if ($request['read_only_vivo']) {
            return LaravelVivoClient::sparqlQuery($query);
        } else {
            return LaravelVivoClient::sparqlUpdate($query);
        }
    }

    /**
     * This method is only used for tests and returns a JSON response.
     * If the application is not in test mode, it returns a 403 error.
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Contracts\View\View The response of the application.
     */
    public function web(): View|JsonResponse
    {
        if (!(config('app.debug') && config('laravel-vivo-client.test_mode'))) { //only for tests
            return response()->json(['error' => 'The application is not in test mode.'], 403);
        }

        return view('laravel-vivo-client::components.lvc-web-component');
    }

    /**
     * Perform a aquery operation to create, update or delete (read_only=false) or read (read_only=true) with the Vivo API.
     *
     * @return \Illuminate\Http\JsonResponse  The response of the update operation.
     */
    public function query(Request $request): JsonResponse
    {
        if (!(config('app.debug') && config('laravel-vivo-client.test_mode'))) { //only for tests
            return response()->json(['error' => 'The application is not in test mode.'], 403);
        }

        $query = $request['query_vivo'];
        if ($request['read_only_vivo']) {
            return LaravelVivoClient::sparqlQuery($query);
        } else {
            return LaravelVivoClient::sparqlUpdate($query);
        }
    }

    /**
     * Perform a test operation on the Vivo API.
     *
     * @param  string  $type  The type of the test operation.
     *                        Possible values are 'create', 'read', 'update', 'delete'.
     * @return \Illuminate\Http\JsonResponse  The response of the test operation.
     */
    public function test(string $type): JsonResponse
    {
        if (!(config('app.debug') && config('laravel-vivo-client.test_mode'))) { //only for tests
            return response()->json(['error' => 'The application is not in test mode.'], 403);
        }

        $individualUri = 'http://example.org/individual/n123';
        $label = 'New person';
        $newLabel = 'Modified person';

        return match ($type) {
            'create' => LaravelVivoClient::testCreate($individualUri, $label),
            'read' => LaravelVivoClient::testRead(),
            'update' => LaravelVivoClient::testUpdate($individualUri, $newLabel),
            'delete' => LaravelVivoClient::testDelete($individualUri),
            default => response()->json(['error' => "Invalid type operation: $type"], 400),
        };
    }
}
