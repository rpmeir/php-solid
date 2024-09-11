<?php

namespace Tests\Dip\Unit;
use Ramsey\Uuid\Uuid;
use Src\Dip\Ticket;

test('Deve criar um ingresso', function () {
    $ticketId = Uuid::uuid4()->toString();
    $eventId = Uuid::uuid4()->toString();
    $ticket = new Ticket($ticketId, $eventId, 'test@example.com', 100.0);
    expect($ticket->ticketId)->toBe($ticketId);
    expect($ticket->eventId)->toBe($eventId);
    expect($ticket->getEmail())->toBe('test@example.com');
    expect($ticket->price)->toBe(100.0);
});

// nao deve criar ticker com email invalido
test('Nao deve criar um ingresso com email invalido', function () {
    expect(fn() => new Ticket(Uuid::uuid4()->toString(), Uuid::uuid4()->toString(), 'qPQp9@', 100.0))
        ->toThrow(\InvalidArgumentException::class, 'Invalid email');
});

// nao deve criar ticker com preco negativo
test('Nao deve criar um ingresso com preco negativo ou zero', function () {
    expect(fn() => new Ticket(Uuid::uuid4()->toString(), Uuid::uuid4()->toString(), 'qPQp9@example.com', -100.0))
        ->toThrow(\InvalidArgumentException::class, 'Invalid price');
});
