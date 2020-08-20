<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Http\Request;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use LaravelDaily\Invoices\Invoice as LaravelInvoice;

class InvoiceController extends Controller
{
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('invoices.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoices
     * @param  Int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoices, $id)
    {
        $invoiceData = $invoices->getInvoiceByIdWithItemsAndStore($id);

        if ($invoiceData->invoiceitems->isEmpty()) {
            return back()->withError('Esta factura no tiene conceptos a calcular.');
        }
        
        return LaravelInvoice::make()
            ->sequence(667)
            ->serialNumberFormat($invoiceData->invoice_sid)
            ->dateFormat(Carbon::parse($invoiceData->start_at)->format("d/m/Y"))
            ->buyer(new Buyer($this->getCustomer($invoiceData)))
            ->taxRate($invoiceData->tax)
            ->addItems($this->getInvoiceItems($invoiceData->invoiceitems))
            ->filename($invoiceData->invoice_sid)
            ->stream();
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function anyData()
    {
        return datatables()->eloquent($this->invoice->query())
            ->addColumn('actions', function (Invoice $invoice) {
                    return '<div class="btn-group">
                    <form action="'. route('facturacion.show', $invoice->id).'" method="get">
                        <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm" title="Descargar PDF">
                                <i class="fas fa-arrow-circle-down"></i>
                            </button>
                        </div>
                    </form>
                </div>';
            })
            ->rawColumns(['actions', 'hashtags'])
            ->toJson();
    }

    /**
     * Get customer data for Buyer
     *
     * @param  \App\Models\Invoice  $invoice
     * @return Array
     */
    private function getCustomer($invoice) : array
    {
        return [
            'name'          => $invoice->store->business_name,
            'custom_fields' => [
                'Dirección' => $invoice->store->address,
                'CIF' => $invoice->store->cif,
                'Email' => $invoice->store->email,
            ]
        ];
    }

    /**
     * Get invoice items
     *
     * @param  Illuminate\Database\Eloquent\Collection  $invoiceItems The collection to iterate over.
     * @return Array
     */
    private function getInvoiceItems($invoiceItems) : array
    {
        return array_map(function ($invoiceItem) {
            return (new InvoiceItem())->title($invoiceItem['description'])->pricePerUnit($invoiceItem['price']);
        },$invoiceItems->toArray());
    }
}
