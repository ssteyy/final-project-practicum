<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class OrderReportExport implements FromQuery, WithHeadings, WithMapping
{
    public function query()
    {
        return Order::with(['client', 'freelancer'])
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->latest();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Client Name',
            'Freelancer Name',
            'Original Price',
            'Platform Fee',
            'Amount',
            'Status',
            'Date',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->client->name ?? 'N/A',
            $order->freelancer->name ?? 'N/A',
            $order->original_price ?? 0,
            $order->platform_fee ?? 0,
            $order->amount,
            ucfirst($order->status),
            $order->created_at->format('Y-m-d H:i'),
        ];
    }
}
