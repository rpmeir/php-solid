<?php

namespace Tests\Dip\Integration;

use Src\Dip\Application\UseCases\GetTicket;
use Src\Dip\Application\UseCases\PurchaseTicket;
use Src\Dip\Infra\Database\RepositoryFactoryDatabase;
use Src\Dip\Infra\Fake\RepositoryFactoryFake;
use Src\PostgresDatabaseAdapter;

test('Deve comprar um ingresso para o evento', function () {
    // given
    $databaseConnection = new PostgresDatabaseAdapter();
    $repositoryFactory = new RepositoryFactoryDatabase($databaseConnection);
    // OR
    //$repositoryFactory = new RepositoryFactoryFake(); // whithout databaseConnection parameter
    $purchaseTicket = new PurchaseTicket($repositoryFactory);
    $getTicket = new GetTicket($repositoryFactory);
    $inputPurchaseTicket = [
        'eventId' => "185ff433-a7df-4dd6-ac86-44d219645cb1",
        'email' => "qPQp9@example.com"
    ];
    // when
    $outputPurchaseTicket = $purchaseTicket->execute($inputPurchaseTicket);
    // then
    expect($outputPurchaseTicket->ticketId)->not->toBeEmpty();
    $outputGetTicket = $getTicket->execute($outputPurchaseTicket->ticketId);
    expect($outputGetTicket->ticketId)->toBe($outputPurchaseTicket->ticketId);
    expect($outputGetTicket->eventId)->toBe($inputPurchaseTicket['eventId']);
    expect($outputGetTicket->getEmail())->toBe($inputPurchaseTicket['email']);
    expect($outputGetTicket->price)->toBe(100.0);
    $databaseConnection->close();
})->group('integration', 'dip', 'purchase-ticket');
