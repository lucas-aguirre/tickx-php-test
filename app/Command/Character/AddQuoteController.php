<?php

declare(strict_types=1);

namespace App\Command\Character;

use App\Client\HttpClient;
use App\Command\Character\Exceptions\MissingCharacterIdException;
use App\Command\Character\Exceptions\MissingQuoteException;
use App\Helpers\ResponseHelper;
use Minicli\Command\CommandController;

class AddQuoteController extends CommandController
{
    
    public function handle()
    {
        try {
            if($this->hasFlag('help')) {
                $this->getPrinter()->info("To use this command, you need to enter the parameters \"quote\" and \"id\". Example: $ ./minicli character addquote quote=\"Quote example\" id=\"111\"");
                die();
            }

            $quote = $this->getParam('quote') ?? throw new MissingQuoteException();
            $characterId = $this->getParam('id') ?? throw new MissingCharacterIdException();
            $query = '{"query":"mutation CreateQuote {\n  insert_Quote(objects: {text: \"'. $quote .' \", character_id: '. $characterId .'}) {\n    returning {\n      id\n      text\n    }\n  }\n}\n","operationName":"CreateQuote"}';

            $client = HttpClient::handler();

            $response = $client->post('', [
                'body' => $query
            ]);

            $this->getPrinter()->success($response->getbody()->getcontents());
        } catch (MissingQuoteException $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseUnprocessableEntity($th->getMessage())
            );
        } catch (MissingCharacterIdException $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseUnprocessableEntity($th->getMessage())
            );
        } catch (\Throwable $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseBadRequest($th->getMessage())
            );
        }        
    }
}