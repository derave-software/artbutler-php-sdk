<?php

namespace ArtbutlerPhpSdk;

use ArtbutlerPhpSdk\GraphQL\Work;
use GraphQL\Query;


class GraphQlApiClient
{


    public function __construct()
    {
        
        $graphQlClient =  (new \GraphQL\Client(
            'http://app'
        ));

        dd($graphQlClient);
//        $this->httpClient = (new \GuzzleHttp\Client([
//            'base_uri' => 'http://app'
//        ]));
    }

    public function post(array $params, string $token){
        $this->response =  $this->httpClient->request('POST', 'graphql', [
            'headers'=>[
                'Authorization' => 'Bearer ' . $token,
                'Content-type' => 'application/json',
            ],
            'body' => json_encode($params)
        ]);

        return $this;
    }

    public function getContent()
    {
        return json_decode($this->response->getBody()->getContents(), true);
    }

    public function getToken(){
        $tenantId = '77777777-7777-7777-7777-777777777777';
        $websiteClientToken = '';

        return "eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJick9NYk9maE1MN3Rkbk5Pd2M2U3h3TFBXQU9JMm1mT3A3dHNpOVBuMDZvIn0.eyJleHAiOjE2NTMxMzc0MTAsImlhdCI6MTY0Mjc3MTc4OCwiYXV0aF90aW1lIjoxNjQyNzY5NDExLCJqdGkiOiJlMDJhODViNy1mZTNmLTRhOTQtOWZmNy01YzEzZWM4MzU1N2MiLCJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwODAvYXV0aC9yZWFsbXMvbWFzdGVyIiwiYXVkIjoiYWNjb3VudCIsInN1YiI6IjU3ZGE0YjAxLWJhZGUtNGE4Mi1iNjcyLWUwMGI1OTk1YzkzMiIsInR5cCI6IkJlYXJlciIsImF6cCI6InZ1ZS1jbGllbnQiLCJub25jZSI6ImYwNGRkNWJiLTQ0YWQtNGJlNy04ZGFlLTM1MmZjNzY4ODMwNiIsInNlc3Npb25fc3RhdGUiOiJiMGNhMzhlNC0wMTY4LTQwOTUtYjYwMy0yMDRlNzM4Y2EzYzciLCJhY3IiOiIwIiwiYWxsb3dlZC1vcmlnaW5zIjpbImh0dHA6Ly9sb2NhbGhvc3Q6ODA4MiJdLCJyZWFsbV9hY2Nlc3MiOnsicm9sZXMiOlsiZGVmYXVsdC1yb2xlcy1tYXN0ZXIiLCJvZmZsaW5lX2FjY2VzcyIsInVtYV9hdXRob3JpemF0aW9uIl19LCJyZXNvdXJjZV9hY2Nlc3MiOnsiYWNjb3VudCI6eyJyb2xlcyI6WyJtYW5hZ2UtYWNjb3VudCIsIm1hbmFnZS1hY2NvdW50LWxpbmtzIiwidmlldy1wcm9maWxlIl19fSwic2NvcGUiOiJvcGVuaWQgcHJvZmlsZSBlbWFpbCIsInRlbmFudF9pZCI6Ijc3Nzc3Nzc3LTc3NzctNzc3Ny03Nzc3LTc3Nzc3Nzc3Nzc3NyIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwibmFtZSI6Ik5vcmEgSGludHoiLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJrZXljbG9ha19yYXVsODQiLCJnaXZlbl9uYW1lIjoiTm9yYSIsImZhbWlseV9uYW1lIjoiSGludHoiLCJlbWFpbCI6InNldmVuQGRlcmF2ZXNvZnR3YXJlLmNvbSJ9.laWGFvW3cM-ZDSppQxk43-_2CKAagylvLZ5CJu5yJ7_ferJAbe8WRiY1-yxWRTNEPgycD2mjY5zs2RNPVICAYHOpQ2U7mVM8p4eERVAdZuz8VViKafo0RR-ydfsheuyIcYK5N_tN2_vfNvoUu_DOwy5Z0L6xNx7ZMJPLajsYdrtJbA-6x_TrWEyUAsbUO6Y31TO6UhUvelBDr83PeMDSTsOwHfkSk8czPhTtOrQ6K-ZkTi6fqnvOP2m8l2_xRmlYDbDBTjHqmO4XLyxgveSlDmZAFtqWlGp-zXX75s8Yirr-8vu2EHBGEBSHkHv7RJV_816lTnhzNBRIL4SX_poh_Q";
    }

}
