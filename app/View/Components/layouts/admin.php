<?php

namespace App\View\Components\layouts;

use Illuminate\View\Component;

class admin extends Component
{
    /**
     * Create a new component instance.
     * if you use app\Models\Contact instance;
     * private Contact $contact;
     * and then -> public function __construct(Contact $contact)
     *
     * @return void
     */
    public function __construct()
    {
        // $this->contact = $contact;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        // $contactCount = $this->contact->count();
        return view('components.layouts.admin');
        // return view('components.layouts.admin', compact('contactCount'));
    }
}
