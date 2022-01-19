<?php

declare(strict_types=1);

namespace App\Command\Character;

use App\Client\HttpClient;
use App\Helpers\ResponseHelper;
use Minicli\Command\CommandController;

class RetrieveController extends CommandController
{

    public function handle()
    {
        try {
            if ($this->hasFlag('help')) {
                $this->getPrinter()->info("To use this command, you don't need to enter any parameters, just invoke the command. Example: $ ./minicli character retrieve");
                die();
            }
            
            $query = '{"query":"{\n  Character {\n    Quotes {\n      text\n      id\n    }\n    id\n    image_url\n    name\n  }\n}\n"}';

            $client = HttpClient::handler();

            $response = $client->post('', [
                'body' => $query
            ]);

            return $this->getPrinter()->success($response->getbody()->getcontents());
        } catch (\Throwable $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseBadRequest($th->getMessage())
            );
        }
    }
}
