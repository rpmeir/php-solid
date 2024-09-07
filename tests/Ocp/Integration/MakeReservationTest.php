<?php

namespace Tests\Ocp\Integration;

use Src\Ocp\GetReservation;
use Src\Ocp\MakeReservation;
use Src\Ocp\MakeReservationInput;
use Src\Ocp\ReservationRepositoryDatabase;
use Src\Ocp\RoomRepositoryDatabase;
use Src\PostgresDatabaseAdapter;

test("Deve fazer uma reserva, de um quarto com pagamento por dia", function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $roomRepository = new RoomRepositoryDatabase($databaseConnection);
    $reservationRepository = new ReservationRepositoryDatabase($databaseConnection);
    $makeReservation = new MakeReservation(
        $roomRepository,
        $reservationRepository
    );
    $inputData = [
        'roomId' => 'aa354842-59bf-42e6-be3a-6188dbb5fff8',
        'email' => 'qPQp9@example.com',
        'checkinDate' => new \DateTimeImmutable('2023-03-01T00:00:00'),
        'checkoutDate' => new \DateTimeImmutable('2023-03-05T00:00:00'),
    ];
    $inputMakeReservation = new MakeReservationInput(...$inputData);
    $outputMakeReservation = $makeReservation->execute($inputMakeReservation);
    expect($outputMakeReservation->reservationId)->not->toBeEmpty();
    $getReservation = new GetReservation($reservationRepository);
    $outputGetReservation = $getReservation->execute($outputMakeReservation->reservationId);
    expect($outputGetReservation->email)->toBe($inputData['email']);
    expect($outputGetReservation->getStatus())->toBe('active');
    expect($outputGetReservation->getDuration())->toBe(4);
    expect($outputGetReservation->getPrice())->toBe(4000.0);
    $databaseConnection->close();
});

test("Deve fazer uma reserva, de um quarto com pagamento por hora", function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $roomRepository = new RoomRepositoryDatabase($databaseConnection);
    $reservationRepository = new ReservationRepositoryDatabase($databaseConnection);
    $makeReservation = new MakeReservation(
        $roomRepository,
        $reservationRepository
    );
    $inputData = [
        'roomId' => 'd5f5c6cb-bf69-4743-a288-dafed2517e38',
        'email' => 'qPQp9@example.com',
        'checkinDate' => new \DateTimeImmutable('2023-03-01T10:00:00'),
        'checkoutDate' => new \DateTimeImmutable('2023-03-01T12:00:00'),
    ];
    $inputMakeReservation = new MakeReservationInput(...$inputData);
    $outputMakeReservation = $makeReservation->execute($inputMakeReservation);
    expect($outputMakeReservation->reservationId)->not->toBeEmpty();
    $getReservation = new GetReservation($reservationRepository);
    $outputGetReservation = $getReservation->execute($outputMakeReservation->reservationId);
    expect($outputGetReservation->email)->toBe($inputData['email']);
    expect($outputGetReservation->getStatus())->toBe('active');
    expect($outputGetReservation->getDuration())->toBe(2);
    expect($outputGetReservation->getPrice())->toBe(200.0);
    $databaseConnection->close();
});
