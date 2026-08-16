<?php

namespace App\Console\Commands;

use App\Models\DeliveryMan;
use Illuminate\Console\Command;

class ActivateDeliveryMen extends Command
{
    protected $signature = 'dm:activate
                            {ids?* : Delivery man IDs to activate; omit to target every delivery man}
                            {--approve : Also approve the application and lift any suspension}
                            {--force : Skip the confirmation prompt}';

    protected $description = 'Mark delivery men as active (online) so they can be assigned orders';

    public function handle()
    {
        $ids = $this->argument('ids');

        $query = DeliveryMan::query()->when($ids, fn($q) => $q->whereIn('id', $ids));

        $total = (clone $query)->count();

        if ($total === 0) {
            $this->warn($ids ? 'No delivery men found for the given IDs.' : 'No delivery men found.');
            return self::FAILURE;
        }

        $scope = $ids ? "{$total} delivery man(s)" : "ALL {$total} delivery men";

        if (!$this->option('force') && !$this->confirm("Set {$scope} to active?")) {
            $this->info('Aborted.');
            return self::SUCCESS;
        }

        $attributes = ['active' => 1];

        if ($this->option('approve')) {
            $attributes['application_status'] = 'approved';
            $attributes['status'] = 1;
        }

        $updated = $query->update($attributes);

        $this->info("Activated {$updated} delivery man(s).");

        if (!$this->option('approve')) {
            $pending = DeliveryMan::when($ids, fn($q) => $q->whereIn('id', $ids))
                ->where(fn($q) => $q->where('application_status', '!=', 'approved')->orWhere('status', 0))
                ->count();

            if ($pending > 0) {
                $this->warn("{$pending} of them are still unapproved or suspended and will not appear for assignment. Re-run with --approve to clear that.");
            }
        }

        return self::SUCCESS;
    }
}
