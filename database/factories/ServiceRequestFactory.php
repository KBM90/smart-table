<?php

namespace Database\Factories;

use App\Models\ServiceRequest;
use App\Models\TableSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ServiceRequest>
 */
class ServiceRequestFactory extends Factory
{
    protected $model = ServiceRequest::class;

    public function definition(): array
    {
        $session = TableSession::factory()->create();

        return [
            'tenant_id' => $session->tenant_id,
            'table_session_id' => $session->id,
            'type' => ServiceRequest::TYPE_CALL_WAITER,
            'status' => ServiceRequest::STATUS_PENDING,
            'accepted_by' => null,
            'accepted_at' => null,
            'resolved_at' => null,
        ];
    }

    public function accepted(?User $user = null): static
    {
        return $this->state(function (array $attributes) use ($user): array {
            $acceptedBy = $user ?? User::factory()->owner();

            return [
                'status' => ServiceRequest::STATUS_ACCEPTED,
                'accepted_by' => $acceptedBy,
                'accepted_at' => now(),
            ];
        });
    }
}
