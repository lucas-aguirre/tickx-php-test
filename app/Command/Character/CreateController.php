<?php

declare(strict_types=1);

namespace App\Command\Character;

use App\Client\HttpClient;
use App\Command\Character\Exceptions\CharacterNameDuplicateKeyValueException;
use App\Command\Character\Exceptions\MissingCharacterNameException;
use App\Helpers\ResponseHelper;
use Minicli\Command\CommandController;

class CreateController extends CommandController
{
    
    public function handle()
    {
        try {           
            if($this->hasFlag('help')) {
                $this->getPrinter()->info("To use this command, you need to enter the parameter \"name\". Example: $ ./minicli character create name=\"Character name\"");
                die();
            }

            $name = $this->getParam('name') ?? throw new MissingCharacterNameException();
            $query = '{"query":"mutation CreateCharacter {\n  insert_Character(objects: {name: \"'. $name .'\"}) {\n    returning {\n      id\n    }\n  }\n}","operationName":"CreateCharacter"}';

            $client = HttpClient::handler();

            $response = $client->post('', [
                'body' => $query
            ]);        
            $responseContents = $response->getbody()->getcontents();   

            //The API return always succeeds, even when it fails to create. I am creating this validation based on the return message. There may be a problem if the character name contains the words
            if(strpos($responseContents, 'Uniqueness violation. duplicate key value') !== false) {
                throw new CharacterNameDuplicateKeyValueException();
            }

            $this->getPrinter()->success(
                ResponseHelper::responseCreated('Character created successfully', $responseContents)
            );
        } catch (MissingCharacterNameException $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseUnprocessableEntity($th->getMessage())
            );
        } catch (CharacterNameDuplicateKeyValueException $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseBadRequest($th->getMessage())
            );
        } catch (\Throwable $th) {
            $this->getPrinter()->error(
                ResponseHelper::responseBadRequest($th->getMessage())
            );
        }    
    }
}