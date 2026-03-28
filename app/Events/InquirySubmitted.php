<?php

namespace App\Events;

use App\Models\Inquiry;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InquirySubmitted
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public Inquiry $inquiry)
    {
    }
}
