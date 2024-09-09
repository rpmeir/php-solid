<?php

namespace Tests\Dip\Integration;

use Src\Dip\EventRepositoryDatabase;
use Src\Dip\GetTicket;
use Src\Dip\PurchaseTicket;
use Src\Dip\TicketRepositoryDatabase;
use Src\PostgresDatabaseAdapter;

test('Deve comprar um ingresso para o evento', function () {
    // given
    $databaseConnection = new PostgresDatabaseAdapter();
    $ticketRepository = new TicketRepositoryDatabase($databaseConnection);
    $eventRepository = new EventRepositoryDatabase($databaseConnection);
    $purchaseTicket = new PurchaseTicket($ticketRepository, $eventRepository);
    $inputPurchaseTicket = [
        'eventId' => "185ff433-a7df-4dd6-ac86-44d219645cb1",
        'email' => "qPQp9@example.com"
    ];
    // when
    $outputPurchaseTicket = $purchaseTicket->execute($inputPurchaseTicket);
    // then
    expect($outputPurchaseTicket->ticketId)->not->toBeEmpty();
    $getTicket = new GetTicket($ticketRepository);
    $outputGetTicket = $getTicket->execute($outputPurchaseTicket->ticketId);
    expect($outputGetTicket->ticketId)->toBe($outputPurchaseTicket->ticketId);
    expect($outputGetTicket->eventId)->toBe($inputPurchaseTicket['eventId']);
    expect($outputGetTicket->email)->toBe($inputPurchaseTicket['email']);
    expect($outputGetTicket->price)->toBe(100.0);

    $databaseConnection->close();
});
