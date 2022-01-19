<?php

declare(strict_types=1);

namespace App\Command\Character;

use App\Client\HttpClient;
use App\Helpers\ResponseHelper;
use Minicli\Command\CommandController;

class DeleteController extends CommandController
{
    
    public function handle()
    {
        try {
            if ($this->hasFlag('help')) {
                $this->getPrinter()->info("To use this command, you don't need to enter any parameters, just invoke the command. Example: $ ./minicli character delete");
                die();
            }

            $query = '{"query":"mutation DeleteAll {\n  delete_Character(where: {id: {_gt: 0}}) {\n    affected_rows\n  }\n}\n","operationName":"DeleteAll"}';

            $client = HttpClient::handler();

            $response = $client->post('', [
                'body' => $query
            ]);

            $this->getPrinter()->success($response->getbody()->getcontents());
        } catch (\Throwable $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseBadRequest($th->getMessage())
            );
        }   
    }
}