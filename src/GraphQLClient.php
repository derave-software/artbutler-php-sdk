<?php

namespace ArtbutlerPhpSdk;

use GraphQL\Auth\AuthInterface;
use GraphQL\Exception\QueryError;
use GraphQL\Query;
use GraphQL\QueryBuilder\QueryBuilderInterface;
use GraphQL\Results;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Promise\Promise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Psr\Http\Client\ClientInterface;

class GraphQLClient extends \GraphQL\Client
{

    public function __construct(string $endpointUrl, string $tenantId)
    {
        parent::__construct( $endpointUrl, [],
            [
                'headers' => [
                    'Tenant' => $tenantId
                ],
            ]
        );
    }

    public function setToken(string $token)
    {
        $this->httpHeaders['Authorization'] = 'Bearer ' . $token;
    }

    public function runQueryAsync($query, bool $resultsAsArray = false, array $variables = []): Promise
    {
        if ($query instanceof QueryBuilderInterface) {
            $query = $query->getQuery();
        }

        if (!$query instanceof Query) {
            throw new TypeError('Client::runQuery accepts the first argument of type Query or QueryBuilderInterface');
        }

        return $this->runRawQueryAsync((string) $query, $resultsAsArray, $variables);
    }


    public function runRawQueryAsync(string $queryString, $resultsAsArray = false, array $variables = []): Promise
    {
        $request = new Request($this->requestMethod, $this->endpointUrl);

        foreach($this->httpHeaders as $header => $value) {
            $request = $request->withHeader($header, $value);
        }

        // Convert empty variables array to empty json object
        if (empty($variables)) $variables = (object) null;
        // Set query in the request body
        $bodyArray = ['query' => (string) $queryString, 'variables' => $variables];
        $request = $request->withBody(Utils::streamFor(json_encode($bodyArray)));

        if ($this->auth) {
            $request = $this->auth->run($request, $this->options);
        }

        // Send api request and get response
        try {
            $this->httpClient = new \GuzzleHttp\Client($this->options);
            $promise = $this->httpClient->sendAsync($request);
        }
        catch (ClientException $exception) {
        }

        return $promise->then(function(Response $response) {
            return new Results($response, true);
        });
    }

}
