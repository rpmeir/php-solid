<?php

declare(strict_types=1);

namespace Src\Dip;

class TicketRepositoryFake implements TicketRepository
{
    private static TicketRepositoryFake $instance;

    /**
     * @var array<Ticket>
     */
    private array $tickets = [];

    private function __construct()
    {
        // not implemented
    }

    public static function getInstance(): TicketRepositoryFake
    {
        if (! isset(self::$instance)) {
            self::$instance = new TicketRepositoryFake();
        }
        return self::$instance;
    }

    public function getTicketById(string $ticketId): Ticket
    {
        return $this->tickets[array_search($ticketId, array_column($this->tickets, 'ticketId'))];
    }

    public function saveTicket(Ticket $ticket): void
    {
        array_push($this->tickets, $ticket);
    }
}
