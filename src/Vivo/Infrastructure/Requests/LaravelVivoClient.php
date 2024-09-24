<?php

namespace Gitescire\LaravelVivoClient\Vivo\Infrastructure\Requests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;


class LaravelVivoClient
{

    /**
     * Perform a sparqlUpdate to create, update or delete an operation with the Vivo API.
     *
     * @param string $query The SPARQL query to execute.
     * @return \Illuminate\Http\JsonResponse The response of the create operation.
     */
    public static function sparqlUpdate(string $query): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $client = new Client();

        try {
            $response = $client->post($urlVivo . '/api/sparqlUpdate', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'update' => $query,
                ],
            ]);

            return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => json_decode($response->getBody(), true),]);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    /**
     * Perform a sparqlQuery to read data with the Vivo API.
     *
     * @param string $query The SPARQL query to execute.
     * @return \Illuminate\Http\JsonResponse The response of the query operation.
     */
    public static function sparqlQuery(string $query): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $client = new Client();

        try {
            $response = $client->post($urlVivo . '/api/sparqlQuery', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'query' => $query,
                ],
            ]);

            $body = (string) $response->getBody();
            $decodedBody = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => $decodedBody,]);
            } else {
                return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => $body,]);
            }
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    #region test events

    /**
     * Perform a create operation on the Vivo API.
     *
     * @param string $individualUri The URI of the individual to create.
     * @param string $label The label of the individual to create.
     *
     * @return \Illuminate\Http\JsonResponse The response of the create operation.
     */
    public static function testCreate(string $individualUri, string $label): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $graphVivo = $config['graph_vivo'];
        $client = new Client();

        try {
            $query = 'PREFIX vivo: <http://vivoweb.org/ontology/core#> INSERT DATA { GRAPH <' . $graphVivo . '> { <' . $individualUri . '> vivo:label \'' . $label . '\' . } }';
            $response = $client->post($urlVivo . '/api/sparqlUpdate', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'update' => $query,
                ],
            ]);

            return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => json_decode($response->getBody(), true),]);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    /**
     * Perform a read operation on the Vivo API.
     *
     * @return \Illuminate\Http\JsonResponse The response of the read operation.
     */
    public static function testRead(): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $graphVivo = $config['graph_vivo'];
        $client = new Client();

        try {
            $query = 'PREFIX vivo: <http://vivoweb.org/ontology/core#> SELECT ?s ?p ?o WHERE { GRAPH <' . $graphVivo . '> { ?s ?p ?o } }';
            $response = $client->post($urlVivo . '/api/sparqlQuery', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'query' => $query,
                ],
            ]);

            $body = (string) $response->getBody();
            $decodedBody = json_decode($body, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => $decodedBody,]);
            } else {
                return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => $body,]);
            }
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    /**
     * Perform an update operation on the Vivo API.
     *
     * @param string $individualUri The URI of the individual to update.
     * @param string $newLabel The new label of the individual to update.
     *
     * @return \Illuminate\Http\JsonResponse The response of the update operation.
     */
    public static function testUpdate(string $individualUri, string $newLabel): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $graphVivo = $config['graph_vivo'];
        $client = new Client();

        try {
            $query =  '
                        PREFIX vivo: <http://vivoweb.org/ontology/core#> 
                        DELETE { 
                            GRAPH <' . $graphVivo . '> { 
                                <' . $individualUri . '> vivo:label ?oldLabel . 
                            } 
                        } 
                        INSERT { 
                            GRAPH <' . $graphVivo . '> { 
                                <' . $individualUri . '> vivo:label \'' . $newLabel . '\' . 
                            } 
                        } 
                        WHERE { 
                            GRAPH <' . $graphVivo . '> { 
                                <' . $individualUri . '> vivo:label ?oldLabel . 
                            } 
                        }
                    ';
            $response = $client->post($urlVivo . '/api/sparqlUpdate', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'update' => $query,
                ],
            ]);

            return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => json_decode($response->getBody(), true),]);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    /**
     * Test the delete operation on the Vivo API.
     *
     * @param  string  $individualUri   The URI of the individual that will be searched.
     * @return \Illuminate\Http\JsonResponse  The response of the delete operation.
     */
    public static function testDelete(string $individualUri): JsonResponse
    {
        $config = config('laravel-vivo-client');
        $urlVivo = $config['url_vivo'];
        $emailUserVivo = $config['email_user_vivo'];
        $passwordUserVivo = $config['password_user_vivo'];
        $graphVivo = $config['graph_vivo'];
        $client = new Client();

        try {
            $query = '
                        PREFIX vivo: <http://vivoweb.org/ontology/core#> 
                        DELETE { 
                            GRAPH <' . $graphVivo . '> { 
                                <' . $individualUri . '> vivo:label ?oldLabel . 
                            } 
                        } 
                        WHERE { 
                            GRAPH <' . $graphVivo . '> { 
                                <' . $individualUri . '> vivo:label ?oldLabel . 
                            } 
                        }
                    ';
            $response = $client->post($urlVivo . '/api/sparqlUpdate', [
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                'form_params' => [
                    'email' => $emailUserVivo,
                    'password' => $passwordUserVivo,
                    'update' => $query,
                ],
            ]);

            return response()->json(['code' => $response->getStatusCode(), 'message' => $response->getReasonPhrase(), 'body' => json_decode($response->getBody(), true),]);
        } catch (GuzzleException $e) {
            return response()->json(['error' => $e->getMessage(),], 500);
        }
    }

    #endregion test events

}